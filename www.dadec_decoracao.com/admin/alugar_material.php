<?php include 'include/init.php'; 

 if (!isset($_SESSION['id'])) {
    redirect_to("../");
 }
?>
<?php $cliente_profile = Cliente::find_by_id($_SESSION['id']); ?>
<?php $category = Material::find_all();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $totalCarrinho = isset($_POST['total-carrinho']) ? $_POST['total-carrinho'] : 0;
    $produto = $_POST['produto'];
    $produto_id = $_POST['id'];
    $quantidade = $_POST['quantidade'];
    //$nome_cliente = $_POST['$nome'];
    // Agora você pode usar $totalCarrinho em seu script PHP
    //echo "O valor total do carrinho é: " . htmlspecialchars($totalCarrinho);
    // Realize outras operações, como salvar no banco de dados, processar pagamento, etc.
    redirect_to("pagamento.php?total=".$totalCarrinho."&produto=".$produto."&produto_id=".$produto_id."&quantidade=".$quantidade);
}
?>
<!doctype html>
<html lang="pt">
<head>
<title>Alugar Material</title>
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
            width: 100%;
            max-width: 400px;
            height: 70%;
            background: #f8f9fa;
            border-left: 1px solid #ddd;
            padding: 20px;
            box-shadow: -2px 0 5px rgba(0,0,0,0.1);
            margin-top: 65px;
            overflow-y: auto;
            z-index: 1000;
        }

        #carrinho-container h3 {
            margin-bottom: 20px;
        }

        #carrinho-container .table {
            margin-bottom: 20px;
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
            margin-right: 400px; /* Adjust according to the cart width */
        }

        .carrinho-content {
            overflow-y: auto;
            height: calc(100% - 160px);
        }

        .h6{
            color: white;
        }

        @media screen and (max-width: 768px) {
            #carrinho-container {
                width: 100%;
                position: relative;
                margin-top: 20px;
                margin-right: 0;
            }

            .main-content {
                margin-right: 0;
            }
        }

        @media screen and (max-width: 576px) {
            .row.mb-3 .col-lg-12 h2, .row.mb-3 .col-lg-12 h3 {
                font-size: 1.5rem;
            }

            .list-group-item {
                padding: 10px 15px;
            }

            .float-left, .float-right {
                float: none !important;
                display: block;
                width: 100%;
            }

            .float-right {
                text-align: center;
                margin-top: 10px;
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
            <?= isset($msg) ? $msg : ''; ?>
                <h3 class="h5 text-uppercase text-center text-muted">Alugar Material</h3>
                <h2 class="h2 text-uppercase text-center mb-0">Selecione o Material</h2>
            </div>
        </div>

        <?php foreach ($category as $category_row) : ?>
            <div class="row mb-3">
                <div class="col-md-4">
                    <img src="<?= $category_row->preview_image_picture(); ?>" class="img-fluid img-custom" alt="">
                </div>
                <div class="col-md-8">
                    <ul class="list-group">
                        <li class="list-group-item bg-danger active">
                            <h6 class="h6 text-center"> Nome do Produto: <?= $category_row->nome; ?> </h6>
                        </li>
                        <li class="list-group-item list-group-item-light"><b>ESTE PACOTE INCLUI:</b></li>
                        
                        
                        <li class="list-group-item">Preço: <span class="preco"><?= $category_row->preco; ?></span></li>
                        <li class="list-group-item">Quantidade: <?= $category_row->quantidade; ?></li>
                    </ul>
                    <div class="float-right">
                        <button class="btn btn-sm btn-success active add-to-cart" style="border-radius: 3px;margin-top: 9px;" data-id="<?= $category_row->id; ?>" data-nome="<?= $category_row->nome; ?>" data-preco="<?= $category_row->preco; ?>">Adicionar no Carrinho</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!-- Carrinho de Compras -->
<div id="carrinho-container">
    <h3 class="h5 text-uppercase text-center text-muted">Carrinho de Materiais <img src="../images/pngwing.com.png" alt="Carrinho" class="cart-icon"></h3>
    <form method="post" enctype="multipart/form-data">
        <div class="carrinho-content">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Total</th>
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
            <button name="pagamento" id="prosseguir-pagamento" class="btn btn-primary">Prosseguir para Pagamento</button>
        </div>
    </form>
</div>

    <script src="js/app.js"></script>
          

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
        let produtos =' ';
        carrinho.forEach(item => {
            const itemTotal = item.preco * item.quantidade;
            total += itemTotal;
            produtos += item.nome+'; ';
            carrinhoItems.innerHTML += `
                <tr>
                <td>${item.id}</td>
                    <td>${item.nome}</td>
                    <input type="hidden" name="id" value="${item.id}">
                    <input type="hidden" name="produto" value="${produtos}" style="width: 70px;" max="100" class="form-control quantidade" data-id="${item.id}">
                    <td>${item.preco}</td>
                    <td><input type="number" name="quantidade" value="${item.quantidade}" maxlength="4" size="10" style="width: 70px;" min="0" max="100" class="form-control quantidade" data-id="${item.id}"></td>
                    <td>${itemTotal}</td>
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