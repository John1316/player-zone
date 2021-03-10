<?php
session_start();
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
        <link rel="stylesheet" href="css/style.css">
        <style>
            .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
                color: #fff !important;
                background-color: #388004 !important;
            }
            .nav-pills a{
                color: #388004 !important;
            }
            .min-height-500px{
                min-height:550px;
            }
        </style>
        <title>profile</title>
    </head>
<body>

    <!--start navbar-->
    <?php include('includes/navbar.php'); ?>
    <!--end navbar-->
    
    <section class="profile mt-5">
        <div class="container-fluid">
            <div class="row py-5">
                <div class="col-lg-2 col-12">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
                        <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Profile</a>
                    </div>
                </div>
                <div class="col-lg-10 col-12">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="table-responsive">

                                <table class="table text-center min-height-500px">
                                    <thead>
                                        <tr class="bg-success text-white">
                                            <th scope="col">Full name</th>
                                            <th scope="col">username</th>
                                            <th scope="col">Phone</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td><?php echo $_SESSION['full_name']; ?></td>
                                            <td><?php echo $_SESSION['username']; ?></td>
                                            <td><?php echo $_SESSION['phone']; ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <div class="table-responsive">

                                <table class="table  text-center min-height-500px">
                                    <thead>
                                        <tr class="bg-success text-white">
                                            <th>Reservation ID</th>
                                            <th>Status</th>
                                            <th>Playing time</th>
                                            <th>Playfield image</th>
                                            <th>Playfield Name</th>
                                            <th>Reservation date</th>
                                            <th>Notification</th>
                                            <th>Total price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once('connection.php');
                                        $status = "";
                                        $sql = "SELECT reservation.reservation_id, reservation.hours ,  reservation.reservation_date ,reservation.time_reservation, reservation.users_id, reservation.status , reservation.play_status, playfields.image, playfields.name, playfields.price , reservation.notification FROM reservation INNER JOIN playfields on playfields.id = reservation.playfield_id INNER JOIN users on reservation.users_id = users.users_id where reservation.users_id =".$_SESSION['users_id']." ";
                                        $result = mysqli_query($conn, $sql);
                                    

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($user_reservation = mysqli_fetch_array($result)) {
                                                ?>
                                    <?php
                                    if ($user_reservation['status'] == 'pending') {
                                        $status = "<span class='btn btn-danger'>Pending</span>";
                                    } else {
                                        $status = "<span class='btn btn-success'>Approved</span>";
                                    } 
                                    
                                    ?>
                                        <tr>
                                            <td><?php echo $user_reservation['reservation_id']; ?></td>
                                            <td><?php echo $status; ?></td>
                                            <td><?php echo $user_reservation['time_reservation'] ?></td>
                                            <td><img src="images/<?php echo $user_reservation['image']; ?>" width="70" height="70"></td>
                                            <td><?php echo $user_reservation['name']; ?></td>
                                            <td><?php echo $user_reservation['reservation_date']; ?></td>
                                            <td><?php echo $user_reservation['notification'] ?></td>
                                            <td><?php echo $user_reservation['price'] * $user_reservation['hours'] ?></td>

                                        </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>

    <!--start footer-->
    <?php include('includes/footer.html'); ?>
	<!--end footer-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    </body>
</html>