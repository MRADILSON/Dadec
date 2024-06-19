<?php include 'include/init.php'; ?>
<?php
     if (!isset($_SESSION['id'])) {
        redirect_to("../");
     }
?>
<?php $cliente_profile = Cliente::find_by_id($_SESSION['id']); ?>
<?php 
    if (isset($_POST['submit'])) {
        $nome = clean($_POST['nome']);
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        $genero = clean($_POST['gender']);
        $telefone = clean($_POST['telefone']);
        $endereco = clean($_POST['endereco']);
        $data = clean($_POST['data']);
            

             if (empty($data) || empty($nome) || empty($email) || empty($password) || empty($genero) || empty($telefone) || empty($endereco)) {
                redirect_to("client_profile.php");
                $session->message("
                <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                  <strong><i class='mdi mdi-account-alert'></i></strong> Por favor preencha os campos.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </div>");
                die();
            }

            if ($cliente_profile) {
                $cliente_profile->nome = $nome;
                $cliente_profile->email = $email;
                $cliente_profile->password=$password;
                $cliente_profile->genero = $genero;
                $cliente_profile->telefone = $telefone;
                $cliente_profile->endereco = $endereco;
                //$cliente->estado = $status;
                $cliente_profile->data_criacao  = $data;
                $cliente_profile->save();
                // $users_profile->date_created = date("F j, Y, g:i a"); 

                if(empty($_FILES['profile_picture'])) {
                  $cliente_profile->save();
                   redirect_to("client_profile.php");
                  $session->message("
                    <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                      <strong><i class='mdi mdi-check'></i></strong>{$cliente_profile->nome} atualizado com sucesso.
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                      </button>
                    </div>");
                } else {
                  $cliente_profile->set_file($_FILES['profile_picture']);
                  $cliente_profile->save_image();
                  $cliente_profile->save();
                  redirect_to("client_profile.php");
                  $session->message("
                    <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                      <strong><i class='mdi mdi-check'></i></strong>{$cliente_profile->nome} atualizado com sucesso.
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                      </button>
                    </div>");
                }
            }
        }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
<title>Perfil do Cliente</title>
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
            font-size: 12px;
            margin-top: 200px;
           background-color: white;
        }

        form{
            border-style: none;
            padding: 20px;
        }

        @media (max-width: 890px) {

            .content{
                margin: 0px 0px 0px 0px;
                width: 100%;
                padding: 0px 0px 0px 0px;
            }

            .card{
                margin-left: -60px;
                width: 100%;  
                padding: 0px 0px 0px 0px;
            }
        }
    </style>
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<body>
    <div class="wrapper">
        <?php include 'include/menu1.php'; ?>

        <div class="main">
            <?php 
                include 'include/topo.php'; 
            ?>


            <main class="content">
            <div class="col-lg-8 offset-2 pl-3 pb-3 box-shadow mt-4">
            <div class="card">
            <form class="form1" method="post" action="" enctype="multipart/form-data">
            
                <h6 class="h6 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">Detalhes do Perfil
                   
                </h6>

                <?php
                    if ($session->message()) {
                        echo ' <div class="form-group col-md-12">' . $session->message() . '</div>';
                    }
                ?>

                <div class="text-center mb-3 mt-3 thiis">
                    <img src="<?= $cliente_profile->profile_picture_picture(); ?>" style="border-radius: 50%; width: 200px;height: 200px;diplay:block;" alt="">
                       
                </div>
                
                <div class="custom-file mb-3" style="font-size: 13px;">
                  <input type="file" class="custom-file-input" id="customFile" name="profile_picture">
                  <label class="custom-file-label" for="customFile">Editar Foto de Perfil</label>
                </div>
                <div class="form-group">
                                 <input type="text" id="nome" class="form-control" name="nome" value="<?= $cliente_profile->nome; ?>" placeholder="Digite o Nome Completo">
                            </div>
                            
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" value="<?= $cliente_profile->email; ?>" placeholder="Digite o seu Email">
                            </div>

                            <div class="form-row">
                                <div class="input-group col-md-6">
                                     <input type="text" aria-describedby="phoneHelpBlock" class="form-control" value="<?= $cliente_profile->telefone; ?>" name="telefone" id="telefone" placeholder="Digite o número do telefone">
                                </div>
                                <div class="input-group col-md-6">
                                    <input type="password" aria-describedby="phoneHelpBlock" class="form-control" value="<?= $cliente_profile->password; ?>" name="password" id="password" placeholder="Digite a palavra-passe"> 
                                    <input type="hidden" value="<?= $cliente_profile->data_criacao; ?>" name="data" id="data">     
                                </div>
                            </div><br>

                            <div class="form-row">
                                <div class="input-group col-md-6">
                                     <input type="text" aria-describedby="phoneHelpBlock" class="form-control" name="endereco" value="<?= $cliente_profile->endereco; ?>" id="endereco" placeholder="Digite o endereço">
                                </div>
                                <div class="input-group col-md-6">
                               
                                <select name="gender" class="custom-select" id="gender">
                               <option value="m" <?php echo ($cliente_profile->genero == 'm') ? 'selected' : ''; ?>>Masculino</option>
                                <option value="f" <?php echo ($cliente_profile->genero == 'f') ? 'selected' : ''; ?>>Feminino</option>
                        
                                </select>
                                
                            </div><br>
                            
                            <div class="form-group">
                                <br><br>
                            <button type="submit" name="submit" class="btn btn-sm btn-success btn-block mr-2" style="font-size: 12px;">
                                <i class="mdi mdi-account-plus mr-2"></i> Editar Minha Conta
                            </button>
                            </div>
                            
                            
            </form><!-- end of input form -->
            <script src="js/app.js"></script>
            <footer class="footer">
                <?php include 'include/footer1.php' ?>
            </footer>
    <div class="col-lg-4 offset-lg-4 mt-4">
                <img id="preview_image" src="<?= $cliente_profile->preview_image_picture(); ?>" width="300" height="350" alt="Imagem">
            </div>

            </div>
            </div>
            </main>

           
          
        </div>
    </div>

   
   

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>
</body>

</html>


