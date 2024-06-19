<?PHP

header('content-Type: application/json');

define("CHAVE", "32y31035nCb8zI1XjFFYOgqvCgHOe9e2VIze0uiNC1mHGGSwHYsq2MPVTQFO590604");
// define("CHAVE", "32y3103LLY36I2oxzZ4C6xDLcswc2lrQl8KqF1bCCd8TV0flVewHjqsc1J1e180709");

if (!function_exists('validarRecibo')) {
    function validarRecibo($recibo, $diretorioDestino = "fasmapay/")
    {
        $resultado = array(); // Inicializa o vetor de resultado

        if (isset($_FILES[$recibo]) && $_FILES[$recibo]['error'] === UPLOAD_ERR_OK) {
            $nomeArquivo = md5(time()) . '.pdf';
            // $nomeArquivo = $_FILES[$recibo]['name'];
            $caminhoArquivo = $_FILES[$recibo]['tmp_name'];

            // Verifique se a pasta de destino existe e tem permissões adequadas
            if (!is_dir($diretorioDestino)) {
                mkdir($diretorioDestino, 0777, true); // Cria a pasta se não existir
            }

            $caminhoDestino = $diretorioDestino . $nomeArquivo;

            // Verifique se o upload do PDF foi bem-sucedido
            if (move_uploaded_file($caminhoArquivo, $caminhoDestino)) {
                // URL da API
                $urlApi = 'https://api.fasma.ao?sudopay_key=' . CHAVE;

                // Inicializa a sessão cURL
                $ch = curl_init();

                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                // Configura a solicitação POST para a API
                curl_setopt($ch, CURLOPT_URL, $urlApi);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                    'url' => $_SERVER['HTTP_ORIGIN'],
                    'sudopay_file' => new CURLFile($caminhoDestino)
                ));

                // Realiza a solicitação
                $response = curl_exec($ch);

                // Verifica se houve algum erro
                if (curl_errno($ch)) {
                    $resultado['STATUS'] = 'erro';
                    $resultado['LOG'] = 'Erro ao enviar a solicitação: ' . curl_error($ch);
                } else {
                    $vetorResposta = json_decode($response, true);
                    if ($vetorResposta !== null) {
                        $vetorResposta["FICHEIRO"] = $caminhoDestino;
                        return $vetorResposta;
                    } else {
                        $resultado['STATUS'] = 'erro';
                        $resultado['LOG'] = 'O dominío/website não foi registado na sua conta';
                    }
                }

                // Fecha a sessão cURL
                curl_close($ch);
            } else {
                $resultado['STATUS'] = 'erro';
                $resultado['LOG'] = 'Erro ao fazer o upload do arquivo PDF';
            }
        } else {
            $resultado['STATUS'] = 'erro';
            $resultado['LOG'] = 'Nenhum arquivo enviado ou erro no envio do PDF';
        }

        return $resultado; // Retorna o vetor de resultado
        //return $vetorResposta; // Retorna o vetor de resultado

    }
}

if (!function_exists('validarTokens')) {
    function validarTokens($where, $token)
    {
        if (isset($_SESSION[$where]) && $_SESSION[$where] === $token) {
            // unset($_SESSION['token']);
            return true;
        }
        return false;
    }
}
if (!function_exists('generarTokens')) {
    function generarTokens($where)
    {
        // Salva o vetor na sessão
        return $_SESSION[$where] =  bin2hex(random_bytes(32));;
    }
}

if (!function_exists('formatarMontante')) {
    function formatarMontante($montante)
    {
        $valor = str_replace('.', '', $montante);
        $valor = str_replace(',', '.', $valor);
        return floatval($valor);
    }
}

if (!function_exists('formatarIban')) {

    function formatarIban($iban)
    {

        $string = str_replace('AO06', '', $iban); // Remove 'AO06'
        $string = str_replace('.', '', $string); // Remove pontos
        $string = str_replace(' ', '', $string); // Remove espaços em branco
        return $string; // Imprime a string modificada
    }
}

if (!function_exists('formatarData')) {

    function verificarFormatoData($data)
    {
        $formatos = array('Y-m-d', 'd/m/Y');

        foreach ($formatos as $formato) {
            $d = DateTime::createFromFormat($formato, $data);
            if ($d && $d->format($formato) == $data) {
                return $formato;
            }
        }

        return '0';
    }
    function formatarData($data)
    {

        $objetoData = DateTime::createFromFormat(verificarFormatoData($data), $data);
        return $objetoData->format('Y-m-d');
    }
    function formatarDataCount($data)
    {
        $objetoData = DateTime::createFromFormat(verificarFormatoData($data), $data);
        return $objetoData->format('Ymd');
    }
}
