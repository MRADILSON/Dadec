<?php 
include 'include/init.php'; 
$count = 0;
$error = '';
 if (!isset($_SESSION['id'])) {
    redirect_to("../");
 }
?>
<?php
$cliente_profile = Cliente::find_by_id($_SESSION['id']);

$pagamento =  new Pagamento1();
// Verifica se o formulário foi enviado
if (isset($_POST['enviar']) || isset($_FILES['preview_image'])) {
    $total = clean($_POST['total']);
    $payment_type = clean($_POST['payment_type']);
    $additional_info = clean($_POST['additional_info']);
    $payment_proof = clean($_FILES['payment_proof']);
    $nome_cliente = clean($cliente_profile->nome);
    $cliente_i = clean($cliente_profile->id);
    
    $data = clean($_POST['data']);
    $endereco = clean($_POST['endereco']);
    $cor = clean($_POST['cor']);
    $estilo = clean($_POST['estilo']);
    $lugares = clean($_POST['lugares']);
    $tipoE = clean($_POST['tipo']);

    if (empty($nome_cliente) || empty($tipoE) || empty($payment_type) || empty($total)) {
        redirect_to("payment_detalhes.php");
        $session->message("
        <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
          <strong><i class='mdi mdi-account-alert mr-2'></i></strong> {$tipo} {$nome_cliente} Por favor preencha os campos.
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button>
        </div>");
        die();
    }else{
        $pagamento->tipo_pagamento = $payment_type;
        $pagamento->total = $total;
        $pagamento->descricao = $additional_info;
        $pagamento->tipo = $tipoE;

        $dataAtualParaExibir = date("y-m-d h:m:i P");
        $pagamento->data_evento = $data;
        $pagamento->cadeiras = $lugares;
        $pagamento->localizacao = $endereco;
        $pagamento->cor = $cor;
        $pagamento->estilo = $estilo;
        $pagamento->data_pagamento=$dataAtualParaExibir;
        $pagamento->estado = 'pendente';
        $pagamento->cliente= $nome_cliente;
        $pagamento->cliente_id = $cliente_profile->id;
        $pagamento->set_file($_FILES['preview_image']);
        $pagamento->save_image();
    
        if ($pagamento->save()) {
            redirect_to("payment_detalhes.php");
            $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert mr-2'></i></strong> Dados submetidos com sucesso!
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        } else {
            $msg = join("<br>", $pagamento->errors);
        }
    }

   

} 
?>


<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Pagamento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
    
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
    </style>
</head>
<body>

    <div class="container mt-5">
        
        <h2>Detalhes do Pagamento</h2>
        <?php
            if ($session->message()) {
                echo  $session->message();
            }
        ?>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <h4>Resumo do Pedido:</h4>
                <?php 
                if(isset($_POST['total']) && isset($_POST['payment_type'])) {
                    $total = $_POST['total'];
                    $tipo = $_POST['tipo'];
                    $data = $_POST['data'];
                    $endereco = $_POST['endereco'];
                    $cor = $_POST['cor'];
                    $estilo = $_POST['estilo'];
                    $lugares = $_POST['lugares'];
                    $cliente = $cliente_profile->nome;
                    $client_i = $cliente_profile->id;
                    $payment_type = $_POST['payment_type'];

                    echo "<li>Nome do/a Cliente: <b class='name'>" . $cliente_profile->nome. "</b></li>";
                    echo "<li>Tipo de Evento: <b>" . $tipo. "</b></li> <li> Data do Evento: <b>" . $data. "</b></li> <li> Nº de Lugares: <b>" . $lugares . "</b> </li><li> Localização: <b>" . $endereco . "</b></li>";
                    echo "<li>Cor: <b>" . $cor . "</b> </li><li> Estilo: <b>" . $estilo . "</b> </li><li> Valor Total a Pagar: <b>" . $total . "</b></li>";
                    echo "<li>Tipo de Pagamento: <b><i>" . $payment_type . "</i></b></li>";
                } else {
                    echo "<p>Informações do pagamento não fornecidas.</p>";
                    $total = '';
                    $payment_type = '';
                }
                ?>
            </div>
        </div>
        <hr>
        
        <!-- Formulário para enviar os dados para o banco de dados -->
        <form action=" " method="POST" enctype="multipart/form-data">
        <?= isset($msg) ? $msg : ''; ?>
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <input type="hidden" name="payment_type" value="<?php echo $payment_type; ?>">
            <input type="hidden" name="data" value="<?php echo $data; ?>">
            
            <input type="hidden" name="lugares"  value="<?php echo $lugares; ?>">
            <input type="hidden" name="endereco" value="<?php echo $endereco; ?>">
            <input type="hidden" name="cor" value="<?php echo $cor; ?>">
            <input type="hidden" name="estilo" value="<?php echo $estilo; ?>">
            <input type="hidden" name="tipo" value="<?php echo $tipo; ?>">
            
            <div class="form-group">
                <label class="form-control" for="preview_image">Comprovativo de Pagamento (apenas em PDF):</label>
                <input type="file" class="form-control" name="preview_image" required onchange="document.getElementById('preview_image').src = window.URL.createObjectURL(this.files[0])">
            </div>

            <br>
            
            <button name="enviar" type="submit" class="btn btn-success">Enviar</button>
            <a name="cancelar" href="decoracao.php" type="submit" class="btn btn-danger">Cancelar</a>
        </form>

        
    </div>

    <!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="js/popper.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="../js/bootstrap-datepicker.min.js"></script>
<script>
  
    $(document).ready(function() {
        $('#wedding_date').datepicker();
        $('[data-toggle="tooltip"]').tooltip();
    });
    
</script>
</body>
</html>
