<!doctype html>
<html lang="pt">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Eventos & Decoração</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/datepicker.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/carousel.css">
    <style>
        body {
            font-family: 'Open Sans', 'Roboto', sans-serif;
            line-height: 1.5em;
            margin-bottom: 2%;
            margin-top: 3%;
            width: 100%;
            overflow-x: hidden;
            background: #f1f1f1;
        }

        .navbar-light .navbar-brand {
            color: #1a1a1a;
            font-weight: bold;
            line-height: 22px;
        }

        .navbar {
            font-weight: 700;
            padding: 12px;
            font-style: normal;
            font-size: 14px;
            text-transform: uppercase;
            color: black;
            border-bottom: 1px solid #ddd;
        }

        li.nav-item > a.nav-link {
            color: black !important;
            font-weight: bold !important;
        }

        #review {
            font-size: 16px;
            font-weight: bold;
            margin-right: 5px;
        }

        .form-inline > a.mr-2, .btn.btn-sm.my-2.my-sm-0 {
            color: black;
            font-size: 14px;
            font-weight: 700;
            margin-left: 10px;
        }

        .form-inline > a.mr-2:hover, .btn.btn-sm.my-2.my-sm-0:hover {
            color: #17b4bc;
            text-decoration: none;
        }

        a.btn.btn-sm.my-2.my-sm-0.mr-2.loginbtn {
            background: #dc3545;
            font-size: 14px;
            color: white;
            padding: 5px;
            border: 2px solid transparent;
            width: 85px;
        }

        a.btn.btn-sm.my-2.my-sm-0.mr-2.loginbtn:hover {
            background: white;
            border: 2px solid #dc3545;
            color: #dc3545;
        }

        .navbar-expand-lg .navbar-nav .nav-link {
            padding-right: .9rem;
        }

        .navbar-brand {
            margin-left: 20px;
            width: 200px;
        }

        .form-control {
            font-size: 12px;
            border-radius: 0;
            margin-top: 0;
        }
        @media (max-width: 768px) {
            .row .text-center{
                margin-top: 20%;
            }
        }


    </style>
</head>
<body>
<?php include "include/nav.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="text-center mb-3">SOBRE O SITE</h3>
            <div class="bg-white p-4">
                <div class="contact-information">
                    <h5>Elizabeth Mualunga e Filhos</h5>
                    <div class="row">
                        <div class="col-md-8">
                            <p>
                            <i><b>Sobre nós:</b></i> A empresa Elizabeth Mualunga e Filhos Comercial é uma sociedade vocacionada 
                            no ramo de comércio geral em farmácia e prestação de serviços de decoração e buffet, que existe desde  2012.
                            </p>
                            <p>
                            <i><b>Localização:</b></i> 
                             Está localizada na Cidade do Cuito, Província do Bié na Rua Sociedade Geografia de Lisboa, por detrás da 
                             Angola Telecon.
                            </p>
                            <p>
                            <i><b>Proprietária:</b></i> Tem como proprietária a senhora Elizabeth Ludmira Firmino Mualunga e Seus Filhos. 
              </p>
                    </div>
                </div>
            </div>
            <div class="bg-white mt-3 pt-1 pl-4 pb-3">
                <div class="row mt-3">
                    <div class="col-md-12">
                        <form action="" method="post" style="font-size: 12px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-row">
                                        <div class="form-group col-md-12 mb-1">
                                            <label for="contact_person">Nome</label>
                                            <input type="email" class="form-control" id="contact_person" placeholder="Digite o Nome">
                                        </div>
                                        <div class="form-group col-md-12 mb-1">
                                            <label for="contact_email">Email</label>
                                            <input type="password" class="form-control" id="contact_email" placeholder="Digite o email">
                                        </div>
                                        <div class="form-group col-md-12 mb-1">
                                            <label for="contact_phone">Telefone</label>
                                            <input type="text" class="form-control" id="contact_phone" placeholder="Digite o numero de telefone">
                                        </div>
                                        <div class="form-group col-md-12 mb-1">
                                            <label for="contact_message">Mensagem</label>
                                            <textarea type="text" class="form-control"
                                                      style="resize: none;" rows="8"
                                                      id="contact_message" placeholder="Digite a Mensagem"></textarea>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6 pr-2">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4089449.927416999!2d16.50258997316641!3d-12.369903136366636!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1bb3cd0dbff0c37f%3A0xe6d8d539d8a9d12!2sMunic%C3%ADpio%20do%20Cuito%2C%20Bi%C3%A9%2C%20Angola!5e0!3m2!1sen!2sph!4v1622174167260!5m2!1sen!2sph" width="95%" height="395" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm rounded-0" style="font-size: 12px;margin-top: 10px;background: #22adb5;border: 0;">Enviar Mensagem</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- MODAL LOGIN SECTION-->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModal"><img src="images/logo/MOMMYAMBOL.png" alt=""></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="register.php" method="post">
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEmail" name="email"
                                   placeholder="Enter email">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Palavra-passe:</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword" placeholder="Enter password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="login" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-primary mr-2 custom-btn" style="font-size: 14px;">
                                Login
                            </button>
                            <a href="" style="color: #22adb5;">Esqueci a minha Palavra-passe?</a>
                            <br/>
                            <div class="mt-2">Não és Membro ainda? <a href="" style="color: #22adb5;">Junta-te Agora</a></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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