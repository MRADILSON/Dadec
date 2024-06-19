<?php include 'include/init.php'; ?>
<?php
     if (!isset($_SESSION['id'])) {
         redirect_to("../");
     }
     $users =  Users::find_all();

?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
<!doctype html>
<html lang="pt">
<head>
    <title>Usuário - Administrator</title>
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
            padding-top: 20px;
            padding-left:6px;
            /*padding-bottom:10px !important;*/
            margin-top:10px;
            text-transform: capitalize;
        }
        .datepicker {
            font-size: 12px;
        }
      
        div.dataTables_wrapper div.dataTables_paginate {
            font-size: 11px;
        }

    </style>
</head>

<div class="wrapper">
        <?php include 'include/menu.php'; ?>

        <div class="main">
            <?php 
                include 'include/topo1.php'; 
            ?>


            <main class="content">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h4 class="h4 mt-4 ml-3">Gestão de Usuários</h4>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-md btn-success" style="font-size: 12px;" href="users_add.php"><i class="mdi mdi-account-plus mr-2"></i> Adicionar Novo</a>
        </div>
    </div>
</div>
<?php
    if ($session->message()) {
        echo $session->message();
    }
?>

<div class="table-responsive">


<table id="example" class="table table-striped table-hover table-bordered table-sm" cellspacing="0" width="100%" style="background: white;padding: 0 5px;">

    <thead>
        <tr>
            <th>Foto</th>
            <th>Nome_Completo</th>
            <th>Email</th>
            <th>Usuário</th>
            <th>Senha</th>
            <th>Designação</th>
            <th>Endereço</th>
            <th>Data_Criada</th>
            <th>Acções</th>
        </tr>
    </thead>
    
    <tbody>

    <?php foreach ($users as $user) : ?>
        
        <?php 
            if( $user->id == $_SESSION['id']) {
                continue;
            } 
        ?>

        <tr>
            <td>
                <div class="text-center">
                <img src="<?= $user->profile_picture_picture(); ?>" alt="" class="img-fluid rounded-circle" style="width: 34px;height: 34px;"></td></div>
            <td class="special"><?= $user->nome;?></td>
            <td class="special"><?= $user->email; ?></td>
            <td class="special"> <?= $user->usuario; ?></td>
            <td class="special"> <?= $user->password; ?></td>
            <td class="special"> <?php if($user->designacao  == '1') { echo 'Moderador';} else { echo 'Admin';} ?></td>
            <td class="special"> <?= trim_body($user->endereco, 50); ?></td>
            <td class="special"> <?= $user->data_criacao; ?></td>
            <td>
                <a href="users_edit.php?id=<?= $user->id; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="
                    Editar este usuário"><i class="mdi mdi-pencil"></i></a>

                <a href="users_delete.php?id=<?= $user->id; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Apagar este usuário"><i class="mdi mdi-delete"></i></a>
            </td>
        </tr>

    <?php endforeach; ?>


</main>
</div>
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
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script>
  
    $(document).ready(function() {
        $('#example').DataTable();
        $('[data-toggle="tooltip"]').tooltip();
    });
    
</script>
</div>
</div>
</main>
<script src="js/app.js"></script>

            </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>
</body>
</html>
