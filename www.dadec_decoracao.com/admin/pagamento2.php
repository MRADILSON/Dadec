<?php include 'include/init.php'; 
 if (!isset($_SESSION['id'])) {
    redirect_to("../");
 }
?>
<?php $cliente_profile = Cliente::find_by_id($_SESSION['id']); ?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formas de Pagamento</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
    
    <style>
        body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.payment-options {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.payment-option {
    text-align: center;
    margin-right: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 8px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.payment-option:hover {
    transform: translateY(-30px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    cursor: pointer;
}

.payment-icon {
    width: 200px;
    height: 100px;
}

.payment-description {
    font-size: 18px;
    margin-top: 10px;
}

.iban {
    font-size: 14px;
    margin-top: 5px;
    color: #666;
}

.btn{
    margin-top: 5px;
    background-color: red;
    color: white;
    padding: 15px;
    border-radius: 10px;
    border-color: white;
    font-size: 12pt;
    cursor: pointer;
    text-decoration: none;
    margin-bottom: 10px;
}

.name{
    color: green;
    font-size: 12pt;
    text-transform: uppercase;
}
@media screen and (max-width: 768px) {
    .container {
                max-width: 100%;
                margin: 10px;
                padding: 10px;
            }

            .payment-options {
                flex-wrap: wrap;
                justify-content: center;
                gap: 10px;
            }

            .payment-option {
                min-width: 200px;
            max-width: 250px;
            }

            .payment-icon {
                width: 150px;
                height: auto;
            }

            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Proceder ao Pagamento</h2>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h4>Detalhes do Pedido:</h4>
                <?php 
                if(isset($_GET['total'])) {
                    echo "<li>Nome do/a Cliente: <b class='name'>" . $cliente_profile->nome. "</b></li>";
                    echo "<li>Tipo de Evento: <b>" . $_GET['tipo'] . "</b></li> <li> Data do Evento: <b>" . $_GET['data'] . "</b></li> <li> Nº de Lugares: <b>" . $_GET['lugares'] . "</b> </li><li> Localização: <b>" . $_GET['endereco'] . "</b></li>";
                    echo "<li>Cor: <b>" . $_GET['cor'] . "</b> </li><li> Estilo: <b>" . $_GET['estilo'] . "</b> </li><li> Valor Total a Pagar: <b>" . $_GET['total'] . "</b></li>";
                }
                ?>
            </div>
            <hr>
            <div class="col-md-6">
                <h3>Formas de Pagamento</h3>
                <div class="payment-options">

    <form action="payment_detalhes.php" method="POST" class="payment-option" data-type="paypal">
        <input type="hidden" name="payment_type" value="Bai Direto">
        <input type="hidden" name="total" value="<?php echo $_GET['total']; ?>">

        <input type="hidden" name="data" value="<?php echo $_GET['data']; ?>" class="form-control">
        <input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>" class="form-control">
        <input type="hidden" name="lugares" value="<?php echo $_GET['lugares']; ?>" class="form-control">
        <input type="hidden" name="endereco" value="<?php echo $_GET['endereco']; ?>"  class="form-control">
        <input type="hidden" name="cor" value="<?php echo $_GET['cor']; ?>"  style="width: 100px;" class="form-control">
        <input type="hidden" name="estilo" value="<?php echo $_GET['estilo']; ?>"  style="width: 100px;" class="form-control">

        <img src="../images/OIP.jpg" alt="BAI DIRETO" class="payment-icon">
                    <p class="payment-description">BAI DIRETO</p>
                    <p class="details">Banco: Banco BAI</p>
                    <p class="iban">IBAN: AO06 0006 0000 9767 2895 3017 6</p>
                    <p class="account-number">Telefone: +244 926 332 443</p>
    </form>
    <form action="payment_detalhes.php" method="POST" class="payment-option" data-type="unitel_money">
        <input type="hidden" name="payment_type" value="Multicaixa Express">
        <input type="hidden" name="total" value="<?php echo $_GET['total']; ?>">


        <input type="hidden" name="data" value="<?php echo $_GET['data']; ?>" class="form-control">
        <input type="hidden" name="tipo" value="<?php echo $_GET['tipo']; ?>" class="form-control">
        <input type="hidden" name="lugares" value="<?php echo $_GET['lugares']; ?>" class="form-control">
        <input type="hidden" name="endereco" value="<?php echo $_GET['endereco']; ?>"  class="form-control">
        <input type="hidden" name="cor" value="<?php echo $_GET['cor']; ?>"  style="width: 100px;" class="form-control">
        <input type="hidden" name="estilo" value="<?php echo $_GET['estilo']; ?>"  style="width: 100px;" class="form-control">

        <img src="../images/unnamed.png" alt="Mulicaixa Express" class="payment-icon">
                    <p class="payment-description">Mulicaixa Express</p>
                    <p class="account-number">IBAN: AO06 0006 0000 9767 2895 3017 6</p>
                    <p class="account-number">Telefone: +244 926 332 443</p>
    </form><br>
    
    
    <!-- Adicione mais opções de pagamento conforme necessário -->
</div>

<br><br>
<div class="form-group">
    <a  href="alugar_material.php"  class="btn btn-danger">Cancelar</a>
    </div>
<script>
    document.querySelectorAll('.payment-option').forEach(option => {
        option.addEventListener('click', () => {
            option.submit();
        });
    });
</script>


    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
