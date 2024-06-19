<?php 
    include 'include/init.php'; 
    $count = 0;
    $error = '';
    if (!isset($_SESSION['id'])) { redirect_to("../"); }

    // $booking_id = $_GET['category'];
    // $user_id = $_GET['user_id'];
    $category = Category::find_all();
    $event_wedding =  new EventWedding();
    // $account_detail =  new Account_Details();
    // $booking_detail =  new category();

    if (isset($_POST['submit']) || isset($_FILES['preview_image'])) {

        $title = clean($_POST['title']);
        $description = clean($_POST['description']);
        $wedding_date = clean($_POST['wedding_date']);
        $location = clean($_POST['location']);
        $status = clean($_POST['status']);
        $wedding_type = clean($_POST['wedding_type']);
        
         if (empty($title) || empty($description) || empty($wedding_date) || empty($location)) {
            redirect_to("blog_events_add.php");
            $session->message("
            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert mr-2'></i></strong> Por favor preencha os campos.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        }

        if ($status == 1) {
            $event_wedding->date_published = date("F j, Y, g:i a");
        }

        $event_wedding->wedding_type = $wedding_type;
        $event_wedding->title = $title;
        $event_wedding->description = $description;
        $event_wedding->wedding_date = $wedding_date;
        $event_wedding->location = $location;
        $event_wedding->status  = $status;
        $event_wedding->date_created  = date("F j, Y, g:i a");
        $event_wedding->set_file($_FILES['preview_image']);
        $event_wedding->save_image();

         if ($event_wedding->save()) {
            redirect_to("blog_events.php");
            $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert mr-2'></i></strong>  {$event_wedding->title} Salvo com sucesso.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        } else {
            $msg = join("<br>", $event_wedding->errors);
        }
    }
?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
    <!doctype html>
    <html lang="pt">
    <head>
        <title>Nova Publicação - Administrator</title>
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
                    <h4 class="h4 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">Nova Publicação
<br><br>
                    <div class="btn-group mr-2">
                        <a href="blog_events.php" class="btn btn-sm btn-danger float-right" style="font-size: 12px;"><i class="mdi mdi-close-circle mr-2"></i> Cancelar</a>

                        <button type="submit" name="submit" class="btn btn-sm btn-success float-right mr-2" style="font-size: 12px;"><i class="mdi mdi-account-plus mr-2"></i> Salvar</button>
                        </div>
                    </h4>
                        <?php
                            if ($session->message()) {
                                echo  $session->message();
                            }
                        ?>
                        <div class="form-group">
                            <label for="booking_id">Tipo de Evento:</label>
                            <select class="custom-select form-control" id="wedding_type" name="wedding_type">
                              <?php foreach($category as $category_item) : ?>
                                  <option value="<?= $category_item->wedding_type; ?>" selected><?= ucfirst($category_item->wedding_type); ?></option>
                              <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="wedding_post">Poste de Evento relacionado:</label>
                            <select class="custom-select form-control" id="wedding_type" name="wedding_post">
                              <?php foreach($category as $category_item) : ?>
                                  <option value="<?= $category_item->wedding_type; ?>" selected><?= ucfirst($category_item->wedding_type); ?></option>
                              <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Titulo</label>
                            <input type="text" name="title" 
                            class="form-control" 
                            id="title"  
                            placeholder="Digite o Titulo do Artigo">
                        </div>

                    <div class="form-group">
                        <label for="description">Descrição:</label>
                        <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Digite a descrição deste evento"></textarea>
                    </div>

                    <div class="form-group">
                        <input type="file" name="preview_image" onchange="document.getElementById('preview_image').src = window.URL.createObjectURL(this.files[0])">
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control"
                                   name="wedding_date"  data-provide="datepicker" id="wedding_date"
                                   placeholder="Data do Evento">
                            <div class="input-group-append">
                                    <span class="input-group-text"
                                          style="background: white;">
                                        <i style="color:#19b5bc;" class="mdi mdi-calendar-check"
                                            id="review" aria-hidden="true"></i>
                                    </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="location">Localização:</label>
                        <input type="text" name="location" class="form-control"  id="location" placeholder="Digite a Localização">
                    </div>

                    <div class="form-group">
                        <label for="">Estado:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="0">Elaborado</option>
                            <option value="1">Publicado</option>
                        </select>
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
