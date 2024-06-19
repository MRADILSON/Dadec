<?php
require('include/init.php');

if (!isset($_SESSION['id'])) {
    redirect_to("../");
}

// Conexão com a base de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_decoracao_evento"; // Substitua pelo nome do seu banco de dados

$connection = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($connection->connect_error) {
    die("Conexão falhou: " . $connection->connect_error);
}


$produtos = Category::find_all();
$pagamento =  Pagamento1::find_all();


if (isset($_POST['gerar_mensal'])) {
    $mes = clean($_POST['mes']);
    $ano = clean($_POST['ano']);
    $dados = gerar_relatorio_mensal($mes, $ano);
    $total = calcular_total_mensal($mes,$ano);
    criar_pdf($dados, "Relatório Mensal: $mes/$ano",$total);
}

if (isset($_POST['gerar_anual'])) {
    $ano1 = clean($_POST['ano1']);
    $total = calcular_total_anual($ano1);
    $dados = gerar_relatorio_anual($ano1);
    criar_pdf($dados, "Relatório Anual: $ano1",$total);
}

if (isset($_POST['gerar_produto'])) {
    $produto = clean($_POST['produto']);
    $total = calcular_total_produto($produto);
    $dados = gerar_relatorio_produto($produto);
    criar_pdf($dados, "Relatório do Produto: $produto",$total);
}

function gerar_relatorio_mensal($mes, $ano) {
    global $connection;

    // Prepara a consulta SQL
    $sql = "SELECT cliente,tipo, tipo_pagamento, data, total, estado FROM pagamento_decoracao WHERE MONTH(data) = ? AND estado = 'aprovado' AND YEAR(data) = ?";
    $stmt = $connection->prepare($sql);
    
    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $connection->error);
    }
    
    // Liga os parâmetros da consulta
    $stmt->bind_param("ii", $mes, $ano); // "ii" indica que ambos os parâmetros são inteiros
    
    // Executa a consulta
    if (!$stmt->execute()) {
        die('Erro ao executar a consulta: ' . $stmt->error);
    }
    
    // Obtém o resultado da consulta
    $result = $stmt->get_result();
    
    // Cria um array para armazenar os dados
    $dados = [];
    
    // Itera sobre o resultado e armazena os dados no array
    while ($row = $result->fetch_assoc()) {
        $dados[] = $row;
    }
    
    // Fecha a declaração
    $stmt->close();
    
    // Retorna os dados
    return $dados;
}


function calcular_total_mensal($mes,$ano) {
    global $connection;

    // Prepara a consulta SQL para somar os valores da coluna "total" para o mês específico
    $sql = "SELECT SUM(total) AS total_mensal FROM pagamento_decoracao WHERE MONTH(data) = ? AND estado = 'aprovado' AND YEAR(data) = ?";
    $stmt = $connection->prepare($sql);
    
    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $connection->error);
    }
    
    // Liga o parâmetro da consulta
    $stmt->bind_param("ii", $mes,$ano);
    
    // Executa a consulta
    if (!$stmt->execute()) {
        die('Erro ao executar a consulta: ' . $stmt->error);
    }
    
    // Obtém o resultado da consulta
    $result = $stmt->get_result();
    
    // Obtém o valor total mensal
    $row = $result->fetch_assoc();
    $total_mensal = $row['total_mensal'];
    
    // Fecha a declaração
    $stmt->close();
    
    // Retorna o valor total mensal
    return $total_mensal;
}

function calcular_total_produto($produto) {
    global $connection;

    // Prepara a consulta SQL para somar os valores da coluna "total" para o mês específico
    $sql = "SELECT SUM(total) AS total_produto FROM pagamento_decoracao WHERE tipo LIKE ? AND estado = 'aprovado'";
    $stmt = $connection->prepare($sql);
    
    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $connection->error);
    }
    
    // Adiciona os caracteres curinga % ao redor do produto
    $produto = "%$produto%";
    
    // Liga o parâmetro da consulta
    $stmt->bind_param("s", $produto);
    
    // Executa a consulta
    if (!$stmt->execute()) {
        die('Erro ao executar a consulta: ' . $stmt->error);
    }
    
    // Obtém o resultado da consulta
    $result = $stmt->get_result();
    
    // Obtém o valor total mensal
    $row = $result->fetch_assoc();
    $total_mensal = $row['total_produto'];
    
    // Fecha a declaração
    $stmt->close();
    
    // Retorna o valor total mensal
    return $total_mensal;
}

function gerar_relatorio_anual($ano) {
    global $connection;

    $sql = "SELECT cliente,tipo,tipo_pagamento,data,total,estado FROM pagamento_decoracao WHERE YEAR(data) = ? AND estado = 'aprovado'";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $ano);
    $stmt->execute();
    $result = $stmt->get_result();

    $dados = [];
    while ($row = $result->fetch_assoc()) {
        $dados[] = $row;
    }

    $stmt->close();
    return $dados;
}

function gerar_relatorio_produto($produto) {
    global $connection;

    $sql = "SELECT cliente,tipo,tipo_pagamento, data, total, estado FROM pagamento_decoracao WHERE tipo LIKE ? AND estado = 'aprovado'";
    $stmt = $connection->prepare($sql);

    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $connection->error);
    }

    // Adiciona os caracteres curinga % ao redor do produto
    $produto = "%$produto%";
    
    // Liga o parâmetro da consulta
    $stmt->bind_param("s", $produto);

    // Executa a consulta
    if (!$stmt->execute()) {
        die('Erro ao executar a consulta: ' . $stmt->error);
    }

    // Obtém o resultado da consulta
    $result = $stmt->get_result();

    // Cria um array para armazenar os dados
    $dados = [];
    
    // Itera sobre o resultado e armazena os dados no array
    while ($row = $result->fetch_assoc()) {
        $dados[] = $row;
    }

    // Fecha a declaração
    $stmt->close();
    
    // Retorna os dados
    return $dados;
}


function calcular_total_anual($mes) {
    global $connection;

    // Prepara a consulta SQL para somar os valores da coluna "total" para o mês específico
    $sql = "SELECT SUM(total) AS total_anual FROM pagamento_decoracao WHERE YEAR(data) = ? AND estado = 'aprovado'";
    $stmt = $connection->prepare($sql);
    
    // Verifica se a preparação da consulta foi bem-sucedida
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $connection->error);
    }
    
    // Liga o parâmetro da consulta
    $stmt->bind_param("i", $mes);
    
    // Executa a consulta
    if (!$stmt->execute()) {
        die('Erro ao executar a consulta: ' . $stmt->error);
    }
    
    // Obtém o resultado da consulta
    $result = $stmt->get_result();
    
    // Obtém o valor total mensal
    $row = $result->fetch_assoc();
    $total_anual = $row['total_anual'];
    
    // Fecha a declaração
    $stmt->close();
    
    // Retorna o valor total mensal
    return $total_anual;
}

function criar_pdf($dados, $titulo, $total) {
    require('fpdf/fpdf.php'); // Certifique-se de que este caminho está correto
    
    // Instancia um objeto FPDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);
    //$pdf->Cell(0,10,utf8_decode($titulo),0,1,'C');

    // Adiciona a imagem da empresa
    $pdf->Image('../images/logo/IMG-20240615-WA0011.jpg', 10, 10, 50);
    $pdf->Ln();
    // Adiciona o texto "DADEC - Decoração e Eventos" após a imagem
    $pdf->Cell(0, 10, utf8_decode('Elizabeth Mualunga e Filhos'), 0, 1, 'C');

    // Adiciona o título
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode($titulo), 0, 1, 'C');

    // Quebra de linha
    $pdf->Ln();

    // Define a fonte para a tabela
    $pdf->SetFont('Arial', 'B', 10);
    
    if (!empty($dados)) {
        // Cabeçalhos da tabela
        foreach ($dados[0] as $coluna => $valor) {
            $pdf->Cell(40, 10, $coluna, 1);
        }
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 10);
        
        // Dados da tabela
        foreach ($dados as $dado) {
            foreach ($dado as $coluna => $valor) {
                // Verificar se a coluna é 'data' e formatar corretamente
                if ($coluna == 'data') {
                    $valor = date('d-m-Y H:i:s', strtotime($valor));
                }
                $pdf->Cell(40, 10, $valor, 1);
            }
            $pdf->Ln();
        }
    } else {
        // Se não houver dados, exiba uma mensagem
        $pdf->Cell(0, 10, 'Nenhum dado encontrado.', 1, 1, 'C');
    }

    // Adiciona a quantidade de pagamentos, total de ganhos e lucros abaixo da tabela
    $quantidade_pagamentos = count($dados);
    //$total_ganhos = array_sum(array_column($dados, 'valor'));
    //$lucro = $total_ganhos - $total_gastos;
    
    $pdf->Ln();
    $pdf->Cell(0, 10, 'Quantidade de Pagamentos: ' . $quantidade_pagamentos, 0, 1);
    $pdf->Cell(0, 10, 'Total de Ganhos: ' . $total, 0, 1);
    //$pdf->Cell(0, 10, 'Lucro: ' . $lucro, 0, 1);

    // Saída do PDF
    $pdf->Output();
}


?>

<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Relatórios - Administrador</title>
    <?php include 'include/header.php'; ?>
</head>
<body>
    <div class="wrapper">
        <?php include 'include/menu.php'; ?>

        <div class="main">
            <?php include 'include/topo1.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3">Relatórios de eventos</h1>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Relatório Mensal</h5>
                                    <form method="POST">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="mes">Mês</label>
                                                    <select class="form-control" id="mes" name="mes">
                                                    <option disabled>Selecione o Mês</option>

                                                    <option value="1">Janeiro</option>
                        <option value="2">Fevereiro</option>
                        <option value="3">Março</option>
                        <option value="4">Abril</option>
                        <option value="5">Maio</option>
                        <option value="6">Junho</option>
                        <option value="7">Julho</option>
                        <option value="8">Agosto</option>
                        <option value="9">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ano_anual">Ano</label>
                                                    <input type="number" name="ano" id="ano" min="2024" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary mt-4" name="gerar_mensal">Gerar Relatório</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Relatório Anual</h5>
                                    <form method="POST">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ano_anual">Ano</label>
                                                    <input type="number" name="ano1" id="ano1" value="2024" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary mt-4" name="gerar_anual">Gerar Relatório</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Relatório do Material</h5>
                                    <form method="POST">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="ano_anual">Selecione o Material</label>
                                                    <select class="form-control" id="produto" name="produto">
                                                    <?php foreach ($produtos as $produto) : ?>
                                                    <option value="<?= $produto->wedding_type ?>"><?= $produto->wedding_type ?></option>
                                                    <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="submit" class="btn btn-primary mt-4" name="gerar_produto">Gerar Relatório</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           
        </div>
    </div>
</main>

</main>
<script src="js/app.js"></script>
            <footer class="footer">
                <?php include 'include/footer1.php' ?>
            </footer>
            </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>
</body>
</html>
