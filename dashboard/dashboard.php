<?php
session_start();
require_once('connection.php');
//
$users = "SELECT users_id FROM users ORDER BY users_id";
$users_count = mysqli_query($conn,$users) or die("Error:".mysqli_error($conn)) ;
$userId = mysqli_num_rows($users_count);
//
$owners = "SELECT owner_id FROM owner ORDER BY owner_id";
$owners_count = mysqli_query($conn,$owners) or die("Error:".mysqli_error($conn)) ;
$ownersId = mysqli_num_rows($owners_count);
//
$reservation = "SELECT reservation_id FROM reservation ORDER BY reservation_id";
$reservation_count = mysqli_query($conn,$reservation) or die("Error:".mysqli_error($conn)) ;
$reservationId = mysqli_num_rows($reservation_count);
//
$requested_playfield = "SELECT requested_id FROM requested_playfield ORDER BY requested_id";
$requested_count = mysqli_query($conn,$requested_playfield) or die("Error:".mysqli_error($conn)) ;
$requestedId = mysqli_num_rows($requested_count);
//
$review = "SELECT review_id FROM review ORDER BY review_id";
$review_count = mysqli_query($conn,$review) or die("Error:".mysqli_error($conn)) ;
$reviewId = mysqli_num_rows($review_count);
//
$admins = "SELECT admin_id FROM admins ORDER BY admin_id";
$admins_count = mysqli_query($conn,$admins) or die("Error:".mysqli_error($conn)) ;
$adminsId = mysqli_num_rows($admins_count);
//
$playfields = "SELECT id FROM playfields ORDER BY id";
$playfields_count = mysqli_query($conn,$playfields) or die("Error:".mysqli_error($conn)) ;
$playfield_id = mysqli_num_rows($playfields_count);
//
$time_slots = "SELECT id FROM time_slots ORDER BY id";
$time_count = mysqli_query($conn,$time_slots) or die("Error:".mysqli_error($conn)) ;
$timeslots_id = mysqli_num_rows($time_count);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="Description" content="Enter your description here"/>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/dashboard_style.css">

        <title>Home | Dashboard</title>
    </head>
    <body>

        <!-- Start navbar -->
        <?php include('includes/navbar.php') ?>
        <!-- end navbar -->

        <!-- start home-details -->
        <section class="dashboard-details mt-7">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-12 mb-3">
                        <div class="card text-center bg-primary">
                            <div class="card-body">
                                <i class="fas fa-2x mb-3 fa-user text-white" aria-hidden="true"></i>
                                <h5 class="card-title text-white"><?php echo $userId ?></h5>
                                <p class="card-text text-white">Users</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <div class="card text-center bg-success">
                            <div class="card-body">
                                <i class="fas fa-2x mb-3 fa-user-check" aria-hidden="true"></i>
                                <h5 class="card-title"><?php echo $reservationId ?></h5>
                                <p class="card-text">Reservations</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <div class="card text-center bg-info">
                            <div class="card-body">
                                <i class="fas fa-2x mb-3 fa-user-cog" aria-hidden="true"></i>
                                <h5 class="card-title"><?php echo $ownersId ?></h5>
                                <p class="card-text">Owners</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <div class="card text-center bg-warning">
                            <div class="card-body">
                                <i class="fas fa-2x mb-3 fa-user-plus" aria-hidden="true"></i>
                                <h5 class="card-title"><?php echo $requestedId ?></h5>
                                <p class="card-text">Requested Playfields</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <div class="card text-center bg-primary">
                            <div class="card-body">
                                <i class="fas mb-3 fa-2x fa-futbol"></i>
                                <h5 class="card-title"><?php echo $playfield_id ?></h5>
                                <p class="card-text">Playfields</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12 mb-3">
                        <div class="card text-center bg-success">
                            <div class="card-body">
                                <i class="fas fa-2x mb-3 fa-star" aria-hidden="true"></i>
                                <h5 class="card-title"><?php echo $reviewId ?></h5>
                                <p class="card-text">Reviews</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="card text-center bg-danger">
                            <div class="card-body">
                                <i class="fas fa-2x mb-3 fa-user-cog" aria-hidden="true"></i>
                                <h5 class="card-title"><?php echo $adminsId ?></h5>
                                <p class="card-text">Admins</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 mb-3">
                        <div class="card text-center bg-secondary">
                            <div class="card-body">
                                <i class="fas fa-2x mb-3 fa-clock" aria-hidden="true"></i>
                                <h5 class="card-title"><?php echo $timeslots_id ?></h5>
                                <p class="card-text">Time slots</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end -->

        <!-- Start footer -->
        <?php include('includes/footer.html') ?>
        <!-- end footer -->

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>