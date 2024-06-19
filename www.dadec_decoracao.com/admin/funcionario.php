<?php include 'include/init.php'; ?>
<?php
     if (!isset($_SESSION['id'])) {
         redirect_to("../");
     }
    $funcionario =   Funcionario::find_all();
?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
<!doctype html>
<html lang="pt">
<head>
    <title>Funcionário - Administrator</title>
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
            padding-top: 8px;
            padding-left:6px;
            padding-bottom:6px;
            padding-right:6px;
            margin-top:5px;
            text-transform: capitalize;
        }
      
        div.dataTables_wrapper div.dataTables_paginate {
            font-size: 11px;
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
    <h4 class="h4 mt-4 ml-3">Secção de Informações dos Funcionários</h4>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-md btn-success no-print" style="font-size: 12px;" href="funcionario_add.php"><i class="mdi mdi-account-plus mr-2"></i> Adicionar Novo Funcionário</a>
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
            <th>Nome</th>
            <th>Idade</th>
            <th>Contacto</th>
            <th>Endereço</th>
            <th>Função</th>
            <th>Salario</th>
            <th class="no-print">Ferramentas</th>
        </tr>
    </thead>
  
    <tbody>
       <?php foreach ($funcionario as $funcionarios) : ?>
        <tr>
            <td class="special"><?= trim_body($funcionarios->nome, 20); ?></td>
            <td class="special"><?= trim_body($funcionarios->idade, 30); ?></td>
            <td class="special"><?= trim_body($funcionarios->contacto, 30);  ?></td>
            <td class="special"><?= trim_body($funcionarios->endereco, 30); ?></td>
            <td class="special"><?= trim_body($funcionarios->funcao, 30); ?></td>
            <td class="special"><?= trim_body($funcionarios->salario, 30); ?></td>
            
            <td class="no-print">
                <a href="funcionario_edit.php?id=<?= $funcionarios->id; ?>" class="btn btn-info btn-sm active" title="Editar"><i class="mdi mdi-account-edit"></i></a>
                <a href="funcionario_delete.php?id=<?= $funcionarios->id; ?>" class="btn btn-danger btn-sm active" title="Apagar"><i class="mdi mdi-delete"></i></a>
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
            <footer class="footer">
                <?php include 'include/footer1.php' ?>
            </footer>
            </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js"
        integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc"
        crossorigin="anonymous"></script>
</body>
</html>