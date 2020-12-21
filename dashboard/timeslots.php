<?php
session_start();
require_once('connection.php');
if (isset($_POST['add'])) {
    $time = $_POST['time']; 
    $ins= "INSERT INTO time_slots (time,value) VALUES('$time', True)"; 
    if(!mysqli_query($conn,$ins)){ 
        die('Error:'. mysqli_error($conn));
    } else {
        $added ="Your slot added successfully";
    }

}
if (isset($_POST['reset'])) {

    $reset= " UPDATE time_slots SET value = 1 "; 
    if(!mysqli_query($conn,$reset)){ 
        die('Error:'. mysqli_error($conn));
    } else {
        $reseted ="Your time slots reseted successfully";
    }

}
if (isset($_POST['update'])) {
    $id = $_POST['pid'];
    $update_time = $_POST['utime']; 

$up= "UPDATE time_slots SET time='$update_time' , value='0' WHERE id='$id'"; 

if(!mysqli_query($conn,$up)){ 
    die('Error:'. mysqli_error($conn));
    } else {
        $updated ="Your time slots updated successfully";
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
        <title>Time slots</title>
    </head>
    <body>

        <!-- Start navbar -->
        <?php include('includes/navbar.php') ?>
        <!-- end navbar -->

        <!-- start home-details -->
        <section class="timeslots-details mt-7">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row no-gutters">
                            <div class="col-12">
                                <div class="row mb-4 justify-content-between">
                                    <button data-toggle="modal" data-target="#add" class="btn btn-main">Add Timeslots</button>
                                    <button data-toggle="modal" data-target="#reset" class="btn btn-main">Reset timslots</button>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped min-height-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Time slots</th>
                                                <th scope="col">Value</th>
                                                <th scope="col">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once('connection.php');
                                            $timeslots = "SELECT * FROM time_slots ORDER by id ASC";
                                            $query = mysqli_query($conn,$timeslots) or die("Error:".mysqli_error($conn)) ;
                                            $result= mysqli_fetch_array($query);
                                            do{
                                            ?>
                                                <tr>
                                                    <th scope="row"><?php echo $result ['id']; ?></th>
                                                    <td><?php echo $result ['time']; ?></td>
                                                    <td><?php echo $result ['value']; ?></td>
                                                    <td><button data-toggle="modal" data-target="#update<?php echo $result ['id']; ?>" class="btn btn-info"><i class="fas fa-minus-square"></i></button></td>
                                                </tr>
                                                <div class="modal fade" id="update<?php echo $result ['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Timeslot</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="container-fluid">
                                                                    <form action="timeslots.php" method="post" enctype="multipart/form-data">
                                                                        <div class="row">
                                                                            <div class="col-6 my-2"><input name="pid" type="hidden" value="<?php echo $result ['id']; ?>" class="form-control validate" required /></div>
                                                                            <div class="col-12 my-2"><label for="name">Time</label><input name="utime" type="text" value="<?php echo $result ['time']; ?>" class="form-control validate" required /></div>
                                                                            
                                                                            <button type="submit" name="update" class="btn btn-primary btn-block my-3">Delete time</button>
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
                                            <?php if(isset($added)): ?>
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <h5><?= $added ?></h5>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?php endif; ?>
                                            <?php if(isset($updated)): ?>
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <h5><?= $updated ?></h5>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            <?php endif; ?>
                                            <?php if(isset($deleted)): ?>
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <h5><?= $deleted ?></h5>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            <?php endif; ?>
                                            <?php if(isset($reseted)): ?>
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <h5><?= $reseted ?></h5>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end -->
        <!-- start models -->
        

        <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add date</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <form action="timeslots.php" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-6 my-2"><label for="name">Time slots</label><input name="time" type="time" class="form-control validate" required /></div>
                                    <button type="submit" name="add" class="btn btn-primary btn-block my-3">Add date</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="timeslots.php" class="tm-edit-product-form" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Delete Product?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h6>Do you want to Reset slots</h6>
                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="reset" class="btn btn-primary">Reset changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- end models -->

        <!-- Start footer -->
        <?php include('includes/footer.html') ?>
        <!-- end footer -->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>