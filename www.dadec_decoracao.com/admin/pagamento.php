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
            font-family: 'Open Sans', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
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

        h2, h3, h4 {
            margin-bottom: 20px;
            font-weight: 600;
            color: #333;
        }

        hr {
            margin: 20px 0;
        }

        .payment-options {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-top: 20px;
        }

        .payment-option {
            flex: 1;
            min-width: 200px;
            max-width: 250px;
            margin: 10px;
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .payment-option:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        .payment-icon {
            width: 100px;
            height: auto;
        }

        .payment-description {
            font-size: 16px;
            margin-top: 10px;
        }

        .iban, .details, .account-number {
            font-size: 14px;
            margin-top: 5px;
            color: #666;
        }

        .btn {
            margin-top: 20px;
            background-color: red;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            border: none;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        @media screen and (max-width: 768px) {
            .container {
                padding: 15px;
            }

            .payment-option {
                flex: 1 1 100%;
                margin: 10px 0;
            }

            .btn {
                width: 90%;
                text-align: center;
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
                echo "<li>Nome do/a Cliente: <b><i>" . $cliente_profile->nome. "</i></b></li>";
                echo "<li>ID: <b><i>" . $_GET['produto_id']. "</i></b></li>";
                echo "<li>Produto: <b><i>" . $_GET['produto']. "</i></b></li>";
                echo "<li>Valor Total a Pagar: <b><i>" . $_GET['total'] . "</i></b></li>";
            }
            ?>
        </div>
        <div class="col-md-6">
            <h3>Formas de Pagamento</h3>
            <div class="payment-options">
                <form action="payment_details.php" method="POST" class="payment-option" data-type="credit_card">
                    <input type="hidden" name="payment_type" value="BAI DIRETO">
                    <input type="hidden" name="id" value="<?php echo $_GET['produto_id']; ?>">
                    <input type="hidden" name="total" value="<?php echo $_GET['total']; ?>">
                    <input type="hidden" name="produto" value="<?php echo $_GET['produto']; ?>">
                    <input type="hidden" name="quantidade" value="<?php echo $_GET['quantidade']; ?>">
                    <img src="../images/OIP.jpg" alt="BAI DIRETO" class="payment-icon">
                    <p class="payment-description">BAI DIRETO</p>
                    <p class="details">Banco: Banco BAI</p>
                    <p class="iban">IBAN: AO06 0006 0000 9767 2895 3017 6</p>
                    <p class="account-number">Telefone: +244 926 332 443</p>
                </form>
                <form action="payment_details.php" method="POST" class="payment-option" data-type="unitel_money">
                    <input type="hidden" name="payment_type" value="Mulicaixa Express">
                    <input type="hidden" name="id" value="<?php echo $_GET['produto_id']; ?>">
                    <input type="hidden" name="total" value="<?php echo $_GET['total']; ?>">
                    <input type="hidden" name="produto" value="<?php echo $_GET['produto']; ?>">
                    <input type="hidden" name="quantidade" value="<?php echo $_GET['quantidade']; ?>">
                    <img src="../images/unnamed.png" alt="Mulicaixa Express" class="payment-icon">
                    <p class="payment-description">Mulicaixa Express</p>
                    <p class="account-number">IBAN: AO06 0006 0000 9767 2895 3017 6</p>
                    <p class="account-number">Telefone: +244 926 332 443</p>
                </form>
            </div>
            <div class="form-group">
                <a href="alugar_material.php" class="btn">Cancelar</a>
            </div>
        </div>
    </div>
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

