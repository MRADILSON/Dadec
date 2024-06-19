<?php include 'include/init.php'; ?>
<?php


    if (!isset($_SESSION['id'])) { redirect_to("../"); }
    $gallery = new Gallery();
    $booking = Booking::find_booking_all();
    if (isset($_POST['submit']) || isset($_FILES['file'])) {

        $gallery->title = clean($_POST['title']);
        $gallery->caption = clean($_POST['caption']);
        $gallery->alternate_text = clean($_POST['alternate_text']);
        $gallery->description = clean($_POST['description']);
        $gallery->booking_id = clean($_POST['booking_id']);
        $gallery->set_file($_FILES['file']);
       
         if ($gallery->save()) {
           redirect_to("photos_view.php");
        } else {
            $msg = join("<br>",$gallery->errors);
        }
    }
?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
    <!doctype html>
    <html lang="pt">
    <head>
        <title>Carregar Photos - Administrator</title>
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
            .btn.btn-light.btn-sm {
                background-color: #e2e6ea;
            }
            .dropzone {
                    border: 6px dashed #17b4bc
            }
            .dz-default.dz-message {
                color: #17b4bc;
                font-size: 24px;
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

            <div class="col-lg-8 offset-2 pl-3 pb-3 box-shadow mt-4 pt-3">
                <h5>Carregar Nova Imagem</h5>
                <?= (isset($msg) ? $msg : ''); ?>
                <form method="post" action="" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="booking_id">Relacção:</label>
                        <select class="custom-select form-control" id="booking_id" name="booking_id">
                          <?php foreach($booking as $booking_user) : ?>
                            <?php if ($booking_user->booking_id == $gallery->booking_id) : ?>
                              <option value="<?= $booking_user->booking_id; ?>" selected><?= $booking_user->bride . ' + ' . $booking_user->groom; ?></option>
                            <?php else : ?>
                              <option value="<?= $booking_user->booking_id; ?>"><?= $booking_user->bride . ' + ' . $booking_user->groom; ?></option>
                            <?php endif ?>
                          <?php endforeach; ?>
                        </select>
                    </div>
                   <div class="form-group">
                       <label for="">Titulo:</label>
                       <input type="text" name="title" class="form-control" placeholder="Digite um titulo">
                   </div>
                   <div class="form-group">
                       <label for="">Legenda:</label>
                       <input type="text" name="caption" value="<?= $gallery->caption; ?>" class="form-control" placeholder="Digite a legenda">
                   </div>
                    <div class="form-group">
                       <label for="">Texto Alternartivo:</label>
                       <input type="text" name="alternate_text" value="<?= $gallery->alternate_text; ?>" class="form-control" placeholder="Digite o Texto">
                   </div>
                   <div class="form-group">
                       <textarea name="description" rows="10" class="form-control" placeholder="Digite a descrição"><?= $gallery->description; ?></textarea>
                   </div>
                   <div class="form-group">
                       <input type="file" name="file">
                   </div>
                   <button type="submit" name="submit" value="" class="btn btn-success btn-sm">Salvar imagem</button>
                   <a href="photos_view.php" class="btn btn-danger btn-sm">Voltar</a>
                </form><!-- end of input form -->
<br>
                <h5 class="h5">Carrega ou arrasta suas imagens</h5>
                <div id="dropzone-area">
                    <form action="photos_add.php" class="dropzone"></form>  
                </div>
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
