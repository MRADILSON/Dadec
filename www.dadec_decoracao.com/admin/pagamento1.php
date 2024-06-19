<?php include 'include/init.php'; ?>
<?php
     if (!isset($_SESSION['id'])) {
         redirect_to("../");
     }
     //$booking =  Booking::getBooking();
     //$booking_confirm =  Booking::ConfirmedBooking();

     $pagamento =  Pagamento::find_all();
     $pagamento1 =  Pagamento1::find_all();

     if (isset($_POST['enviar'])) {
        $pagamento_id = $_POST['pagamento_id'];
        $novo_estado = $_POST['estado'];
    
        $pagamento = Pagamento::find_by_id($pagamento_id);
        $pagamento1 = Pagamento1::find_by_id($pagamento_id);

        if (empty($pagamento_id) || empty($novo_estado)) {
            redirect_to("pagamento1.php");
            $session->message("
            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert mr-2'></i></strong> Campos vazios para atualizar o estado.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        } else {
            if ($pagamento) {
                $pagamento->estado = $novo_estado;
                $pagamento->save();
                redirect_to("pagamento1.php");
                $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert mr-2'></i></strong> Estado atualizado com sucesso!
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
                die();
            } else if ($pagamento1) {
                $pagamento1->estado = $novo_estado;
                $pagamento1->save();
                redirect_to("pagamento1.php");
                $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert mr-2'></i></strong> Estado atualizado com sucesso!
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
                die();
            } else {
                $session->message("Pagamento não encontrado.");
            }
        }
    } else if (isset($_POST['eliminar'])) {
        $pagamento_id = $_POST['pagamento_id'];

        $pagamento = Pagamento::find_by_id($pagamento_id);
        $pagamento1 = Pagamento1::find_by_id($pagamento_id);
        if ($pagamento1) {   
            $pagamento1->delete();
            redirect_to("pagamento1.php");
            $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert mr-2'></i></strong> Pagamento apagado!
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        } else {
            $session->message("Pagamento não encontrado.");
        }
    }
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
            font-size: 12px;
        }
        .tooltip {
            font-size: 12px;
        }

        td.special {
            padding: 0;
            padding-top: 8px;
            padding-left: 6px;
            padding-bottom: 6px;
            margin-top: 5px;
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
        <?php include 'include/topo1.php'; ?>

        <main class="content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom hher">
                <h6 class="h4 mt-4 ml-3">Lista de Pagamentos</h6>
                <div class="btn-toolbar mb-md-0">
                </div>
            </div>
            <?php
                if ($session->message()) {
                    echo $session->message();
                }
            ?>
            <h6 class="h4 mt-4 ml-3">Aluguel de Material</h6>
            <div class="table-responsive">
                <table id="pending" class="table table-striped table-bordered table-hover table-sm" cellspacing="0" width="100%" style="background: white; padding: 0 5px;">
                    <thead>
                        <tr>
                            <th>Nome do Cliente</th>
                            <th>Valor Total</th>
                            <th>Tipo de Pagamento</th>
                            <th>Descrição</th>
                            <th>Data do Pagamento</th>
                            <th>Estado</th>
                            <th class="no-print">Ferramentas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pagamento as $pagamentos) : ?>      
                            <tr>
                                <td><?= $pagamentos->cliente; ?></td>
                                <td><?= $pagamentos->total; ?></td>
                                <td><?= $pagamentos->tipo_pagamento; ?></td>
                                <td><?= $pagamentos->descricao; ?></td>
                                <td><?= $pagamentos->data; ?></td>          
                                <?php
                                if ($pagamentos->estado == 'aprovado') {
                                    echo "<td style='color: green; font-weight: bolder;'>aprovado</td>";
                                } else {
                                    echo "<td style='color: red; font-weight: bolder;'>pendente</td>";
                                }
                                ?>
                                <td class="no-print">
                                    <button type="button" class="btn btn-primary btn-sm" title="Ativar & Editar cliente" data-toggle="modal" data-target="#editEstadoModal" data-id="<?= $pagamentos->id; ?>" data-nome="<?= $pagamentos->cliente; ?>" data-total="<?= $pagamentos->total; ?>" data-imagem="<?= $pagamentos->profile_picture_picture(); ?>" data-imagem-download="<?= $pagamentos->profile_picture_picture(); ?>">
                                        <i class="mdi mdi-clipboard-account"></i>
                                    </button>
                                    <button onclick="window.print()" target="_blank" class="btn btn-warning btn-sm active" title="Imprimir">
                                        <i class="mdi mdi-printer"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom hher">
                <h6 class="h4 mt-4 ml-3">Decoração de Evento</h6>
                <div class="btn-toolbar mb-md-0">
                </div>
            </div>

            <div class="table-responsive">
                <table id="confirmed" class="table table-striped table-bordered table-hover table-sm" cellspacing="0" width="100%" style="background: white; padding: 0 5px;">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Tipo de Evento</th>
                            <th>Data do Evento</th>
                            <th>Valor Total</th>
                            <th>Nº de Cadeiras</th>
                            <th>Tipo de Pagamento</th>
                            <th>Localização</th>
                            <th>Cor</th>
                            <th>Estilo</th>
                            <th>Data do Pagamento</th>
                            <th>Estado</th>
                            <th class="no-print">Ferramentas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pagamento1 as $pagamentos1) : ?>      
                            <tr>
                                <td><?= $pagamentos1->cliente; ?></td>
                                <td><?= $pagamentos1->tipo; ?></td>
                                <td><?= $pagamentos1->data_evento; ?></td>
                                <td><?= $pagamentos1->total; ?></td>
                                <td><?= $pagamentos1->cadeiras; ?></td>
                                <td><?= $pagamentos1->tipo_pagamento; ?></td>
                                <td><?= $pagamentos1->localizacao; ?></td>
                                <td><?= $pagamentos1->cor; ?></td>
                                <td><?= $pagamentos1->estilo; ?></td>
                                <td><?= $pagamentos1->data; ?></td>          
                                <?php
                                if ($pagamentos1->estado == 'aprovado') {
                                    echo "<td style='color: green; font-weight: bolder;'>aprovado</td>";
                                } else {
                                    echo "<td style='color: red; font-weight: bolder;'>pendente</td>";
                                }
                                ?>
                                <td class="no-print">
                                    <button type="button" class="btn btn-primary btn-sm" title="Ativar & Editar cliente" data-toggle="modal" data-target="#editEstadoModal" data-id="<?= $pagamentos1->id; ?>" data-nome="<?= $pagamentos1->cliente; ?>" data-total="<?= $pagamentos1->total; ?>" data-imagem="<?= $pagamentos1->profile_picture_picture(); ?>" data-imagem-download="<?= $pagamentos1->profile_picture_picture(); ?>">
                                        <i class="mdi mdi-clipboard-account"></i>
                                    </button>
                                    <button onclick="window.print()" target="_blank" class="btn btn-warning btn-sm active" title="Imprimir">
                                        <i class="mdi mdi-printer"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editEstadoModal" tabindex="-1" role="dialog" aria-labelledby="editEstadoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEstadoModalLabel">Alterar Estado do Pagamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editEstadoForm" action="" method="POST">
                    <div class="form-group">
                        <label for="cliente_nome">Nome do Cliente</label>
                        <input type="text" class="form-control" id="cliente_nome" readonly>
                    </div>
                    <div class="form-group">
                        <label for="cliente_total">Total</label>
                        <input type="text" class="form-control" id="cliente_total" readonly>
                    </div>
                    <div class="form-group">
                        <label for="cliente_imagem">Comprovativo:</label><br>
                        <img src="" id="cliente_imagem" width="100px" class="img-fluid text-center" alt="Imagem do Cliente"><br><br>
                        <a href="#" id="cliente_imagem_download" class="btn btn-upload" download>Baixar comprovativo</a>
                    </div>
                    <input type="hidden" name="pagamento_id" id="pagamento_id">
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select class="form-control" id="estado" name="estado">
                            <option value="aprovado">Aprovado</option>
                            <option value="pendente">Pendente</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="enviar" class="btn btn-success">Salvar mudanças</button>
                        <button name="eliminar" class="btn btn-danger btn-sm active" title="Apagar cliente">
                            <i class="mdi mdi-delete"></i> Apagar
                        </button>
                    </div>
                </form>
            </div>
        </div>
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

        $('#editEstadoModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var idNome = button.data('id');
            var clienteNome = button.data('nome');
            var clienteTotal = button.data('total');
            var clienteImagem = button.data('imagem');

            var modal = $(this);
            modal.find('#pagamento_id').val(idNome);
            modal.find('#cliente_nome').val(clienteNome);
            modal.find('#cliente_total').val(clienteTotal);
            modal.find('#cliente_imagem').attr('src', clienteImagem);
            modal.find('#cliente_imagem_download').attr('href', clienteImagem);
        });
    });
</script>
<script src="js/app.js"></script>
<footer class="footer">
    <?php include 'include/footer1.php' ?>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
</body>
</html>
