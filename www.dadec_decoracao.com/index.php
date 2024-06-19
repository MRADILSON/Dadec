<?php include 'admin/include/init.php'; ?>
<?php
    $count = 0;
    $error = '';
    $user_firstname = $user_lastname = $user_password = $user_email = $wedding_date = '';

    $account_details = new Account_Details();
    $accounts = new Accounts();
    $booking = new Booking();
    $category = Category::find_all();
    $blogEvent = EventWedding::getEventBlogs();
?>
<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Planejador de Casamento</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .alert {
            font-size: 12px;
        }
        .error {
            background-color: #F2DEDE;
        }
        .alert.alert-danger.text-center {
            font-size: 16px;
        }
        .mdi.mdi-alert-circle.mr-3 {
            font-size: 16px;
        }

        .bgact{
                /* background: rgba(255, 255,255, 0.4); */
                background: rgb(14 14 14 / 49%);
                padding: 15px;
        }
        .carousel-item {
            padding: 15px;
        }

        .carousel-item ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .carousel-item li {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        .carousel-item li img {
            max-width: 50%;
            height: auto;
        }

        .carousel-inner {
            display: flex;
            flex-wrap: wrap;
        }

        .carousel-inner .carousel-item {
            flex: 1 0 100%;
        }

        .list-group-item{
            width: 100%;
            height: auto;
            text-align: center;
            justify-content: center;
            align-items: center;
        }

       

        /* Media Query for mobile devices */
        @media (max-width: 890px) {
            .hero {
                margin-top: 8%;
                height: 100%;
               
            }
            .bgact {
                margin-top: 40px;
                padding: 10px;
                width: 250%;
                margin-left: -80px;
            }
            .col{
                width: 100%;
                height: 100%;
            }
            .cotainer-fluid{
                height: 60%;
            }
            .hero-lead {
                font-size: 24px;
            }
            .lead {
                font-size: 14px;
            }
            .text-center p {
                font-size: 10px;
            }
            .btn-custom {
                font-size: 14px;
            }
            .pricing ul {
                padding: 0;
            }
            .pricing ul li {
                font-size: 14px;
                padding: 5px;
            }
            .card-columns {
                column-count: 1;
            }
            .card-title {
                font-size: 16px;
            }
            .card-text {
                font-size: 12px;
            }
            .feature ul li {
                font-size: 14px;
            }
            .feature h1 {
                font-size: 24px;
            }
            .feature p {
                font-size: 12px;
            }
            .carousel-item li img {
            max-width: 100%;
            height: auto;
            }
            .row .justify-content-md-center{
            height: 100%;
            }
            .hero {
            width: 100%;
            background-size: contain;
            background-size: 100% 100%;
            }     
        }

    </style>
</head>
<body>
<?php include 'include/nav.php'; ?>

<div class="container-fluid">
    <div class="row justify-content-md-center">
        <div class="hero">
            <div class="row justify-content-md-center">
                <div class="col col-lg-3">
                </div>
                <div class="col col-lg-5" style="margin-top: 10%;">
                    
                    <?php
                        if ($session->message()) {
                            echo $session->message();
                        }
                    ?>
                    <form class="bgact" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <h2 class="text-center hero-lead">Planeje a decoração do Seu Evento e Aluguel de Materiais Aqui</h2><br><br><br><br><br>
                    <p class="lead text-center" style="color:white;">COMECE PREECHENDO O FORMULÁRIO</p>
                    
                        <div class="text-center mt-3">
                            <p style="font-size: 11px;color:white;">Ao clicar em "Increver" concordas com o uso do Site <a
                                        href="" title="" style="color: #b81717;font-weight: bold;">Termos de Uso</a></p>
                            <a type="submit" href="sign_up.php" class="btn btn-danger btn-sm text-uppercase fb"
                                    style="margin-top: -5px;">Inscrição
                    </a>
                        </div>
                    </form>
                </div>
                <div class="col col-lg-3">
                </div>
            </div>
        </div><!-- end of hero -->
    </div> <!-- end of row justify-content-md-center -->
</div><!-- end of container-fluid  -->

<div class="container-fluid custom-container">
    <div class="row">
        <div class="col-lg-12">
            <hr>
            <h2 class="h2 text-uppercase text-center mb-4">TIPOS DE EVENTOS</h2>
            <div id="pricingCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php foreach ($category as $index => $category_row) : ?>
                        <div class="carousel-item <?php if ($index == 0) echo 'active'; ?>">
                            <ul class="list-group list-unstyled">
                                <li class="list-group-item text-center text-uppercase"><?= $category_row->wedding_type; ?></li>
                                <li><img src="admin/<?= $category_row->preview_image_picture(); ?>" class="img-fluid" alt=""></li>
                                <li class="list-group-item text-center"><b>ESTE PACOTE INCLUI:</b></li>
                                <?php $feature = Features::find_by_feature_all($category_row->id); ?>
                                <?php foreach ($feature as $feature_item) : ?>
                                    <li class="list-group-item"><?= $feature_item->title; ?></li>
                                <?php endforeach; ?>
                                <li class="list-group-item font-weight-bold">
                                    <a href="package_detail.php?id=<?= $category_row->id; ?>" class="btn btn-custom">Ver Detalhes</a>
                                </li>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a class="carousel-control-prev" href="#pricingCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#pricingCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <br>
            <br>
            <h2 class="h2 text-uppercase text-center mb-3">PUBLICAÇÕES RECENTES</h2>
            <h6 class="h6 text-uppercase text-center text-muted mb-3">Descubra as melhores idéias, gorjetas e artigos para inspirar seu evento.</h6>

            <div class="card-columns">

                <?php foreach($blogEvent as $blog_item) : ?>
                   <div class="card">
                    <img class="card-img-top" src="admin/<?= $blog_item->preview_image_picture(); ?>" alt="Card image cap">
                        <div class="card-body">
                            <a href="wedding_details.php?id=<?= $blog_item->id; ?>" class="btn-stamp">
                                <h6 class="card-title mt-0 mb-0 text-center font-weight-bold font-custom text-uppercase"><?= $blog_item->title; ?></h6>
                                <p class="card-text mt-0 mb-0 text-center color_gray"><?= $blog_item->wedding_type; ?> Eventos</p>
                                <p class="card-text mt-0 mb-0 text-center color_light text-capitalize"><i class="mdi mdi-map-marker"></i>
                                    <?= $blog_item->location; ?></p>
                            </a>
                        </div>
                    </div> 
                <?php endforeach; ?>

                <a href="real-weddings.php" class="btn btn-lg btn-block btn-explore">EXPLORAR MAIS PUBLICAÇÕES</a>
            </div>
        </div><!-- end of col-lg-12 -->
    </div><!-- end of row -->
</div><!-- end of container -->


<div class="container-fluid" style="width: 100%;background: white;margin-top: 50px;padding-bottom: 20px;">
    <div class="row">
        <div class="col-lg-6">
            <div class="row img-control">
                <div class="col-md-1"></div>
                <div class="col-md-2">
                    <img src="DESIGN/checklist-ea253352239433deb24f2ed8ae110aac1840ff8fa5df43967027e880b5f5385b.svg"
                         alt="">
                    <div class="font-custom">Conferir</div>
                </div>
                <div class="col-md-2">
                    <img src="DESIGN/seating-chart-084bbdaabe84a638edf344224d7a92b1bc792db53c5fcf7ab16fcd5a6109ff79.svg"
                         alt="">
                    <div class="font-custom">Gráfico</div>
                </div>
                <div class="col-md-2">
                    <img src="DESIGN/guest-list-eaaf9277c60be7449e41e2f72f358ae3c94c1b31726b894e064498a9536cac9a.svg"
                         alt="">
                    <div class="font-custom">Lista de Convidados</div>
                </div>
                <div class="col-md-2">
                    <img src="DESIGN/budget-6eca6d3898f15dd5682ce3664d8d9ff9bdd271db03857ba8a99e90b9181db46c.svg"
                         alt="">
                    <div class="font-custom">Orçamento</div>
                </div>
                <div class="col-md-2">
                    <img src="DESIGN/vendor-manager-102fbe8fdbab3e176a6d29bd05c6f26dcd35cfa0f55ff50b1bfd9e70c8fdcdda.svg"
                         alt="">
                    <div class="font-custom">Vendor Manager</div>
                </div>

            </div>
                <h1 class="h1 text-center mt-4">Tire estresse no Planejamento</h1>
                <p class="lead text-muted text-center ml-5" style="font-size: 14px;">Confira coisas e personalize tudo para seu grande dia!</p>
        </div>
        <div class="col-lg-6">
            <div class="feature">
                <ul class="list-group rounded-0">
                    <li class="list-group-item rounded-0 d-flex justify-content-between align-items-center ">Anúncie seu compromisso
                        <span class="badge badge-pill" style="font-size: 12px;font-weight: bold;color:#888;">Vencido e não pago <i class="mdi mdi-checkbox-blank-outline ml-3" ></i></span>
                    </li>
                    <li class="list-group-item rounded-0 d-flex justify-content-between align-items-center">Planeje sua festa de compromisso
                        <span class="badge badge-pill" style="font-size: 12px;color:#888">Hoje <i class="mdi mdi-checkbox-blank-outline ml-3"></i></span>
                    </li>
                    <li class="list-group-item rounded-0 d-flex justify-content-between align-items-center">Publicações de Eventos Realizados
                        <span class="badge badge-pill" style="font-size: 12px;color:#888">Amanhã <i class="mdi mdi-checkbox-blank-outline ml-3"></i></span>
                    </li>
                    <li class="list-group-item rounded-0 d-flex justify-content-between align-items-center">Crie o seu Registo
                        <span class="badge badge-pill" style="font-size: 12px;color:#888">Maio 15 <i class="mdi mdi-checkbox-blank-outline ml-3"></i></span>
                    </li>
                    <li class="list-group-item rounded-0 d-flex justify-content-between align-items-center">Comece sua lista de convidados
                        <span class="badge badge-pill" style="font-size: 12px;color:#888">Hoje <i class="mdi mdi-checkbox-blank-outline ml-3"></i></span>
                    </li>
                    <li class="list-group-item rounded-0 d-flex justify-content-between align-items-center">Decida sobre o seu Evento
                        <span class="badge badge-pill" style="font-size: 12px;color:#888">Junho 10 <i class="mdi mdi-checkbox-blank-outline ml-3"></i></span>
                    </li>
                    <li class="list-group-item rounded-0 d-flex justify-content-between align-items-center">Selecione sua Data de Evento
                        <span class="badge badge-pill" style="font-size: 12px;color:#888">Junho 20 <i class="mdi mdi-checkbox-blank-outline ml-3"></i></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<footer class="pt-3">
    <div class="row">
        <div class="col-12 col-md">
            <div class="text-center">
                <small class="d-block mb-3 text-muted">&copy; <?php echo date('Y')?> - Developed By Daniel Zacarias</small>
            </div>
        </div>
    </div>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>
<script src="js/savy.js"></script>
<script>

    $(document).ready(function () {
        $('#wedding_date').datepicker();
    <?php
        if($count == 0) {
    ?>
        $('#user_firstname').savy('load');
        $('#user_lastname').savy('load');
        $('#user_email').savy('load');
        $('#user_phone').savy('load');
        $('#wedding_date').savy('load');
    <?php } else { ?>
        $('#user_firstname').savy('destroy');
        $('#user_email').savy('destroy');
        $('#user_lastname').savy('destroy');
        $('#user_phone').savy('destroy');
        $('#wedding_date').savy('destroy');
    <?php } ?>
    });
</script>
</body>
</html>