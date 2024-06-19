<?php include_once 'admin/include/init.php';?>
<?php
 if (isset($_POST['login'])) {
     $input_email = clean($_POST['input_email']);
     $input_password= clean($_POST['input_password']);

     $logged = Cliente::login_user_cliente($input_email, $input_password);

     if($logged) {
         $session->login($logged);
         redirect_to("admin/client_profile.php?id=");
     } else {
         redirect_to("login.php");
         $session->message("
            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-alert'></i></strong>  Email ou Palavra-passe Inválidos. Por favor tente Novamente
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
     }
 }
?>
<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login - Cliente</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
<form class="form-signin" action="login.php" method="post">
    <a href="index.php"><img class="mb-4" src="images/logo/IMG-20240615-WA0011.jpg" width="190" ></a>
    <h3 class="h3 mb-3 font-weight-normal">Faça o Login</h3>
    <?php
        if ($session->message()) {
            echo $session->message();
        }
    ?>
    <label for="inputEmail" class="sr-only">Endereço de Email</label>
    <input type="text" id="inputEmail" name="input_email" class="form-control" placeholder="Email address" required autofocus>

    <label for="inputPassword" class="sr-only">Palavra-passe</label>
    <input type="password" id="inputPassword" name="input_password" class="form-control" placeholder="Password" required>

    <div class="checkbox mb-1">
        <label>
            <input type="checkbox" value="remember-me" name="remember"> Lembrar-me
        </label>

    </div>
    <a href="admin/login.php"> Entrar como Administrador</a><br>
    <a href="index.php">Ir a Página Inicial</a>
    <br><br>
    <button class="btn btn-lg btn-success btn" type="submit" name="login">Login</button>
    <a class="btn btn-lg btn-danger btn" href="sign_up.php" type="submit" name="login">Inscrever-se</a>
    <p class="mt-5 mb-3 text-muted">&copy; 2023-2024</p>
</form>
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $('.your-checkbox').prop('indeterminate', true);
</script>
</body>
</html>
