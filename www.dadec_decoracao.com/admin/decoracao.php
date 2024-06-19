<?php include 'include/init.php'; 
 if (!isset($_SESSION['id'])) {
    redirect_to("../");
 }
?>
<?php $cliente_profile = Cliente::find_by_id($_SESSION['id']); ?>
<?php $category = Category::find_all();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $totalCarrinho = isset($_POST['total-carrinho']) ? $_POST['total-carrinho'] : 0;
    $tipo = clean($_POST['tipo']);
    $data = clean($_POST['data']);
    $endereco = clean($_POST['endereco']);
    $cor = clean($_POST['cor']);
    $estilo = clean($_POST['estilo']);
    $lugares = clean($_POST['lugares']);

    redirect_to("pagamento2.php?total=".$totalCarrinho."&tipo=".$tipo."&data=".$data."&endereco=".$endereco."&cor=".$cor."&estilo=".$estilo."&lugares=".$lugares);
}
?>
<!doctype html>
<html lang="pt">
<head>
<title>Decoração - Eventos</title>
    <?php
        include 'include/header.php';
    ?>

    <style>
       body {
            font-family: 'Open Sans', sans-serif;
        }

        #review {
            font-size: 16px;
            margin-right: 5px;
        }

        img.img-fluid.img-custom {
            width: 100%;
            height: auto;
        }

        .btn.btn-sm.btn-light.active:hover {
            background: white;
        }

        .list-group-item:first-child {
            border-top-left-radius: 0rem;
            border-top-right-radius: 0rem;
        }

        .list-group-item:last-child {
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .list-group-item.active {
            border-color: #00125100;
        }

        /* Styles for the cart section */
        #carrinho-container {
            position: fixed;
            right: 0;
            top: 0;
            width: 35%;
            height: 80%;
            background: #f8f9fa;
            margin-top: 65px;
            border-left: 1px solid #ddd;
            padding: 20px;
            box-shadow: -2px 0 5px rgba(0,0,0,0.1);
            overflow-y: auto;
            z-index: 1000;
        }

        #carrinho-container h3 {
            margin-bottom: 20px;
        }

        #carrinho-container .table {
            margin-bottom: 20px;
        }
        .this{
                display: none;
            }

        #carrinho-container .btn-primary {
            width: 100%;
        }

        #carrinho-container img.cart-icon {
            width: 40px;
            height: 50px;
        }

        /* Ensure the main content is not affected */
        .main-content {
            width: 55%;
            float: left;
            margin-right: 5%;
        }

        .carrinho-content {
            overflow-y: auto;
            height: calc(100% - 160px);
        }

        .h6{
            color: white;
        }

        @media screen and (max-width: 768px) {
            .main-content, #carrinho-container {
                width: 100%;
                float: none;
                margin: 0;
                padding: 10px;
            }
            .row.mb-3 .col-lg-12 h2, .row.mb-3 .col-lg-12 h3 {
                font-size: 1.5rem;
            }

            .list-group-item {
                padding: 10px 15px;
                width: 100%;
            }
            .list-group-item.active {
            width: 100%;
        }

            .list-group{
                width: 100%;
                
            }
            {
                width: 100%;
                background-color: red;
            }
            .this{
                display: none;
            }

            #carrinho-container {
                width: 100%;
                position: relative;
                margin-top: 20px;
                margin-right: 0;
            }
            .float-left, .float-right {
                width: 100%;
            }

            .float-right {
                text-align: center;
                margin-top: 0px;
                padding-left: 20px;
                padding-right: 20px;
            }

            img {
                max-width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>

<body>
    <div class="wrapper">
        <?php include 'include/menu1.php'; ?>

        <div class="main">
            <?php 
                include 'include/topo.php'; 
            ?>


            <main class="content">

<div class="main-content">
    <div class="container" style="width: 100%;">
        <div class="row mb-3">
            <div class="col-lg-12">
                <h3 class="h5 text-uppercase text-center text-muted">Decoração de Eventos</h3>
                <h2 class="h2 text-uppercase text-center mb-0">Selecione o Tipo de Evento</h2><br>
                <p style="text-align:center; color:danger">Selecione apenas um dos eventos na lista abaixo, em seguida preencha os dados para fazer a reserva!</p>
            </div>
        </div>

        <?php foreach ($category as $category_row) : ?>
            <div class="row mb-3">
                <div class="col-md-4">
                        <img src="<?= $category_row->preview_image_picture(); ?>" class="img-fluid img-custom" alt="">
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group">
                            <li class="list-group-item bg-danger active" style="padding-top: 12px;">
                                <h6 class="h6 text-center"> <?= $category_row->wedding_type; ?> - <?= number_format($category_row->price,2);?> KZ </h6>
                            </li>
                            <?php $feature = Features::find_by_feature_all($category_row->id); ?>
                            <?php foreach ($feature as $feature_item) : ?>
                                <li class="list-group-item"><?= $feature_item->title; ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <div class="float-right">
                            <button class="btn btn-sm btn-success active add-to-cart" style="border-radius: 3px;margin-top: 9px;" data-id="<?= $category_row->id; ?>" data-nome="<?= $category_row->wedding_type; ?>" data-preco="<?= $category_row->price; ?>">Adicionar</button>
                        </div>
                    </div>
                
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Carrinho de Compras -->
<div id="carrinho-container">
    <h3 class="h5 text-uppercase text-center text-muted">Carrinho de Compras <img src="../images/pngwing.com.png" alt="Carrinho" class="cart-icon"></h3>
    <form method="post" enctype="multipart/form-data">
        <div class="carrinho-content">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th>Preço</th>
                        <th>Lugares</th>
                        <th>Localização</th>
                        <th>Cor</th>
                        <th>Estilo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="carrinho-items">
                    <!-- Items will be added here -->
                </tbody>
            </table>
        </div>
        <div class="text-right">
            <h4>Total: <span name="total" id="total-carrinho">0</span></h4>
            <input type="hidden" name="total-carrinho" id="hidden-total-carrinho" value="0">
            <button name="pagamento" id="prosseguir-pagamento" class="btn btn-primary">Reservar</button>
        </div>
    </form>
</div>

<script>
    let carrinho = [];

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const nome = button.getAttribute('data-nome');
            const preco = parseFloat(button.getAttribute('data-preco'));

            const item = carrinho.find(item => item.id === id);
            if (item) {
                item.quantidade += 1;
            } else {
                carrinho.push({ id, nome, preco, quantidade: 1 });
            }
            atualizarCarrinho();
        });
    });

    function atualizarCarrinho() {
        const carrinhoItems = document.getElementById('carrinho-items');
        carrinhoItems.innerHTML = '';
        let total = 0;
        carrinho.forEach(item => {
            const itemTotal = item.preco * item.quantidade;
            total += itemTotal;
            carrinhoItems.innerHTML += `
                <tr>
                    <td>${item.nome}</td>
                    <input type="hidden" name="tipo" value="${item.nome}">
                    <td><input type="date" name="data" required style="width: 150px;" class="form-control" data-id="${item.id}"></td>
                    <td>${item.preco}</td>
                    <td><input type="number" name="lugares" required value="${item.quantidade}" maxlength="4" size="10" style="width: 70px;" min="1" class="form-control quantidade" data-id="${item.id}"></td>
                    <td><input type="text" name="endereco" required class="form-control"></td>
                    <td><input type="text" name="cor" required style="width: 100px;" class="form-control"></td>
                    <td><input type="text" name="estilo" required style="width: 100px;" class="form-control"></td>
                    <td><button class="btn btn-danger btn-sm remover-item" data-id="${item.id}">Remover</button></td>
                </tr>
            `;
        });
        document.getElementById('total-carrinho').innerText = total;
        document.getElementById('hidden-total-carrinho').value = total;

        document.querySelectorAll('.remover-item').forEach(button => {
            button.addEventListener('click', () => {
                const id = button.getAttribute('data-id');
                carrinho = carrinho.filter(item => item.id !== id);
                atualizarCarrinho();
            });
        });

        document.querySelectorAll('.quantidade').forEach(input => {
            input.addEventListener('change', () => {
                const id = input.getAttribute('data-id');
                const quantidade = parseInt(input.value);
                const item = carrinho.find(item => item.id === id);
                if (item) {
                    item.quantidade = quantidade;
                }
                atualizarCarrinho();
            });
        });

        
    }

    document.getElementById('prosseguir-pagamento').addEventListener('click', () => {
        // Aqui você pode redirecionar o usuário para uma página de pagamento
        

       //window.location.href = 'pagamento.php?total';
    });
</script>
 <script src="js/app.js"></script>
    
    <div class="col-lg-4 offset-lg-4 mt-4">
                <img id="preview_image" src="<?= $cliente_profile->preview_image_picture(); ?>" width="300" height="350" alt="Imagem">
            </div>

            </div>
            </div>
            </main>

           
          
        </div>
    </div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>