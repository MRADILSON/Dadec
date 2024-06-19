<?php include 'admin/include/init.php'; ?>
<?php
$count = 0;
$error = '';

$account_details = new Account_Details();
$accounts = new Accounts();
$booking = new Booking();
$category = Category::find_all();
$blogEvent = EventWedding::getEventBlogs();

$cliente = new Cliente();

if (isset($_POST['register'])) {

    $nome = clean($_POST['nome']);
    $email = clean($_POST['email']);
    $password = clean($_POST['password']);
    $genero = clean($_POST['gender']);
    $telefone = clean($_POST['telefone']);
    $endereco = clean($_POST['endereco']);

    if (empty($nome) ||
        empty($email) ||
        empty($password) ||
        empty($genero) ||
        empty($telefone) || empty($endereco)) {
        
       redirect_to("sign_up.php?emptyfields");

       $session->message("
       <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
         <strong><i class='mdi mdi-alert'></i></strong>  Por favor preencha todos os campos.
         <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
           <span aria-hidden=\"true\">&times;</span>
         </button>
       </div>");
       die();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        redirect_to("sign_up.php");
        $session->message("
            <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-alert'></i></strong>  Formato de Email incorrecto.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
        die();

    }

    $check_email = $cliente->email_exists($email);

    if ($check_email) {
        redirect_to("sign_up.php");
        $session->message("
            <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-alert'></i></strong>  Email já existe.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
        die();
    } else {
        if ($error == '') {
            $count = $count + 1;
            $cliente->nome = $nome;
            $cliente->email = $email;
            $cliente->password=$password;
            $cliente->genero = $genero;
            $cliente->telefone = $telefone;
            $cliente->endereco = $endereco;
            $cliente->estado = 'activo';
            $cliente->data_criacao  = date("y-m-d h:m:i");
            $cliente->save();

           redirect_to("sign_up.php?");

            $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-check'></i></strong> {$cliente->nome} Inscrição feita com sucesso!.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");

            /*
            
            if ($cliente->save()) {
                $cliente->id = mysqli_insert_id($db->connection);

                if($cliente->update()) {
                    $accounts->user_id = $account_details->user_id;
                    $accounts->user_email= $user_email;

                    if($accounts->save()) {
                       // $booking->user_id = $accounts->user_id;
                       // $booking->user_email = $user_email;
                        //$booking->wedding_date =  $wedding_date;
                       // $booking->save();
                        redirect_to("thank_you.php");
                    }
                }
            }*/
        }
    }
}
?>
<!doctype html>
<html lang="pt">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inscrição Grátis</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/datepicker.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Open Sans', 'Roboto', sans-serif;
            line-height: 1.5em;
            margin-bottom: 0%;
            width: 100%;
            margin-top: 4%;
            overflow-x: hidden;
            background: #f1f1f1;
        }

        .navbar-light .navbar-brand {
            color: #1a1a1a;
            font-weight: bold;
            line-height: 22px;
        }

        .navbar {
            font-weight: 700;
            padding: 12px;
            font-style: normal;
            font-size: 14px;
            text-transform: uppercase;
            color: black;
            border-bottom: 1px solid #ddd;
        }

        li.nav-item > a.nav-link {
            color: black !important;
            font-weight: bold !important;
        }

        #review {
            font-size: 16px;
            font-weight: bold;
            margin-right: 5px;
        }

        .form-inline > a.mr-2, .btn.btn-sm.my-2.my-sm-0 {
            color: black;
            font-size: 14px;
            font-weight: 700;
            margin-left: 10px;
        }

        .form-inline > a.mr-2:hover, .btn.btn-sm.my-2.my-sm-0:hover {
            color: #17b4bc;
            text-decoration: none;
        }

        a.btn.btn-sm.my-2.my-sm-0.mr-2.loginbtn {
            background: #dc3545;
            font-size: 14px;
            color: white;
            padding: 5px;
            border: 2px solid transparent;
            width: 85px;
        }

        a.btn.btn-sm.my-2.my-sm-0.mr-2.loginbtn:hover {
            background: white;
            border: 2px solid #dc3545;
            color: #dc3545;
        }

        .navbar-expand-lg .navbar-nav .nav-link {
            padding-right: .9rem;
        }

        .navbar-brand {
            margin-left: 20px;
            width: 200px;
        }

        .hero {
            height: 550px;
            width: 100%;
            border-color: rgba(0, 0, 0, 0.02);
            background: url(images/carousel2.jpg);
            background-size: contain;
            background-size: 100% 100%;

        }

        .form-control {
            font-size: 14px;
        }

        .hero-lead {
            font-size: 36px;
            color: white;
            font-style: normal;
        }

        .form-control {
            outline: none;
            border-radius: 0;
        }

        .btn.btn-info.text-uppercase {
            font-size: 14px;
        }

        .btn.btn-info.text-uppercase.font-weight-bold {
            width: 150px;
            padding: 6px;
            border-radius: 0;
        }

        .btn.btn-danger.text-uppercase {
        font-size: 14px;
        }

        .btn.btn-danger.text-uppercase.fb {
        width: 150px;
        padding: 6px;
        border-radius: 0;
        }

        .datepicker {
            width: 250px;
            font-size: 12px;
        }

        .pricing {
            width: 18%;
            min-height: 200px;
            float: left;
            background: gray;
            margin-left: 2%;
        }

        .container-fluid.custom-container {
            width: 90%;
        }

        a.btn.btn-custom {
            background: none;
            border-radius: 0;
            font-size: 12px;
            width: 100%;
            border: 2px solid #17a2b8;
            color: #17a2b8;
            font-weight: 700;
            text-transform: uppercase;
        }

        a.btn.btn-custom:hover {
            background: #17a2b8;
            color: white;
        }

        .list-group-item.text-center.text-uppercase {
            background: white;
            color: black;
            font-weight: 700;
            font-size: 18px;
            padding: 10px;
        }

        .list-group-item {
            font-size: 12px;
            padding: 5px 10px;
        }

        .card-columns {
            column-count: 4;
        }
        .modal-content {
            -webkit-border-radius:0;
            -moz-border-radius:0;
            border-radius:0;
            font-size: 14px;
        }
        .btn.btn-primary.mr-2.custom-btn {
            background: #22adb5;
            border: 1px solid #22adb5;
        }
        .btn.btn-primary.mr-2.custom-btn:hover {
            background: #2d98b5;
        }
        .modal-header {
            border-bottom: 0;
            margin-top: 0;
            margin-bottom: 0;
            padding-top: 10px;
            padding-bottom: 0;
        }
        .modal-body {
            padding-bottom: 0;
        }
        .bgact{
                /* background: rgba(255, 255,255, 0.4); */
                background: rgb(14 14 14 / 49%);
                padding: 15px;
        }

        @media (max-width: 360px) {
            .hero {
                margin-top: 80px;
                height: 300px; /* Reduz a altura do herói para economizar espaço */
            }
            .form-group {
                margin-bottom: 10px; /* Adiciona um espaço entre os campos de formulário */
            }
            .hero-lead {
                font-size: 24px; /* Reduz o tamanho da fonte do título */
            }
            .lead.text-center {
                font-size: 12px; /* Reduz o tamanho da fonte do texto de descrição */
            }
            .form-control {
                font-size: 12px; /* Reduz o tamanho da fonte dos campos de formulário */
            }
            .btn {
                font-size: 12px; /* Reduz o tamanho da fonte dos botões */
            }
            .navbar-brand {
                margin-left: 10px; /* Reduz o espaçamento da margem esquerda do logotipo */
                width: 150px; /* Reduz o tamanho do logotipo */
                font-size: 14px; /* Reduz o tamanho da fonte do logotipo */
            }
            .footer {
                padding: 10px; /* Adiciona um espaço interno ao rodapé */
            }
            footer{
                margin-top: 280px;
            }
            .bgact {
                margin-top: 100px;
                padding: 10px;
                width: 350%;
                margin-left: -125px;
            }
            .custom-select{
                margin-top: 10px;
            }
            .this{
                margin-top: 10px;
            }
        }
    </style>
</head>
<body>

<?php include 'include/nav.php';?>

<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="hero">
            <div class="row justify-content-md-center">
                <div class="col col-lg-3">
                </div>
                <div class="col col-lg-5" style="margin-top: 7%;">
                <?php
                        if ($session->message()) {
                            echo $session->message();
                        }
                    ?>
                    <!-- <h2 class="text-center hero-lead">Wedding Planning Starts Here</h2>
                    <p class="lead text-center" style="color:white;">START BY CREATING YOUR FREE ACCOUNT</p> -->
                    <form class="bgact" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <h2 class="text-center hero-lead">Inscreva-se para ter Acesso aos nosso Serviços</h2>
                        <p class="lead text-center" style="color:white;">COMECE PREECHENDO O FORMULÁRIO</p>
                             <div class="form-group">
                                 <input type="text" id="nome" class="form-control" name="nome" placeholder="Digite o Nome Completo">
                            </div>
                            
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Digite o seu Email">
                            </div>

                            <div class="form-row">
                                <div class="input-group  col-md-6">
                                     <input type="text" aria-describedby="phoneHelpBlock" class="form-control" name="telefone" id="telefone" placeholder="Digite o número do telefone">
                                </div>
                                <div class="input-group this col-md-6">
                                    <input type="password" aria-describedby="phoneHelpBlock" class="form-control" name="password" id="password" placeholder="Digite a palavra-passe">   
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="input-group this col-md-6">
                                     <input type="text" aria-describedby="phoneHelpBlock" class="form-control" name="endereco" id="endereco" placeholder="Digite o endereço">
                                </div>
                                <div class="input-group col-md-6">
                               
                        <select name="gender" class="custom-select" id="gender">
                            <option value="m">Masculino</option>
                            <option value="f">Feminino</option>
                        </select>
                                </div>
                            </div>

                            <div class="text-center mt-3">
                                <p style="font-size: 11px;color:white;">Ao clicar em "Increver" concordas com o uso do Site <br>  <a
                                            href="" title="" style="color: #b81717;font-weight: bold;">Termos de Uso</a></p>
                                <button type="submit" name="register" class="btn btn-danger btn-sm text-uppercase fb"
                                        style="margin-top: -5px;">Inscrever
                                </button>
                            </div>
                        </form>
                </div>
                <div class="col col-lg-3">
                </div>
            </div>
        </div><!-- end of hero -->
    </div> <!-- end of row justify-content-md-center -->
</div><!-- end of container-fluid  -->.

<footer class="pt-3">
    <div class="row">
        <div class="col-12 col-md">
            <div class="text-center">
                <small class="d-block mb-3 text-muted">Todos Direitos Reservados &copy; <?php echo date('Y')?></small>
            </div>
        </div>
    </div>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="js/savy.js"></script>
<script>

    $(document).ready(function () {
        $('#wedding_date').datepicker();
        <?php
        if($count == 0) {
        ?>
        $('#user_firstname').savy('load');
        $('#user_lastname').savy('load');
        $('#user_email').savy('load');
        $('#user_phone').savy('load');
        $('#wedding_date').savy('load');
        <?php } else { ?>
        $('#user_firstname').savy('destroy');
        $('#user_email').savy('destroy');
        $('#user_lastname').savy('destroy');
        $('#user_phone').savy('destroy');
        $('#wedding_date').savy('destroy');
        <?php } ?>
    });
</script>
</body>
</html>