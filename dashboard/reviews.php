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
        <link rel="stylesheet" href="css/dashboard_style.css">
        <title>Reviews</title>
    </head>
    <body>

        <!-- Start navbar -->
        <?php include('includes/navbar.php') ?>
        <!-- end navbar -->

        <!-- start reservations-details -->
        <section class="reservations-details mt-7">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row no-gutters">
                            <div class="col-12">

                                <div class="table-responsive">
                                    <table class="table table-striped min-height-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">review id</th>
                                                <th scope="col">Playfield</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Scale</th>
                                                <th scope="col">message</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once('connection.php');
                                            $review = "SELECT review.review_id ,  review.scale , review.msg,  playfields.name , users.full_name FROM review INNER JOIN playfields on playfields.id = review.playfield_id INNER JOIN users on review.users_id = users.users_id";
                                            $query = mysqli_query($conn,$review) or die("Error:".mysqli_error($conn)) ;
                                            $result= mysqli_fetch_array($query);
                                            do{
                                            ?>
                                            <tr>
                                                <th scope="row"><?php echo $result['review_id'] ?></th>
                                                <td><?php echo $result['name'] ?></td>
                                                <td><?php echo $result['full_name'] ?></td>
                                                <td><?php echo $result['scale'] ?></td>
                                                <td><?php echo substr($result['msg'],0,250).'...' ?></td>
                                            </tr>
                                            <?php
                                            }
                                            while($result=mysqli_fetch_array($query));
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
        <!-- end reservations -->
        
        <!-- Start footer -->
        <?php include('includes/footer.html') ?>
        <!-- end footer -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>