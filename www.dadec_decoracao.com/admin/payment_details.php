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

function subtrairQuantidadeProduto($produtoId, $quantidadeSubtrair) {
   // global $database; // Supondo que $database seja a conexão com o banco de dados
   global $connection;

    // Obter a quantidade atual do produto
    $sql = "SELECT quantidade FROM tbl_material WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('i', $produtoId);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        return false; // Produto não encontrado
    }
    $produto = $result->fetch_assoc();
    $quantidadeAtual = $produto['quantidade'];

    // Verificar se há quantidade suficiente
    if ($quantidadeAtual < $quantidadeSubtrair) {
       
        return false; // Quantidade insuficiente
    }

    // Subtrair a quantidade
    $novaQuantidade = $quantidadeAtual - $quantidadeSubtrair;
    $sql = "UPDATE tbl_material SET quantidade = ? WHERE id = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param('ii', $novaQuantidade, $produtoId);
    $stmt->execute();

    return $stmt->affected_rows > 0;
}

$pagamento = new Pagamento();
// Verifica se o formulário foi enviado
if (isset($_POST['enviar'])) {
    $total = clean($_POST['total']);
    $payment_type = clean($_POST['payment_type']);
    $additional_info = clean($_POST['additional_info']);
    //$payment_proof = clean($_FILES['payment_proof']);
    $nome_cliente = clean($cliente_profile->nome);
    $cliente_i = clean($cliente_profile->id);
    $material = clean($_POST['material']);
    $produto_id = clean($_POST['id']); // Supondo que você tenha o ID do produto
    $quantidade = clean($_POST['quantidade']); // Quantidade a subtrair

    if (empty($nome_cliente) || empty($additional_info) || empty($payment_type) || empty($total)) {
        redirect_to("payment_details.php");
        $session->message("
        <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
          <strong><i class='mdi mdi-account-alert mr-2'></i></strong> {$client_i} {$nome_cliente} Por favor preencha os campos.
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button>
        </div>");
        die();
    } else {
        $pagamento->tipo_pagamento = $payment_type;
        $pagamento->total = $total;
        $pagamento->descricao = $additional_info;

        $dataAtualParaExibir = date("y-m-d h:m:i P");

        $pagamento->data = $dataAtualParaExibir;
        $pagamento->produto = $material;
        $pagamento->estado = 'pendente';
        $pagamento->cliente = $nome_cliente;
        $pagamento->cliente_id = $cliente_profile->id;
        $pagamento->set_file($_FILES['preview_image']);
        $pagamento->save_image();


        if ($pagamento->save()) {
            if (subtrairQuantidadeProduto($produto_id, $quantidade)) {
                redirect_to("payment_details.php");
                $session->message("
                <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                  <strong><i class='mdi mdi-account-alert mr-2'></i></strong> Dados submetidos com sucesso e quantidade atualizada!
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </div>");
                die();
            } else {
                redirect_to("payment_details.php");
                $session->message("
                <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                  <strong><i class='mdi mdi-account-alert mr-2'></i></strong> A quantidade inserida é maior que a existente.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </div>");
                die();
            }
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
        h2, h4 {
            margin-bottom: 20px;
            font-weight: 600;
            color: #333;
        }
        hr {
            margin: 20px 0;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn {
            margin-top: 10px;
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
                $produto = $_POST['produto'];
                $cliente = $cliente_profile->nome;
                $client_i = $cliente_profile->id;
                $payment_type = $_POST['payment_type'];
                $produto_id = $_POST['id'];
                $quantidade = $_POST['quantidade'];

                echo "<li>Nome do/a Cliente: <b><i>" . $cliente. "</i></b></li>";
                echo "<li>ID do Produto: <b><i>" . $produto_id. "</i></b></li>";
                echo "<li>Produto: <b><i>" .$produto. "</i></b></li>";
                echo "<li>Valor Total a Pagar: <b><i>" . $total . "</i></b></li>";
                echo "<li>Tipo de Pagamento: <b><i>" . $payment_type . "</i></b></li>";
            } else {
                echo "<p>Informações do pagamento não fornecidas.</p>";
                $total = '';
                $payment_type = '';
            }
            ?>
        </div>
    </div>
    
    <!-- Formulário para enviar os dados para o banco de dados -->
    <form action=" " method="POST" enctype="multipart/form-data">
        <?= isset($msg) ? $msg : ''; ?>
        <input type="hidden" name="total" value="<?php echo $total; ?>">
        <input type="hidden" name="material" value="<?php echo $produto; ?>">
        <input type="hidden" name="payment_type" value="<?php echo $payment_type; ?>">
        <input type="hidden" name="id" value="<?php echo $produto_id; ?>">
        <input type="hidden" name="quantidade" value="<?php echo $quantidade; ?>">

        
        <div class="form-group">
            <label for="additional_info">Informações Adicionais:</label>
            <input type="text" name="additional_info" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label class="form-control" for="preview_image">Comprovativo de Pagamento (apenas em PDF)</label><br>
            <input type="file" class="form-control" name="preview_image" required onchange="document.getElementById('preview_image').src = window.URL.createObjectURL(this.files[0])">
        </div>
        
        <button name="enviar" type="submit" class="btn btn-success">Enviar</button>
        <a name="cancelar" href="alugar_material.php" type="submit" class="btn btn-danger">Cancelar</a>
    </form>
</div>

<!-- Bootstrap core JavaScript -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>
</html>

