<?php include 'include/init.php'; ?>
<?php
     if (!isset($_SESSION['id'])) {
         redirect_to("../");
     }
     //$booking =  Booking::getBooking();

     $clienteAtivos =  Cliente::clientesAtivos();
     $clienteInativos =  Cliente::clientesInactivos();
?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Administrator</title>
    <?php
        include 'include/header.php';
    ?>
    <style>
        body {
            margin-bottom: 3%;
        }
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

        .btn.btn-sm.btn-light.active:hover {
            background: white;
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


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom hher">
    <h6 class="h4 mt-4 ml-3">Clientes Activos</h6>
    <div class="btn-toolbar mb-md-0">
        <!--
        <div class="btn-group mr-2">
            <a class="btn btn-md btn-success no-print" style="font-size: 12px;" href="client_add.php"><i class="mdi mdi-account-plus mr-2"></i> Adicionar Novo</a>
        </div>-->
    </div>
</div>
<?php
    if ($session->message()) {
        echo $session->message();
    }
?>
<div class="table-responsive">
<table id="pending" class="table table-striped table-bordered table-hover table-sm" cellspacing="0" width="100%" style="background: white;padding: 0 5px;">

    <thead>
        <tr>
        <th>Foto</th>
            <th>Nome do Cliente</th>
            <th>Email</th>
            <th>Password</th>
            <th>Genero</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th>Data da Criação</th>
            <th>Estado</th>
            <th class="no-print">Ferramentas</th>
        </tr>
    </thead>
    <!-- <tfoot>
        <tr>
            <th>Primary Contact</th>
            <th>Bride's Name</th>
            <th>Groom's Name</th>
            <th>Primary Email</th>
            <th>Contact</th>
            <th>Wedding Date</th>
            <th>Tools</th>
        </tr>
    </tfoot> -->
    <tbody>
    <?php foreach ($clienteAtivos as $clientesAtivos) : ?>
        
        <tr>
        <td>
                <div class="text-center">
                <img src="<?= $clientesAtivos->profile_picture_picture(); ?>" alt="" class="img-fluid rounded-circle" style="width: 34px;height: 34px;"></td></div>
            <td class=""><?= $clientesAtivos->nome;?></td>
            <td class=""><?= $clientesAtivos->email;?></td>
            <td class=""><?= $clientesAtivos->password;?></td>
            <td class=""><?= $clientesAtivos->genero;?></td>
            <td class=""><?= $clientesAtivos->telefone;?></td>
            <td class=""><?= $clientesAtivos->endereco;?></td>
            <td class=""><?= $clientesAtivos->data_criacao;?></td>
            <td class=""><?= $clientesAtivos->estado;?></td>
                  
            <td class="no-print">
            <a href="cliente1_delete.php?id=<?= $clientesAtivos->id; ?>" class="btn btn-danger btn-sm active" title="Apagar cliente"><i class="mdi mdi-delete"></i></a>
                <a href="cliente1_assign.php?id=<?= $clientesAtivos->id; ?>" class="btn btn-primary btn-sm" title="Ativar & Editar cliente"><i class="mdi mdi-clipboard-account"></i></a>
                <button onclick="window.print()" target="_blank" class="btn btn-warning btn-sm active" title="Imprimir"><i class="mdi mdi-printer"></i>
       </button>
            </td>
        </tr>

    <?php endforeach; ?>
</tbody>
</table>


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h6 class="h4 mt-4 ml-3">Cliente Inactivos</h6>
</div>
<table id="confirmed" class="table table-striped table-hover table-bordered table-sm" cellspacing="0" width="100%" style="background: white;padding: 0 5px;">

    <thead>
        <tr>
        <th>Foto</th>
        <th>Nome do Cliente</th>
            <th>Email</th>
            <th>Password</th>
            <th>Genero</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th>Data da Criação</th>
            <th>Estado</th>
            <th class="no-print">Ferramentas</th>
        </tr>
    </thead>
    <!-- <tfoot>
        <tr>
            <th>Primary Contact</th>
            <th>Bride's Name</th>
            <th>Groom's Name</th>
            <th>Primary Email</th>
            <th>Contact</th>
            <th>Wedding Date</th>
            <th>Tools</th>
        </tr>
    </tfoot> -->
    <tbody>
    <?php foreach ($clienteInativos as $clientesInativos) : ?>
        
        <tr>
        <td>
                <div class="text-center">
                <img src="<?= $clientesInativos->profile_picture_picture(); ?>" alt="" class="img-fluid rounded-circle" style="width: 34px;height: 34px;"></td></div>
        <td class=""><?= $clientesInativos->nome;?></td>
            <td class=""><?= $clientesInativos->email;?></td>
            <td class=""><?= $clientesInativos->password;?></td>
            <td class=""><?= $clientesInativos->genero;?></td>
            <td class=""><?= $clientesInativos->telefone;?></td>
            <td class=""><?= $clientesInativos->endereco;?></td>
            <td class=""><?= $clientesInativos->data_criacao;?></td>
            <td class=""><?= $clientesInativos->estado;?></td>
            
            <td class="no-print">
            <a href="cliente1_delete.php?id=<?= $clientesInativos->id; ?>" class="btn btn-danger btn-sm active" title="Apagar cliente"><i class="mdi mdi-delete"></i></a>
                <a href="cliente1_assign.php?id=<?= $clientesInativos->id; ?>" class="btn btn-primary btn-sm" title="Desativar & Editar cliente"><i class="mdi mdi-clipboard-account"></i></a>
                <button onclick="window.print()" target="_blank" class="btn btn-warning btn-sm active" title="Imprimir"><i class="mdi mdi-printer"></i>
       </button>
            </td>
        </tr>

    <?php endforeach; ?>
</tbody>
</table>


</main>
</div>
</div>

<script src="js/jquery-3.2.1.slim.min.js"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="js/popper.min.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#pending').DataTable();
        $('#confirmed').DataTable();
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
