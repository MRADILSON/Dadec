<?php include 'include/init.php'; ?>
<?php


    if (!isset($_SESSION['id'])) { redirect_to("../"); }

    $users = new Users();

    if (isset($_POST['submit'])) {
        $nome    = clean($_POST['nome']);
        $address     = clean($_POST['address']);
        $email       = clean($_POST['email']);
        $username    = clean($_POST['username']);
        $password    = clean($_POST['password']);
        $password2   = clean($_POST['password2']);
        $gender      = clean($_POST['gender']);
        $designation = clean($_POST['designation']);

         if (empty($nome) || empty($address) || empty($email) || empty($username) || empty($gender) ) {
            redirect_to("users_add.php?nome=" . $nome."&address=".$address."&gender=" . $gender . "&designation=" . $designation."&email=" . $email."&user=".$username);
            $session->message("
            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert'></i></strong> Por favor prenchaas informações.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        }

        if ($password != $password2) {

            redirect_to("users_add.php");
            $session->message("
            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert'></i></strong> Palavra-passe não válida.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();

        } else {

            $users->nome = $nome;
            $users->endereco = $address;
            $users->email = $email;
            $users->usuario = $username;
            $users->password = md5($password);
            $users->genero = $gender;
            $users->designacao = $designation;
            $users->set_file($_FILES['profile_picture']);
            $users->save_image();
           
            $users->data_criacao = date("F j, Y, g:i a"); 
            $users->save();
            $users->save1();
            
            redirect_to("users.php?");
            $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-check'></i></strong> {$users->nome} Adicionado com sucesso.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
        }
    }
?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Adicionar Usuário- Administrador</title>
    <?php
        include 'include/header.php';
    ?>

    <style>
        body {
            margin-bottom: 2%;
        }
        .box-shadow {
            box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.3);
            font-size: 12px;
        }
        .form-control {
            font-size: 12px;
        }
        .datepicker {
            font-size: 12px;
        }
        @media (max-width: 890px) {

.content{
    margin: 0px 0px 0px 0px;
    width: 100%;
    padding: 0px 0px 0px 0px;
}

.row{
    margin-left: -60px;
    width: 100%;  
    padding: 0px 0px 0px 0px;
}

.footer{
    margin-left: 40px;
}
}
    </style>
</head>

<body>

<div class="wrapper">
        <?php include 'include/menu.php'; ?>

        <div class="main">
            <?php 
                include 'include/topo1.php'; 
            ?>


            <main class="content">

<div class="container">

    <div class="row">

        <div class="col-lg-8 offset-2 pl-3 pb-3 box-shadow mt-4">
        
            <form method="post" action="" enctype="multipart/form-data">
            <div class="btn-group mr-2">
                <h4 class="h4 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">Nova Informação de Usuário <br><br>
                    <a href="users.php" class="btn btn-sm btn-danger float-right" style="font-size: 12px;"><i class="mdi mdi-close-circle mr-2"></i> Cancelar</a>

                    <button type="submit" name="submit" class="btn btn-sm btn-success float-right mr-2" style="font-size: 12px;"><i class="mdi mdi-account-plus mr-2"></i> Salvar Usuário</button>
                </h4>
            </div>
                <?php
                    if ($session->message()) {
                        echo $session->message();
                    }
                ?>

                <div class="form-row">
                        <label for="inputFirstname">Nome Completo:</label>
                        <input type="text" name="nome" class="form-control" id="inputFirstname"  placeholder="Digite o Nome completo">
                    
                  
                </div>
                
                <div class="form-group">
                    <label for="inputEmail">Email:</label>
                    <input type="text" name="email" class="form-control" id="inputEmail" placeholder="Digite o Email">
                </div>

                <div class="form-group">
                    <label for="inputUsername">Usuário:</label>
                    <input type="text" name="username" class="form-control" id="inputUsername" placeholder="Digite o nome do Usuário">
                </div>

                <div class="form-group">
                    <label for="inputpassword">Password:</label>
                    <input type="password" name="password" class="form-control" id="inputpassword" placeholder="Digite a Password">
                </div>

                <div class="form-group">
                    <label for="inputpasswordConfirm">Confirmar a Password:</label>
                    <input type="password" name="password2" class="form-control" id="inputpasswordConfirm" placeholder="Confirmar a password">
                </div>


                 <div class="form-group">
                        <label for="gender">Genero:</label>
                        <select name="gender" class="custom-select" id="gender">
                            <option value="m">Masculino</option>
                            <option value="f">Feminino</option>
                        </select>
                    </div>

                <div class="form-group">
                    <label for="inputAddress">Endereço</label>
                    <textarea rows="5" name="address" class="form-control" id="inputAddress"  placeholder="Digite o Endereço"></textarea>
                </div>

                 <div class="form-group">
                    <label for="designation">Designação:</label>
                    <select name="designation" id="designation" class="custom-select">   
                    <option value="Administrador">Administrador</option>
                        <option value="Funcionario">Funcionario</option>
                    </select>
                </div>
                  <div class="form-group">
                    <label for="inputProfilePicture">Imagem de Perfil</label>
                    <input type="file" name="profile_picture" class="form-control-file" id="inputProfilePicture">
                  </div>
            </form><!-- end of input form -->
        </div>
    </div>
</div>




</main>
</div>
</div>
<script src="js/app.js"></script>

            </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="js/popper.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

</script>

</body>
</html>
