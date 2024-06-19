<?php include 'include/init.php'; ?>
<?php $cliente_profile = Cliente::find_by_id($_SESSION['id']); ?>
<?php
     if (!isset($_SESSION['id'])) {
         redirect_to("../");
     }

     $pagamento = Pagamento::find_all1($cliente_profile->id);
     $pagamento1 = Pagamento1::find_all1($cliente_profile->id);
    // $session->message($cliente_profile->id);
     
    ?>

<!doctype html>
<html lang="pt">
<head>
    <title>Perfil do Cliente</title>
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

        @media (max-width: 890px) {

.content{
    margin: 0px 0px 0px 0px;
    width: 100%;
    padding: 0px 0px 0px 0px;
}

            th, td {
                padding: 8px;
                font-size: 12px;
            }

            table, thead, tbody, th, td, tr {
                display: block;
            }

            tr {
                margin-bottom: 15px;
            }

            th {
                background: #f9f9f9;
                font-weight: bold;
                display: flex;
                justify-content: space-between;
            }

            td {
                display: flex;
                justify-content: space-between;
                padding: 5px 10px;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                width: 50%;
                text-align: left;
                padding-right: 10px;
            }

        
            @media print {
            .no-print {
                display: none !important;
            }
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .btn-warning {
            color: #212529;
            background-color: #ffc107;
            border-color: #ffc107;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

}

    </style>
</head>

<body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<body>
    <div class="wrapper">
        <?php include 'include/menu1.php'; ?>

        <div class="main">
            <?php 
                include 'include/topo.php'; 
            ?>


            <main class="content">

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom hher">
    <h6 class="h4 mt-4 ml-3">Lista de Reservas & Pagamentos</h6>
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

<h6 class="h4 mt-4 ml-3">Aluguel de Material</h6>
<div class="table-container">
    <table id="pending" class="table table-striped table-bordered table-hover table-sm" cellspacing="0" width="100%" style="background: white;padding: 0 5px;">

        <tbody>
            <?php foreach ($pagamento as $pagamentos) : ?>      
                <tr>
                    <td data-label="Foto">
                        <div class="text-center">
                            <img src="<?= $pagamentos->profile_picture_picture(); ?>" alt="" class="img-fluid rounded-circle" style="width: 34px;height: 34px;">
                        </div>
                    </td>
                    <td data-label="Nome do Cliente"><?= $pagamentos->cliente;?></td>
                    <td data-label="Valor Total"><?= $pagamentos->total;?></td>
                    <td data-label="Tipo de Pagamento"><?= $pagamentos->tipo_pagamento;?></td>
                    <td data-label="Descrição"><?= $pagamentos->descricao;?></td>
                    <td data-label="Data do Pagamento"><?= $pagamentos->data;?></td>
                    <td data-label="Estado" style="color: <?= $pagamentos->estado == 'aprovado' ? 'green' : 'red'; ?>; font-weight: bolder;">
                        <?= $pagamentos->estado == 'aprovado' ? 'aprovado' : 'pendente'; ?>
                    </td>
                    <td data-label="Ferramentas" class="no-print">
                        <button onclick="window.print()" target="_blank" class="btn btn-warning btn-sm active" title="Imprimir"><i class="mdi mdi-printer"></i></button>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom hher">
    <h6 class="h4 mt-4 ml-3">Decoração de Evento</h6>
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

<div class="table-container">
    <table id="confirmed" class="table table-striped table-bordered table-hover table-sm" cellspacing="0" width="100%" style="background: white;padding: 0 5px;">

        <tbody>
            <?php foreach ($pagamento1 as $pagamentos1) : ?>      
                <tr>
                    <td data-label="Comprovativo">
                        <div class="text-center">
                            <img src="<?= $pagamentos1->profile_picture_picture(); ?>" alt="" class="img-fluid rounded-circle" style="width: 34px;height: 34px;">
                        </div>
                    </td>
                    <td data-label="Cliente"><?= $pagamentos1->cliente;?></td>
                    <td data-label="Tipo de Evento"><?= $pagamentos1->tipo;?></td>
                    <td data-label="Data do Evento"><?= $pagamentos1->data_evento;?></td>
                    <td data-label="Valor Total"><?= $pagamentos1->total;?></td>
                    <td data-label="Nº de Cadeiras"><?= $pagamentos1->cadeiras;?></td>
                    <td data-label="Tipo de Pagamento"><?= $pagamentos1->tipo_pagamento;?></td>
                    <td data-label="Localização"><?= $pagamentos1->localizacao;?></td>
                    <td data-label="Cor"><?= $pagamentos1->cor;?></td>
                    <td data-label="Estilo"><?= $pagamentos1->estilo;?></td>
                    <td data-label="Data do Pagamento"><?= $pagamentos1->data_pagamento;?></td>
                    <td data-label="Estado" style="color: <?= $pagamentos1->estado == 'aprovado' ? 'green' : 'red'; ?>; font-weight: bolder;">
                        <?= $pagamentos1->estado == 'aprovado' ? 'aprovado' : 'pendente'; ?>
                    </td>
                    <td data-label="Ferramentas" class="no-print">
                        <button onclick="window.print()" target="_blank" class="btn btn-warning btn-sm active" title="Imprimir"><i class="mdi mdi-printer"></i></button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
            <script src="js/app.js"></script>
            <footer class="footer">
                <?php include 'include/footer1.php' ?>
            </footer>
    <div class="col-lg-4 offset-lg-4 mt-4">
                <img id="preview_image" src="<?= $cliente_profile->preview_image_picture(); ?>" width="300" height="350" alt="Imagem">
            </div>

            </div>
            </div>
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

</body>
</html>
