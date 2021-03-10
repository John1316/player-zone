<?php
require_once('connection.php');
session_start();
    if (isset($_POST['notification_form'])) {
    $notid = $_POST['notid'];
    // $notplayfield = $_POST['notplayfield']; 
    // $notusers_id = $_POST['notusers_id']; 
    // $nothours = $_POST['nothours']; 
    // $notstatus = $_POST['notstatus']; 
    // $notuprice = $_POST['notuprice']; 
    // $notorder_date = $_POST['notorder_date']; 
    // $notplay_status = $_POST['notplay_status']; 
    // $notdate = $_POST['notdate']; 
    // $nottime = $_POST['nottime']; 
    // $notvisa = $_POST['notvisa']; 
    $notmsg = $_POST['notmsg']; 
    $notification_sql= "UPDATE reservation SET 
        -- playfield_id='$notplayfield' ,
        -- users_id='$notusers_id',
        -- hours='$nothours' ,
        -- status='$notstatus' ,
        -- uprice='$notuprice' ,
        -- reservation_date='$notorder_date' ,
        -- play_status='$notplay_status' ,
        -- visa='$notvisa' ,
        -- date_reservation='$notdate' ,
        -- time_reservation='$nottime' ,
        notification='$notmsg' WHERE reservation_id='$notid'"; 

    if(!mysqli_query($conn,$notification_sql)){ 
        die('Error:'. mysqli_error($conn));
    } else {
        $notification_msg ="Data sent successfully";
    }
}

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
        <title>Reservations</title>
    </head>
    <body>

        <!-- Start navbar -->
        <?php include('includes/navbar.php') ?>
        <!-- end navbar -->

        <!-- start reservations-details -->
        <section class="reservations-details mt-7 mb-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row no-gutters">
                            <div class="col-12">
                            <?php if(isset($notification_msg)): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <h5><?= $notification_msg ?></h5>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>
                                <div class="table-responsive">
                                    <table class="table table-striped min-height-table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Reservation id</th>
                                                
                                                <th scope="col">Status</th>
                                                
                                                <th scope="col">Notification</th>
                                                <th scope="col">&nbsp;</th>
                                                <th scope="col">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once('connection.php');
                                            $reservation = "SELECT * FROM reservation ORDER by reservation_id ASC";
                                            $query = mysqli_query($conn,$reservation) or die("Error:".mysqli_error($conn)) ;
                                            $result= mysqli_fetch_array($query);
                                            do{
                                                if ($result['status'] == 'pending') {
                                                    $status = "<span class='btn btn-danger'>Pending</span>";
                                                } else {
                                                    $status = "<span class='btn btn-success'>Approved</span>";
                                                } 
                                                $commission = 0.3 * ($result['uprice'] * $result['hours']);
                                                $total = ($result['uprice'] * $result['hours'] ) + $commission;
                                                ?>
                                            <tr>
                                                <td><?php echo $result ['reservation_id']; ?></td>
                                                <td><?php echo $status ?></td>
                                            
                                                <td><?php echo $result['notification'] ?></td>
                                                <td><button data-toggle="modal" data-target="#message<?php echo $result ['reservation_id']; ?>" class="btn btn-info"><i class="fas fa-envelope"></i></button></td>
                                                <td><button data-toggle="modal" data-target="#status<?php echo $result ['reservation_id']; ?>" class="btn btn-success"><i class="fas fa-check"></i></button></td>
                                            </tr>
                                                <div class="modal fade" id="message<?php echo $result ['reservation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Send Notification</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <form action="" method="post" enctype="multipart/form-data">
                                                                    <div class="row no-gutters">
                                                                        <input type="hidden" name="notid" value="<?php echo $result ['reservation_id']; ?> ?>">
                                                                        <!-- <input name="notplayfield" type="hidden" value="<?php echo $result ['playfield_id']; ?>" class="form-control validate" required />
                                                                        <input name="notusers_id" type="hidden" value="<?php echo $result ['users_id']; ?>" class="form-control validate" required />
                                                                        <input name="nothours" type="hidden" value="<?php echo $result ['hours']; ?>" class="form-control validate" required />
                                                                        <input name="notstatus" type="hidden" value="<?php echo $result ['status']; ?>" class="form-control validate" required />
                                                                        <input name="notuprice" type="hidden" value="<?php echo $result ['uprice']; ?>" class="form-control validate" required />
                                                                        <input name="notorder_date" type="hidden" value="<?php echo $result ['reservation_date']; ?>" class="form-control validate" required />
                                                                        <input name="notplay_status" type="hidden" value="<?php echo $result ['play_status']; ?>" class="form-control validate" required />
                                                                        <input name="notvisa" type="hidden" value="<?php echo $result ['visa']; ?>" class="form-control validate" required />
                                                                        <input name="notdate" type="hidden" value="<?php echo $result ['date_reservation']; ?>" class="form-control validate" required />
                                                                        <input name="nottime" type="hidden" value="<?php echo $result ['time_reservation']; ?>" class="form-control validate" required /></div> -->
                                                                        <div class="col-12 my-2"><label for="notmsg">Notification</label><textarea name="notmsg" row="5" col="3" type="text" class="form-control validate" required><?php echo $result ['notification']; ?></textarea></div>
                                                                        <div class="col-12 my-2"><button type="submit" name="notification_form" class="btn btn-primary btn-block my-3">Send Notification</button></div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="modal fade" id="status<?php echo $result ['reservation_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Send Notification</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <form action="" method="post" enctype="multipart/form-data">
                                                                    <div class="row no-gutters">
                                                                        <h6>Do you want to approve reservation <?php echo $result ['reservation_id']; ?></h6>

                                                                        <input type="hidden" name="notid" value="<?php echo $result ['reservation_id']; ?> ?>">
                                                                        <input name="notplayfield" type="hidden" value="<?php echo $result ['playfield_id']; ?>" class="form-control validate" required />
                                                                        <input name="notusers_id" type="hidden" value="<?php echo $result ['users_id']; ?>" class="form-control validate" required />
                                                                        <input name="nothours" type="hidden" value="<?php echo $result ['hours']; ?>" class="form-control validate" required />
                                                                        <input name="notstatus" type="hidden" value="Approved" class="form-control validate" required />
                                                                        <input name="notuprice" type="hidden" value="<?php echo $result ['uprice']; ?>" class="form-control validate" required />
                                                                        <input name="notorder_date" type="hidden" value="<?php echo $result ['reservation_date']; ?>" class="form-control validate" required />
                                                                        <input name="notplay_status" type="hidden" value="<?php echo $result ['play_status']; ?>" class="form-control validate" required />
                                                                        <input name="notvisa" type="hidden" value="<?php echo $result ['visa']; ?>" class="form-control validate" required />
                                                                        <input name="notdate" type="hidden" value="<?php echo $result ['date_reservation']; ?>" class="form-control validate" required />
                                                                        <input name="nottime" type="hidden" value="<?php echo $result ['time_reservation']; ?>" class="form-control validate" required /></div>
                                                                        <input name="notmsg" type="hidden" value="<?php echo $result ['notification']; ?>" class="form-control validate" required /></div>
                                                                        <div class="col-12 my-2"><button type="submit" name="notification_form" class="btn btn-primary btn-block my-3">Approve</button></div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>   
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