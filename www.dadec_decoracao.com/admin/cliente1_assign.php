<?php include 'include/init.php'; ?>
<?php
    if (!isset($_SESSION['id'])) { redirect_to("../"); }

    //$booking_id = $_GET['booking'];
    $client_id = $_GET['id'];

   // $accounts =  Accounts::find_by_user_id($user_id);
   // $account_detail =  Account_Details::find_by_user_id($user_id);
   // $booking_detail =  Booking::find_by_booking_id($booking_id);
 	//$categories = Category::find_all();

    $cliente = Cliente::find_client_id($client_id);
 	
    if (isset($_POST['inactivo'])) {

        if ($cliente) {
            $nome = clean($_POST['nome']);
            $email = clean($_POST['email']);
            $password = clean($_POST['password']);
            $genero = clean($_POST['gender']);
            $telefone = clean($_POST['telefone']);
            $endereco = clean($_POST['endereco']);
            $data_criacao = $cliente->data_criacao;
            $status = "inactivo";

            $cliente->nome = $nome;
            $cliente->email = $email;
            $cliente->password=$password;
            $cliente->genero = $genero;
            $cliente->telefone = $telefone;
            $cliente->endereco = $endereco;
            $cliente->estado = $status;
            $cliente->data_criacao  =  $data_criacao;
            $cliente->save();

           redirect_to("cliente1.php");

            $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-approval'></i></strong> {$cliente->nome} Desativado com sucesso.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");

        }
    }


if (isset($_POST['editar'])) {

            $nome = clean($_POST['nome']);
            $email = clean($_POST['email']);
            $password = clean($_POST['password']);
            $genero = clean($_POST['gender']);
            $telefone = clean($_POST['telefone']);
            $endereco = clean($_POST['endereco']);
            $data_criacao = $cliente->data_criacao;
            //$status = "activo";

            $cliente->nome = $nome;
            $cliente->email = $email;
            $cliente->password=$password;
            $cliente->genero = $genero;
            $cliente->telefone = $telefone;
            $cliente->endereco = $endereco;
            //$cliente->estado = $status;
            $cliente->data_criacao  = $data_criacao;
            $cliente->save();

           redirect_to("cliente1.php");

            $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-approval'></i></strong> {$cliente->nome} Editado com sucesso.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");

        }

        if (isset($_POST['activar'])) {

            if ($cliente) {
                $nome = clean($_POST['nome']);
                $email = clean($_POST['email']);
                $password = clean($_POST['password']);
                $genero = clean($_POST['gender']);
                $telefone = clean($_POST['telefone']);
                $endereco = clean($_POST['endereco']);
                $data_criacao = $cliente->data_criacao;
                $status = "activo";
    
                $cliente->nome = $nome;
                $cliente->email = $email;
                $cliente->password=$password;
                $cliente->genero = $genero;
                $cliente->telefone = $telefone;
                $cliente->endereco = $endereco;
                $cliente->estado = $status;
                $cliente->data_criacao  =  $data_criacao;
                $cliente->save();
    
               redirect_to("cliente1.php");
    
                $session->message("
                <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                  <strong><i class='mdi mdi-approval'></i></strong> {$cliente->nome} Desativado com sucesso.
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
       
        <title>Editar Cliente - Administrator</title>
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

                <form method="post" action="">

                    <h4 class="h4 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">Informações do Cliente
						<a href="cliente1.php" class="btn btn-sm btn-light float-right mr-2 active" style="font-size: 12px;">
							<span class="mdi mdi-arrow-left"></span> Voltar 
						</a>

                         </h4>
                            <div class="form-group">
                                 <input type="text" id="nome" class="form-control" name="nome" value="<?= $cliente->nome; ?>" placeholder="Digite o Nome Completo">
                            </div>
                            
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" id="email" value="<?= $cliente->email; ?>" placeholder="Digite o seu Email">
                            </div>

                            <div class="form-row">
                                <div class="input-group col-md-6">
                                     <input type="text" aria-describedby="phoneHelpBlock" class="form-control" value="<?= $cliente->telefone; ?>" name="telefone" id="telefone" placeholder="Digite o número do telefone">
                                </div>
                                <div class="input-group col-md-6">
                                    <input type="password" aria-describedby="phoneHelpBlock" class="form-control" value="<?= $cliente->password; ?>" name="password" id="password" placeholder="Digite a palavra-passe">   
                                </div>
                            </div><br>

                            <div class="form-row">
                                <div class="input-group col-md-6">
                                     <input type="text" aria-describedby="phoneHelpBlock" class="form-control" name="endereco" value="<?= $cliente->endereco; ?>" id="endereco" placeholder="Digite o endereço">
                                </div>
                                <div class="input-group col-md-6">
                               
                        <select name="gender" class="custom-select" id="gender">
                        <option value="m" <?php echo ($cliente->genero == 'm') ? 'selected' : ''; ?>>Masculino</option>
                        <option value="f" <?php echo ($cliente->genero == 'f') ? 'selected' : ''; ?>>Feminino</option>
                        
                        </select>
                                </div>
                            </div><br>                 

					<button type="submit" name="editar" class="btn btn-sm btn-success float-right mr-2" style="font-size: 12px;" value="">
						<i class="mdi mdi-linux mr-2"></i> Editar
					</button>
                    <button type="submit" name="activar" class="btn btn-sm btn-success float-right mr-2" style="font-size: 12px;" value="">
						<i class="mdi mdi-linux mr-2"></i> Ativar
					</button>
                    <button type="submit" name="inactivo" class="btn btn-sm btn-primary float-right mr-2" style="font-size: 12px;">
                    	<i class="mdi mdi-check mr-2"></i> Desativar
                    </button>

                </form><!-- end of input form -->
            </div>
        </div>
    </div>
</main>
</div>
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
    });
</script>

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
</body>
</html>