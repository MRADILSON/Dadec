<?php include 'include/init.php'; ?>

<?php
if (!isset($_SESSION['id'])) { redirect_to("../");}

// $booking_id = $_GET['booking_id'];
// $user_id = $_GET['user_id'];
// $links='booking_id='.$booking_id.'&user_id='.$user_id;
// $guest_list =  Guest::getGuest($booking_id);
// $category = Category::find_all();
$gallery = Gallery::find_all();
?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
<!doctype html>
<html lang="en">
<head>

    <title>Galeria de Fotos - Administrador</title>
    <?php
        include 'include/header.php';
    ?>

    <style>

        p.card-text a {
            font-size: 12px;
        }
        p.card-text {
            line-height: 16px;
        }
        .btn.btn-light.mr-2.text-uppercase {
            background-color: #e2e6ea;
        }

        .card {
            -webkit-border-radius:0;
            -moz-border-radius:0;
            border-radius:0;
        }
        .card img {
            -webkit-border-radius:0;
            -moz-border-radius:0;
            border-radius:0;
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


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h4 class="h4 mt-4">Galeria de Fotos </h4>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-primary mr-2 text-uppercase" style="font-size: 12px;font-weight: bold;" href="photos_add.php"><i class="mdi mdi-upload mr-2"></i> Adicionar imagem</a>
        </div>
    </div>
</div>
<?php
if ($session->message()) {
    echo $session->message();
}
?>
<div class="row">
    <div class="col-md-12">
        <div class="card-columns">
            <?php foreach($gallery as $galleries) : ?>
                <div class="card" style="position: relative;">
                    <a href="<?= $galleries->picture_path(); ?>" data-lightbox="gallery-group-4">
                        <img class="card-img-top" src="<?= $galleries->picture_path(); ?>" alt="Card image cap">
                    </a>
                    <div class="card-body" style="position: absolute;bottom: 0;left:0; width: 100%;background: rgba(0,0,0, 0.5);color:white;padding: 10px 10px 0 10px;">
                        <p class="card-title text-capitalize" style="font-size:14px;">
                            <?= empty($galleries->title) ? 'No Title' : $galleries->title; ?>
                            <span class="float-right pb-2">
                              <a href="photos_edit.php?id=<?= $galleries->id; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" title="Editar foto"><i class="mdi mdi-pencil"></i></a>
                              <a href="photo_delete.php?id=<?= $galleries->id; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" title="Apagar Imagem"><i class="mdi mdi-delete"></i></a>
                          </span>
                        </p>
                    </div>
                </div><!-- end of body -->
            <?php endforeach; ?>
        </div><!-- end of card columns -->
    </div>
</div><!-- end of col-md-12 -->
</div><!-- end of row -->
</main>
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

<script src="js/jquery-3.2.1.slim.min.js"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="js/popper.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="../lightbox/js/lightbox-2.6.min.js"></script>
</body>
</html>


