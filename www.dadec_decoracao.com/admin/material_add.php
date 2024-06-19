<?php 
    include 'include/init.php'; 
    $count = 0;
    $error = '';
    if (!isset($_SESSION['id'])) { redirect_to("../"); }

    $material =  new Material();

    if (isset($_POST['submit']) || isset($_FILES['preview_image'])) {

        $nome_material = clean($_POST['nome']);
        $preco = clean($_POST['preco']);
        $quantidade = clean($_POST['quantidade']);
        
         if (empty($nome_material) || empty($preco) || empty($quantidade)) {
            redirect_to("material_add.php");
            $session->message("
            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert mr-2'></i></strong> Por favor preencha os campos.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        }

        $material->nome = $nome_material;
        $material->preco = $preco;
        $material->quantidade = $quantidade;
        $material->set_file($_FILES['preview_image']);
        $material->save_image();

         if ($material->save()) {
            redirect_to("material.php");
            $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert mr-2'></i></strong> O {$material->nome} adicionado com sucesso.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        } else {
            $msg = join("<br>", $material->errors);
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
                    <h4 class="h4 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">Cadastrar Materiais
                    <br><br>
                    <div class="btn-group mr-2">
                        <a href="material.php" class="btn btn-sm btn-danger float-right" style="font-size: 12px;"><i class="mdi mdi-close-circle mr-2"></i> Cancelar</a>

                        <button type="submit" name="submit" class="btn btn-sm btn-success float-right mr-2" style="font-size: 12px;"><i class="mdi mdi-account-plus mr-2"></i> Salvar Novo Material</button>
                    </div>
                    </h4>
                        <?php
                            if ($session->message()) {
                                echo  $session->message();
                            }
                        ?>
                        <div class="form-group">
                        <label for="wedding_type">Nome do Material</label>
                        <input type="text" name="nome" class="form-control" id="nome"  placeholder="Digite o Nome do Material">
                        </div>

                        <div class="form-group">
                        <label for="wedding_type">Preço Unitário:</label>
                        <input type="text" name="preco" class="form-control" id="preco"  placeholder="Digite o Preço do Material">
                        </div>

                        <div class="form-group">
                        <label for="wedding_type">Quantidade</label>
                        <input type="text" name="quantidade" class="form-control" id="quantidade"  placeholder="Digite a Quantidade do Material">
                        </div>

                    <div class="form-group">
                        <input type="file" name="preview_image" onchange="document.getElementById('preview_image').src = window.URL.createObjectURL(this.files[0])">
                    </div>
                </form><!-- end of input form -->
            </div>
            <div class="col-lg-3 mt-4">
                <img id="preview_image" src="https://via.placeholder.com/350x350" width="300" height="350" alt="">
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
