<?php include 'include/init.php'; ?>
<?php


    if (!isset($_SESSION['id'])) { redirect_to("../"); }

    $users = Users::find_by_id($_GET['id']);

    if (isset($_POST['submit'])) {
        $nome    = clean($_POST['nome']);
        $address     = clean($_POST['address']);
        $email       = clean($_POST['email']);
        $username    = clean($_POST['username']);
        $gender      = clean($_POST['gender']);
        $designation = clean($_POST['designation']);

         if (empty($nome) || empty($address) || empty($email) || empty($username)) {
            redirect_to("users_edit.php");
            $session->message("
            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert'></i></strong> Por favor preencha todo formulário.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        }

        if ($users) {
            $users->nome = $nome;
            $users->endereco = $address;
            $users->email = $email;
            $users->usuario = $username;
            $users->genero = $gender;
            $users->designacao = $designation;
            // $users->date_created = date("F j, Y, g:i a"); 

            if(empty($_FILES['profile_picture'])) {
              $users->save();
               redirect_to("users.php");
              $session->message("A foto foi atualizada com sucesso");
            } else {
              $users->set_file($_FILES['profile_picture']);
              $users->save_image();
              $users->save();
              redirect_to("users.php");
              $session->message("
                <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                  <strong><i class='mdi mdi-check'></i></strong> {$users->nome} atualizado com sucesso.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </div>");
            }
        }
    }
?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
<!doctype html>
<html lang="pt">
<head>
    <title>Adcionar Usuário - Administrador</title>
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
        .custom-file-label {
            color: #212529;
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
            
                <h6 class="h6 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">Editar Informações do Usuário
                <br><br><div class="btn-group mr-2">    
                <a href="users.php" class="btn btn-sm btn-danger float-right" style="font-size: 12px;"><i class="mdi mdi-close-circle mr-2"></i> Cancelar</a>

                    <button type="submit" name="submit" class="btn btn-sm btn-success float-right mr-2" style="font-size: 12px;"><i class="mdi mdi-account-plus mr-2"></i> Editar Usuário</button>
                </div>
                </h6>

                <?php
                    if ($session->message()) {
                        echo ' <div class="form-group col-md-12">' . $session->message() . '</div>';
                    }
                ?>

                <div class="text-center mb-3 mt-3">
                    <img src="<?= $users->profile_picture_picture(); ?>" style="border-radius: 50%; width: 300px;height: 300px;diplay:block;" alt="">
                       
                </div>
               <!--   <div class="form-group">
                    <label for="inputProfilePicture">Insert New Image</label>
                    <input type="file" name="profile_picture" class="form-control-file" id="inputProfilePicture">
                </div>
 -->
                <div class="custom-file mb-3" style="font-size: 13px;">
                  <input type="file" class="custom-file-input" id="customFile" name="profile_picture">
                  <label class="custom-file-label" for="customFile">Editar Foto de Perfil</label>
                </div>
                <div class="form-row">
                  
                        <label for="inputLastname">Nome completo:</label>
                        <input type="text" name="nome" class="form-control" value="<?= $users->nome; ?>" id="inputLastname"  placeholder="Digite o Nome completo">
                   
                   
                </div>
                
                <div class="form-group">
                    <label for="inputEmail">Email:</label>
                    <input type="text" name="email" class="form-control"  value="<?= $users->email; ?>" id="inputEmail" placeholder="Digite o email">
                </div>

                <div class="form-group">
                    <label for="inputUsername">Username:</label>
                    <input type="text" name="username" class="form-control"  value="<?= $users->usuario; ?>" id="inputUsername" placeholder="Digite o nome de Usuário">
                </div>

                 <div class="form-group">
                        <label for="gender">Genero:</label>
                        <select name="gender" class="custom-select" id="gender">
                            <?php if($users->gender == 'm') : ?>
                                <option value="m" selected>Masculino</option>
                                <option value="f">Feminino</option>
                            <?php else: ?>
                                <option value="m">Masculino</option>
                                <option value="f" selected>Feminino</option>
                            <?php endif; ?>
                        </select>
                    </div>

                <div class="form-group">
                    <label for="inputAddress">Endereco</label>
                    <textarea rows="5" name="address" class="form-control" id="inputAddress"  placeholder="Enter address"><?= $users->endereco;  ?></textarea>
                </div>

                 <div class="form-group">
                    <label for="designation">Designação:</label>
                    <select name="designation" id="designation" class="custom-select">
                        <?php if($users->designacao == 'Administrador') : ?>
                            <option value="Administrador" selected>Administrador</option>
                            <option value="Funcionario">Funcionario</option>
                        <?php else: ?>
                            <option value="Administrador">Administrador</option>
                            <option value="Funcionario" selected>Funcionario</option>
                        <?php endif; ?>
                    </select>
                </div>
                  
            </form><!-- end of input form -->
        </div>
    </div>
</div>


</div>
</div>
</main>
<script src="js/app.js"></script>
            <footer class="footer">
                <?php include 'include/footer1.php' ?>
            </footer>
            </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>
