<?php include 'admin/include/init.php'; ?>
<?php 
    $id = $_GET['id'];
    $category = Category::find_by_id($id);

    $count = 0;
    $error = $user_firstname = $user_lastname = $user_password = $user_email = $wedding_date = '';

    $account_details = new Account_Details();
    $accounts = new Accounts();
    $booking = new Booking();

    if (isset($_POST['register'])) {

        $user_firstname = clean($_POST['user_firstname']);
        $user_lastname  = clean($_POST['user_lastname']);
        $user_email     = clean($_POST['user_email']);
        $user_password  = clean($_POST['user_password']);
        $wedding_date   = clean($_POST['wedding_date']);
        $user_phone     = clean($_POST['user_phone']);
        $bid = clean($_POST['booking_id']);

        $checkdate = $booking->check_wedding_date($wedding_date);

        if ($checkdate) {
            redirect_to("package_detail.php?id=$bid");
            $session->message("
            <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-alert'></i></strong>  O casamento que selecionou já está reservado. Por favor tente em outra data!
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        }

        if (empty($user_firstname) ||
        empty($user_phone) ||
        empty($user_email) ||
        empty($user_lastname) ||
        empty($wedding_date)) {
            redirect_to("package_detail.php?id=$bid");
        $session->message("
        <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
          <strong><i class='mdi mdi-alert'></i></strong>  Por favor preencha todo formulário.
          <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
            <span aria-hidden=\"true\">&times;</span>
          </button>
        </div>");
        die();
    }

        if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)){
            redirect_to("package_detail.php?id=$bid");
            $session->message("
            <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-alert'></i></strong>  Formato de email incorrecto.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();

        }

        $check_email = $accounts->email_exists($user_email);

        if ($check_email) {
            redirect_to("package_detail.php?id=$bid");
            $session->message("
            <div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-alert'></i></strong>  Email já existe.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        } else {
            if ($error == '') {
                $count = $count + 1;
                $account_details->firstname = $user_firstname;
                $account_details->lastname = $user_lastname;
                $account_details->status = 'Pendente';
                $account_details->phone = $user_phone;
                $account_details->datetime_created  = date("y-m-d h:m:i");

                if ($account_details->save()) {
                    $account_details->user_id = mysqli_insert_id($db->connection);

                    if($account_details->update()) {
                        $accounts->user_id = $account_details->user_id;
                        $accounts->user_email= $user_email;

                         if($accounts->save()) {
                             $booking->user_id = $accounts->user_id;
                             $booking->wedding_type = $bid;
                             $booking->user_email = $user_email;
                             $booking->wedding_date =  $wedding_date;
                             $booking->save();
                             redirect_to("package_detail.php?id=".$bid);

                             $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-check'></i></strong> {$account_details->firstname} {$account_details->lastname}  Adicionado com sucesso.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
                         }
                    }
                }
            }
        }
    }
?>
<!doctype html>
<html lang="pt">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Planejador de Casamento</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <style>
        body {
            margin-top: 6%;
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

        .navbar-expand-lg .navbar-nav .nav-link {
            padding-right: .9rem;
        }

        .navbar-brand {
            margin-left: 20px;
            width: 200px;
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

        .list-group-item.active {
            border-color: #00125100;
        }

        @media (max-width: 768px) {
            body {
                margin-top: 10%;
            }

            .navbar-brand {
                margin-left: 10px;
                width: auto;
            }

            .float-left, .float-right {
                float: none !important;
                display: block !important;
                text-align: center;
            }

            .list-group {
                width: 100%;
            }

            .row > div {
                margin-bottom: 20px;
            }

            .container {
                margin-top: 20px;
                width: 100%;
                max-width: 100%;
                padding: 0 15px;
            }

            .row{
                margin-top: 100px;
            }
        }
    </style>
</head>
<body>

<?php include 'include/nav.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 p-0" style="margin-bottom: 20px;">
            <div class="bg-white">
                <h5 class="h5 text-uppercase mb-5 pt-3 pl-3 pr-3">
                    <span class="d-block d-md-inline float-left text-capitalize"><?= $category->wedding_type; ?> Pacotes de Decoração</span>
                    <span class="d-block d-md-inline float-right text-capitalize">Preço: Kz <?= number_format($category->price, 2); ?></span>
                </h5>
                <img src="admin/<?= $category->preview_image_picture(); ?>" class="img-fluid img-custom" alt="">

                <ul class="list-group">
                    <li class="list-group-item list-group-item-action bg-danger flex-column align-items-start active">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 pt-2 pb-2">FUNÇÃO E SERVIÇOS</h5>
                        </div>
                    </li>
                    <?php $feature = Features::find_by_feature_no_limit($category->id); ?>
                    <?php foreach ($feature as $feature_item) : ?>
                        <li class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><i class="mdi mdi-check mr-3"></i><?= $feature_item->title; ?></h5>
                            </div>
                            <p class="mb-1 ml-3 text-capitalize"><?= $feature_item->description; ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="col-md-4">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="background: white; padding: 20px;">
                <?php
                if ($session->message()) {
                    echo $session->message();
                }
                ?>
                <h5 class="h5 text-center mb-3 m-0">Planeje a decoração do Seu Evento Aqui</h5>

                <div class="text-center mt-3">
                    <input type="hidden" name="booking_id" value="<?= $_GET['id']; ?>">
                    <a href="login.php" class="btn btn-success btn-sm text-uppercase font-weight-bold" style="margin-top: -5px;">Reservar Agora</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.2.1.slim.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-datepicker.min.js"></script>

<script>
    $(document).ready(function () {
        $('#wedding_date').datepicker();
    });
</script>
</body>
</html>
