<?php include 'include/init.php'; ?>

<?php
     if (!isset($_SESSION['id'])) { redirect_to("../");}

     // $booking_id = $_GET['booking_id'];
     // $user_id = $_GET['user_id'];
     // $links='booking_id='.$booking_id.'&user_id='.$user_id;
     // $guest_list =  Guest::getGuest($booking_id);
     $category = Category::find_all(); 
     $features = Features::getAllfeatures(); 
?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
<!doctype html>
<html lang="pt">
<head>

    <title>Serviços & Modulos - Administrator</title>
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
            /*padding: 0;*/
            padding-top: 10px;
            /*padding-left:6px;*/
            /*padding-bottom:6px;*/
            /*margin-top:5px;*/
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


<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h4 class="h4 mt-4 ml-3">Serviços e Pacotes</h4>
     <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <a class="btn btn-md btn-success mr-2" style="font-size: 12px;" href="package_add.php"><i class="mdi mdi-buffer mr-2"></i> Adicionar Novo Pacote</a>
        </div>
    </div>
</div>

<?php
    if ($session->message()) { 
        echo $session->message();
    }
?>

        <div class="col-md-12">
            <table id="example" class="table table-striped table-hover table-bordered table-sm" cellspacing="0" width="100%" style="background: white;padding: 5px">

                <thead>
                    <tr>
                        <th>Tipos de Eventos</th>
                        <!--
                        <th>Preço</th>
                        -->
                        <th>Acção</th>
                    </tr>
                </thead>
              
                <tbody>
                    <?php foreach ($category as $category_row) : ?>
                    <tr>
                        
                        <td class="special"><b><?= $category_row->wedding_type;?></b></td>

                        <!--
                        <td class="special">Kz <b><?= number_format($category_row->price, 2);?></b></td>
                        -->
                        <td>

                            <a href="package_edit.php?id=<?= $category_row->id; ?>" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Editar tipo de Evento">
                                <i class="mdi mdi-pen"></i></a>

                            <a href="package_delete.php?id=<?= $category_row->id; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Apagar tipo de Evento"><i class="mdi mdi-delete"></i></a>
                            <button type="button" name="view" value="view" id="<?= $category_row->id; ?>" class="btn btn-info btn-sm view_data">
                                <i class="mdi mdi-eye-outline"></i> 
                            </button>

                        </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- end of col-md-12 -->

        <div class="col-md-12 mt-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                <h4 class="h4 mt-4 ml-3">Caracteristica do Evento</h4>
                 <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <a class="btn btn-md btn-success mr-2" style="font-size: 12px;" href="feature_add.php"><i class="mdi mdi-clipboard-outline mr-2"></i> Adicionar Nova Caracteristica</a>
                    </div>
                </div>
            </div>

           <table id="features" class="table table-striped table-hover table-bordered table-sm" cellspacing="0" width="100%" style="background: white;padding: 5px;">
                <thead>
                    <tr>
                        <th>Tipo de Evento</th>
                        <th>Titulo</th>
                        <th>Descrição</th>
                        <th>Acções</th>
                    </tr>
                </thead>
             
                <tbody>
                    <?php foreach ($features as $features_row) : ?>
                    <tr>
                        
                        <td class="special"><?= $features_row->wedding_type;?></td>
                        <td class="special"><?= $features_row->title;?></td>
                        <td class="special"><?= trim_body($features_row->description);?></td>
                        <td>

                            <a href="feature_edit.php?id=<?= $features_row->feature_id; ?>" class="btn btn-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Editar Caracteristica">
                                <i class="mdi mdi-pen"></i></a>

                            <a href="feature_delete.php?id=<?= $features_row->feature_id; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Apagar caracteristica"><i class="mdi mdi-delete"></i></a>

                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div><!-- end of col-md-12 -->




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
        $('#features').DataTable();
        $('[data-toggle="tooltip"]').tooltip();
    });
    
</script>


  <div id="dataModal" class="modal fade" tabindex="-1" role="dialog">  
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">  
           <div class="modal-content">  
                <div class="modal-header">  
                    <h4 class="modal-title">Pacotes e Caracteristicas Detalhes</h4>  
                    <button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body" id="package_detail">  
                </div>  
                <div class="modal-footer">  
                     <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Fechar</button>  
                </div>  
           </div>  
      </div>  
 </div>  


<script>
     $(document).on('click', '.view_data', function(){  
           var id = $(this).attr("id");  
           if(id != '')  
           {  
                $.ajax({  
                     url:"select.php",  
                     method:"POST",  
                     data:{id:id},  
                     success:function(data){  
                          $('#package_detail').html(data);  
                          $('#dataModal').modal('show');  
                     }  
                });  
           }            
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
