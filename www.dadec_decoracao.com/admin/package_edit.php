<?php include 'include/init.php'; ?>
<?php


    if (!isset($_SESSION['id'])) { redirect_to("../"); }
    $category = Category::find_by_id($_GET['id']);

    if (isset($_POST['submit'])) {

        $wedding_type = clean($_POST['wedding_type']);
        $price = clean($_POST['price']);
       
         if (empty($wedding_type) || empty($price)) {
            redirect_to("services_list.php");
            $session->message("
            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert'></i></strong> Por favor preenche os campos vazios.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        }
        if ($category) {

            if(empty($_FILES['preview_image'])) {
                $category->wedding_type = $wedding_type;
                $category->price = $price;
                $category->update();
                redirect_to("service_list.php");
                $session->message("
                    <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                      <strong><i class='mdi mdi-check'></i></strong>The {$category->wedding_type} editado com sucesso.
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                      </button>
                    </div>");
            } else {
                $category->wedding_type = $wedding_type;
                $category->price = $price;
              $category->set_file($_FILES['preview_image']);
              $category->save_image();
              $category->save();
              // redirect_to("edit_user.php?id={$room->id}");
              $session->message("
                <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                  <strong><i class='mdi mdi-check'></i></strong>The {$category->title} editado com sucesso.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </div>");
              redirect_to("service_list.php");
            }
        }
    }
?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
    <!doctype html>
    <html lang="en">
    <head>
        <title>Editar Pacotes - Administrator</title>

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
            
                <form method="post" action="" enctype="multipart/form-data">

                    <h4 class="h4 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">Editar Tipos de Eventos</h4>
            
                    <?php
                        if ($session->message()) {
                            echo ' <div class="form-group col-md-12">' . $session->message() . '</div>';
                        }
                    ?>
                    
                    <div class="form-group">
                        <label for="wedding_type">Titulo do Evento</label>
                        <input type="text" name="wedding_type" class="form-control" id="wedding_type"  placeholder="Digite o Tipo de Evento" value="<?= $category->wedding_type ?>">
                    </div>

                    <div class="form-group">
                        <label for="price">Preço do Evento</label>
                        <input type="text" name="price" class="form-control" id="price"  placeholder="Digite o Preço do Evento"  value="<?= $category->price ?>">
                    </div>

                    <div class="form-group">
                        <label for="preview_image">Escolher Imagem</label><br>
                        <input type="file" name="preview_image" id="preview_image">
                   </div>

                    <a href="service_list.php" class="btn btn-sm btn-danger float-right" style="font-size: 12px;">Cancelar</a>

                   <button type="submit" name="submit" class="btn btn-sm btn-success float-right mr-2" style="font-size: 12px;">Editar</button>

                   </div>
</div>
</main>
<script src="js/app.js"></script>

            </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>
            </div>
            
            <div class="col-lg-4 mt-4">
                <img src="<?= $category->preview_image_picture(); ?>" width="380" height="306"  alt="">
            </div>
             </form><!-- end of input form -->
        </div>
    </div>



