<?php 
    include 'include/init.php'; 
    $count = 0;
    $error = '';
    if (!isset($_SESSION['id'])) { redirect_to("../"); }


    $funcionario =   Funcionario::find_by_id($_GET['id']);

    if (isset($_POST['submit'])) {

        $nome_funcionario = clean($_POST['nome']);
        $idade = clean($_POST['idade']);
        $contacto = clean($_POST['contacto']);
        $endereco = clean($_POST['endereco']);
        $funcao = clean($_POST['funcao']);
        $salario = clean($_POST['salario']);
        
        if (empty($nome_funcionario) || empty($idade) || empty($contacto) || empty($endereco) || empty($funcao) || empty($salario)){
            redirect_to("funcionario.php");
            $session->message("
            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert mr-2'></i></strong> Por favor preencha os campos.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        }else{
        $funcionario->nome = $nome_funcionario;
        $funcionario->idade = $idade;
        $funcionario->contacto = $contacto;
        $funcionario->endereco = $endereco;
        $funcionario->funcao = $funcao;
        $funcionario->salario = $salario;

         if ($funcionario->save()) {
            redirect_to("funcionario.php");
            $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert mr-2'></i></strong> O {$funcionario->nome} Atualizado com sucesso.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        } else {
            $msg = join("<br>", $funcionario->errors);
        }
        }
    }
?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
    <!doctype html>
    <html lang="pt">
    <head>
        <title>Materias - Administrator</title>
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

            <div class="col-lg-8 pl-3 pb-3 box-shadow mt-4">
               
                <form action="" method="post" enctype="multipart/form-data">
                    <?= isset($msg) ? $msg : ''; ?>
                    <h4 class="h4 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">Editar Funcionários
                    <br><br>
                    <div class="btn-group mr-2">
                        <a href="funcionario.php" class="btn btn-sm btn-danger float-right" style="font-size: 12px;"><i class="mdi mdi-close-circle mr-2"></i> Cancelar</a>

                        <button type="submit" name="submit" class="btn btn-sm btn-success float-right mr-2" style="font-size: 12px;"><i class="mdi mdi-account-plus mr-2"></i> Editar</button>
                    </div>
                    </h4>
                        <?php
                            if ($session->message()) {
                                echo  $session->message();
                            }
                        ?>
                        <div class="form-group">
                        <label for="wedding_type">Nome do Funcionário:</label>
                        <input type="text" name="nome" class="form-control" id="nome" value="<?= $funcionario->nome; ?>"  placeholder="Digite o Nome do Funcionario">
                        </div>

                        <div class="form-group">
                        <label for="wedding_type">Idade:</label>
                        <input type="text" name="idade" class="form-control" id="idade" value="<?= $funcionario->idade; ?>"  placeholder="Digite a Idade do Funcionário">
                        </div>

                        <div class="form-group">
                        <label for="wedding_type">Contacto:</label>
                        <input type="text" name="contacto" class="form-control" id="contacto" value="<?= $funcionario->contacto; ?>"  placeholder="Digite o Número de Telefone">
                        </div>

                        <div class="form-group">
                        <label for="wedding_type">Endereço:</label>
                        <input type="text" name="endereco" class="form-control" id="endereco" value="<?= $funcionario->endereco; ?>"  placeholder="Digite o Endreço">
                        </div>

                        <div class="input-group col-md-6">
                            <label for="funcao">Função:</label><br>                             
                        <select name="funcao" class="custom-select" id="funcao">
                        <option value="Administrador" <?php echo ($funcionario->funcao == 'Administrador') ? 'selected' : ''; ?>>Administrador</option>
                        <option value="Funcionario" <?php echo ($funcionario->funcao == 'Funcionario') ? 'selected' : ''; ?>>Funcionario</option>
                        
                        </select>
                        </div>

                        <div class="form-group">
                        <label for="wedding_type">Salário:</label>
                        <input type="text" name="salario" class="form-control" id="salario" value="<?= $funcionario->salario; ?>"  placeholder="Digite o Salário">
                        </div>
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
        $('[data-toggle="tooltip"]').tooltip();
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
