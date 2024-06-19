<?php include 'include/init.php'; ?>
<?php


    if (!isset($_SESSION['id'])) { redirect_to("../"); }
    $features = new Features();
    $category = category::find_all();

    if (isset($_POST['submit'])) {

        $wedding_type = clean($_POST['wedding_type']);
        $title = clean($_POST['title']);
        $description = clean($_POST['description']);
       
         if (empty($wedding_type) || empty($title) || empty($description)) {
            redirect_to("feature_add.php");
            $session->message("
            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert'></i></strong> Por favor preencha os campos vazios.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        }

        $features->title = $title;
        $features->category_id = $wedding_type;
        $features->description = $description;
        $features->save();
        redirect_to("feature_add.php");
        $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-check'></i></strong> {$features->title} adicionado  com sucesso.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
    }


?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
    <!doctype html>
    <html lang="pt">
    <head>
        <title>Aicionar Nova Caracteristica - Administrator</title>
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
                    
            
                <form method="post" action="">
                
                    <h4 class="h4 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">Adicionar Nova Caracteristica
                     <a href="service_list.php" class="btn btn-sm btn-light active float-right" style="font-size: 12px;"><i class="mdi mdi-left-arrow"></i> Voltar</a></h4>

                    <?php
                        if ($session->message()) {
                            echo  $session->message();
                        }
                    ?>

                    <div class="form-group">
                        <label for="title">Titulo da Caracteristica</label>
                        <input type="text" name="title" class="form-control" id="title"  placeholder="Digite o nome ou titulo da Caracteristica">
                    </div>
                    <div class="form-group">
                        <label for="wedding_type">Tipo de Pacote</label>
                        <select name="wedding_type" id="wedding_type" class="form-control">
                        <?php foreach ($category as $categories) : ?>
                            <option value="<?= $categories->id; ?>"><?= $categories->wedding_type; ?> - Price: <?= number_format($categories->price, 2); ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea name="description" class="form-control" id="description" rows="3" placeholder="Deixe a descrição da Caracteristica "></textarea>
                    </div>
                     <a href="service_list.php" class="btn btn-sm btn-danger float-right" style="font-size: 12px;">Cancelar</a>

                        <button type="submit" name="submit" class="btn btn-sm btn-light float-right mr-2" style="font-size: 12px;">Salvar</button>
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
