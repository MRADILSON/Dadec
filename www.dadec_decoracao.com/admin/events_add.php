<?php include 'include/init.php'; ?>
<?php


    if (!isset($_SESSION['id'])) { redirect_to("../"); }
    
    $booking_id = $_GET['booking_id'];
    $user_id = $_GET['user_id'];
    $links='booking_id='.$booking_id.'&user_id='.$user_id;
    
    $events =  Events::find_by_event_all($booking_id);
    if (isset($_POST['submit'])) {

        $event_id = clean($_POST['event_id']);
        $title = clean($_POST['title']);
        $description = clean($_POST['description']);
       
         if (empty($wedding_type) || empty($title) || empty($description)) {
            redirect_to("events_add.php");
            $session->message("
            <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-account-alert'></i></strong> Please Fill up all the information.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
            die();
        }

        $features->title = $title;
        $features->category_id = $wedding_type;
        $features->description = $description;
        $features->save();
        redirect_to("Events.php");
        $session->message("
            <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
              <strong><i class='mdi mdi-check'></i></strong> {$features->title} is successfully added.
              <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                <span aria-hidden=\"true\">&times;</span>
              </button>
            </div>");
    }


?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
    <!doctype html>
    <html lang="pt">
    <head>
        <title>Add New Events - Administrator</title>

        <?php
        include 'include/header.php';
    ?>
        <style>
            body {
                margin-bottom: 2%;
            }
            .box-shadow {
                box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.3);
                font-size: 12px;
            }
            .form-control {
                font-size: 12px;
            }
            .datepicker {
                font-size: 12px;
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
    <div class="container">

        <div class="row">

            <div class="col-lg-8 offset-2 pl-3 pb-3 box-shadow mt-4">
            
                <form method="post" action="">

                    <h4 class="h4 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">Event Name</h4>

                    <?php
                        if ($session->message()) {
                            echo ' <div class="form-group col-md-12">' . $session->message() . '</div>';
                        }
                    ?>

                     <div class="form-group">
                        <label for="event_id">Event To Related:</label>
                        <select class="custom-select form-control" id="event_id" name="event_id">
                          <?php foreach($events as $events_title) : ?>
                              <option value="<?= $events_title->id; ?>"><?= $events_title->title; ?></option>
                          <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="family">Number of Family:</label>
                        <input type="text" name="family" class="form-control" id="family"  placeholder="Enter the number">
                    </div>

                    <div class="form-group">
                        <label for="individual">Number of individual:</label>
                        <input type="text" name="individual" class="form-control" id="individual"  placeholder="Enter the number">
                    </div>

                    <div class="form-group">
                        <label for="yes">Number of yes:</label>
                        <input type="text" name="yes" class="form-control" id="yes"  placeholder="Enter the number">
                    </div>

                    <div class="form-group">
                        <label for="no">Number of no:</label>
                        <input type="text" name="no" class="form-control" id="no"  placeholder="Enter the number">
                    </div>

                     <a href="Events.php" class="btn btn-sm btn-danger float-right" style="font-size: 12px;">Cancel</a>
                    <button type="submit" name="submit" class="btn btn-sm btn-light float-right mr-2" style="font-size: 12px;">Save</button>

                </form><!-- end of input form -->
            </div>
        </div>
    </div>



</div>
</div>
</main>
<script src="js/app.js"></script>
            <footer class="footer">
                <?php include 'include/footer1.php' ?>
            </footer>
            </div>