
<style>
    .nav-item{
        background-color: #F8F9FA;  
    }

    a{
        color: #242424;
    }

    ul li{
        margin-top: 1.5px;
        background-color: red;
    }

    ul li a{
        font-weight: none;
        font-size: 11pt;
    }

    .navbar{
        background-color: white;
        height: 50px;
    }

    .navbar-brand{
        width: 100%;
        margin-left: 50px;
        padding: 0px 0px 0px 0px;
    }

    @media (max-width: 360px) {
            /* Estilos para telas menores que 360px de largura */
            /* Exemplo de redução de tamanho de fonte */
            .row .box-shadow{
                width: 100%;
                margin: 0px 0px 0px 0px;
            }

            .navbar{
                width: 100%;
                
                padding: 0px 0px 0px 0px;
                text-align: center;
                z-index: 1;
                margin-top: -5px;
            }

            nav{
                background-color: green;
            }

            nav .navbar{
                text-align: center;
            }

            .navbar-brand{
                background-color: #f44336;
                margin-bottom: 40px;
                margin-top: 0px;
                text-align: center;
                width: 900%;
                margin-left: 100px;
            }

            nav a{
                font-size: 10pt;
                font-weight: normal;
                text-align: center;
            }
            
        }

</style>

<nav class="navbar sticky-top p-0" style="width: 16.7%;background-color: #f44336;">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" style="color:white;text-right:center;" href="client_profile.php">
        <!-- <img src="images/admin.png" alt="" style="width: 200px;"> -->
        <b>DADEC</b> - Cliente
    </a>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item mt-3">
                        <div class="text-center">
                            <a href="client_profile.php" class="user-button">
                                <img src="<?= $cliente_profile->profile_picture_picture(); ?>" class="img-fluid rounded-circle" width="52" height="52" alt="">
                                <div class="user-profile"> <b> <?= $cliente_profile->nome; ?> </b></div>
                            </a>
                                <div class="text-center mt-0" style="font-size: 11px;color:#72777a;">
                                    Cliente
                                </div>
                        </div>
                    </li>
                    <li class="nav-item"><div class="dropdown-divider"></div></li>

                    <li class="nav-item">
                        <a class="nav-link" href="client_profile.php">
                            <i class="mdi mdi-account mr-3" style="color:#242424;"></i>
                            Perfil do Cliente<span class="sr-only">(current)</span>
                        </a>
                    </li>

                    <!--
                    <li class="nav-item"><div class="dropdown-divider"></div></li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog_events.php">
                            <i class="mdi mdi-comment-text mr-3" style="color:#795548;"></i>
                            Publicações de Eventos
                        </a>
                    </li>
                    -->

                    <li class="nav-item"><div class="dropdown-divider"></div></li>
                    <li class="nav-item">
                        <a class="nav-link" href="alugar_material.php" >
                            <i class="mdi mdi-cart mr-3" style="color: #2196f3"></i>
                            Alugar Produto
                        </a>
                    </li>

                    <li class="nav-item"><div class="dropdown-divider"></div></li>

                    <li class="nav-item">
                        <a class="nav-link" href="decoracao.php">
                            <i class="mdi mdi-briefcase service-icon mr-3" style="color: #4caf50;"></i>
                            Decoração
                        </a>
                    </li>
                    <li class="nav-item"><div class="dropdown-divider"></div></li>
                    <li class="nav-item">
                        <a class="nav-link" href="pagamento_cliente.php">
                            <i class="mdi mdi-credit-card mr-3" style="color: #f44336!important;"></i>
                            Pagamentos
                        </a>
                    </li>
                    
                    <!--
                    <li class="nav-item"><div class="dropdown-divider"></div></li>
                    <li class="nav-item">
                        <a class="nav-link" href="client.php" >
                            <i class="mdi mdi-account-multiple mr-3" style="color: #2196f3"></i>
                            Clientes
                        </a>
                    </li>
                    -->

                    <!--
                    <li class="nav-item"><div class="dropdown-divider"></div></li>
                    <li class="nav-item">
                        <a class="nav-link" href="cliente1.php" >
                            <i class="mdi mdi-account mr-3" style="color: #2196f3"></i>
                            Clientes
                        </a>
                    </li>
                    -->
                                     

                    <li class="nav-item"><div class="dropdown-divider"></div></li>     
                    <li class="nav-item">
                        <a class="nav-link" href="service_list.php">
                            <i class="mdi mdi-message message-icon mr-3" style="color: brown;"></i>
                            Chat
                        </a>
                    </li>
                    <li class="nav-item"><div class="dropdown-divider"></div></li>                 

                    <!--
                    <li class="nav-item">
                        <a class="nav-link" href="photos_view.php">
                            <i class="mdi mdi-image-multiple mr-3" style="color:#673ab7!important"></i>
                            Galeria
                        </a>
                    </li>
                    
                    <li class="nav-item"><div class="dropdown-divider"></div></li>
                    <li class="nav-item">
                        <a class="nav-link" href="photos_add.php">
                            <i class="mdi mdi-upload-multiple mr-3" style="color: #e91e63!important"></i>
                            Carregar Photos
                        </a>
                    </li>
                    <li class="nav-item"><div class="dropdown-divider"></div></li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">
                            <i class="mdi mdi-account-card-details mr-3" style=" color: #03a9f4!important;"></i>
                            Usuários
                        </a>
                    </li>
                    -->
                </ul>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10" style="margin-top: -40px;z-index: 999">
            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-left:-15px;margin-right: -15px;">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">

                    </ul>
                </div>

                <div class="form-inline my-2 my-lg-0">
                    <a class="nav-link" href="users_profile.php"><b><?= ucfirst($cliente_profile->nome)?></b></a>
                    <a class="nav-link" href="logout1.php"><b><i class="mdi mdi-logout" style="color: #f44336!important;"></i> Sair</b></a>
                </div>
            </nav>

            
        