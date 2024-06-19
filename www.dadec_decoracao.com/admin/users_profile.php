<?php include 'include/init.php'; ?>
<?php
     if (!isset($_SESSION['id'])) {
         redirect_to("../");
     }
?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
<?php 
    if (isset($_POST['submit'])) {
            $nome    = clean($_POST['nome']);
            $address     = clean($_POST['address']);
            $email       = clean($_POST['email']);
            $username    = clean($_POST['username']);
            $gender      = clean($_POST['gender']);
            $designation = clean($_POST['designation']);
            

             if (empty($nome) || empty($address) || empty($email) || empty($username)) {
                redirect_to("users_profile.php");
                $session->message("
                <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                  <strong><i class='mdi mdi-account-alert'></i></strong> Por favor preencha os campos.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </div>");
                die();
            }

            if ($users_profile) {
                $users_profile->nome = $nome;
                $users_profile->endereco = $address;
                $users_profile->email = $email;
                $users_profile->usuario = $username;
                $users_profile->genero = $gender;
                $users_profile->designacao = $designation;
                // $users_profile->date_created = date("F j, Y, g:i a"); 

                if(empty($_FILES['profile_picture'])) {
                  $users_profile->save();
                   redirect_to("users_profile.php");
                  $session->message("
                    <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                      <strong><i class='mdi mdi-check'></i></strong>{$users_profile->nome} atualizado com sucesso.
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                      </button>
                    </div>");
                } else {
                  $users_profile->set_file($_FILES['profile_picture']);
                  $users_profile->save_image();
                  $users_profile->save();
                  redirect_to("users_profile.php");
                  $session->message("
                    <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                      <strong><i class='mdi mdi-check'></i></strong>{$users_profile->nome} atualizado com sucesso.
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                      </button>
                    </div>");
                }
            }
        }
?>
<!doctype html>
<html lang="pt">
<head>
    <title>Editar Perfil - Administrador</title>
    <?php
        include 'include/header.php';
    ?>

    <style>
        table.table.table-striped.table-bordered.table-sm {
            font-size:12px;
        }
        .tooltip {
            font-size: 12px;
        }

        td.special {
            padding: 0;
            padding-top: 8px;
            padding-left:6px;
            padding-bottom:6px;
            margin-top:5px;
            text-transform: capitalize;
        }
        .datepicker {
            font-size: 12px;
        }
        div.dataTables_wrapper div.dataTables_paginate {
            font-size: 11px;
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

         .box-shadow {
            box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.3);
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

<div class="row">
    <div class="col-lg-8 offset-2 pl-3 pb-3 box-shadow mt-4">
            <form method="post" action="" enctype="multipart/form-data">
            
                <h6 class="h6 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">Detalhes do Perfil
                   
                </h6>

                <?php
                    if ($session->message()) {
                        echo ' <div class="form-group col-md-12">' . $session->message() . '</div>';
                    }
                ?>


                <div class="text-center mb-3 mt-3">
                    <img src="<?= $users_profile->profile_picture_picture(); ?>" style="border-radius: 50%; width: 200px;height: 200px;diplay:block;" alt="">
                       
                </div>
                <div class="custom-file mb-3" style="font-size: 13px;">
                  <input type="file" class="custom-file-input" id="customFile" name="profile_picture">
                  <label class="custom-file-label" for="customFile">Editar Foto de Perfil</label>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputFirstname">Nome Completo:</label>
                        <input type="text" name="nome" class="form-control" value="<?= $users_profile->nome; ?>" id="inputFirstname"  placeholder="Digite o Nome">
                    </div>
                   
                </div>
                
                <div class="form-group">
                    <label for="inputEmail">Email:</label>
                    <input type="text" name="email" class="form-control"  value="<?= $users_profile->email; ?>" id="inputEmail" placeholder="Digite o Email">
                </div>

                <div class="form-group">
                    <label for="inputUsername">Usuário:</label>
                    <input type="text" name="username" class="form-control"  value="<?= $users_profile->usuario; ?>" id="inputUsername" placeholder="Digite o Nome do Usuário">
                </div>

                 <div class="form-group">
                        <label for="gender">Genéro:</label>
                        <select name="gender" class="custom-select" id="gender">
                            <?php if($users_profile->genero == 'm') : ?>
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
                    <textarea rows="5" name="address" class="form-control" id="inputAddress"  placeholder="Enter address"><?= $users_profile->endereco;  ?></textarea>
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

                 <a href="users.php" class="btn btn-sm btn-danger float-right" style="font-size: 12px;">
                    <i class="mdi mdi-close-circle mr-2"></i> Cancelar
                </a>

                <button type="submit" name="submit" class="btn btn-sm btn-success float-right mr-2" style="font-size: 12px;">
                    <i class="mdi mdi-account-plus mr-2"></i> Editar Minha Conta
                </button>
            </form><!-- end of input form -->
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