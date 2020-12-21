<?php
require_once('connection.php');
session_start();
if (isset($_POST['add'])) {
    $name = $_POST['name']; 
    $description = $_POST['description']; 
    $hours_available = $_POST['hours']; 
    $price = $_POST['price']; 
    $requestedImage = time() . '-' . $_FILES["addimg"]["name"];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($requestedImage);
    move_uploaded_file($_FILES["addimg"]["tmp_name"], $target_file);     
// SELECT requested_playfield.requested_id, requested_playfield.owner_id, requested_playfield.name , requested_playfield.image, requested_playfield.description , requested_playfield.price ,requested_playfield.hours_available FROM requested_playfield INNER JOIN reservation on reservation.reservation_id = requested_playfield.owner_id INNER JOIN owner on requested_playfield.owner_id = owner.owner_id where requested_playfield.owner_id = '1'
    $ins= "INSERT INTO requested_playfield (owner_id,name,description,hours_available,image,price) VALUES(".$_SESSION['owner_id'].",'$name','$description','$hours_available','$requestedImage','$price')"; 
    
    if(!mysqli_query($conn,$ins)){ 
        die('Error:'. mysqli_error($conn));
    } else {
        $added ="Your Requested playfield sent successfully";

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
        <link rel="stylesheet" href="css/style.css">
        <title>Playfields</title>
    </head>
    <body>

        <!--start navbar-->
        <?php include('includes/navbar.php'); ?>
        <!--end navbar-->

        <!-- start home-details -->
        <section class="playfields-details mt-7">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row no-gutters">
                            <div class="col-12">
                                <button class="btn btn-main mb-3" data-toggle="modal" data-target="#add">Add request</button>
                            </div>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Hours available</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once('connection.php');
                                            $requested_playfields = "SELECT requested_playfield.requested_id, requested_playfield.owner_id, requested_playfield.name , requested_playfield.image, requested_playfield.description , requested_playfield.price ,requested_playfield.hours_available FROM requested_playfield INNER JOIN reservation on reservation.reservation_id = requested_playfield.owner_id INNER JOIN owner on requested_playfield.owner_id = owner.owner_id where requested_playfield.owner_id = ".$_SESSION["owner_id"]." ";
                                            $query = mysqli_query($conn,$requested_playfields) or die("Error:".mysqli_error($conn)) ;
                                            $result= mysqli_fetch_array($query);
                                            do{
                                            ?>
                                                <tr>
                                                    <th scope="row"><?php echo $result ['requested_id']; ?></th>
                                                    <td><?php echo $result ['name']; ?></td>
                                                    <td><?php echo $result ['hours_available']; ?></td>
                                                    <td><?php echo substr($result['description'],0,50).'...' ?></td>
                                                    <td><img src="../images/<?php echo $result ['image']; ?>" height="100px" width="100px" alt=""></td>
                                                    <td><?php echo $result ['price']; ?></td>
                                                </tr>
                                                
                                            <?php
                                            }
                                            while($result=mysqli_fetch_array($query));
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php if(isset($added)): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <h5><?= $added ?></h5>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php endif; ?>
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
                        <h5 class="modal-title" id="exampleModalCenterTitle">Add Playfield</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="container-fluid">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-6 my-2"><label for="name">Playfield Name</label><input name="name" type="text" class="form-control validate" required /></div>
                                <div class="col-6 my-2"><label for="name">Playfield Hours</label><input name="hours" type="number" class="form-control validate" required /></div>
                                <div class="col-6 my-2"><label for="name">Playfield Price</label><input name="price" type="number" class="form-control validate" required /></div>
                                <div class="col-6 my-2"><label for="name">Playfield Image</label><input name="addimg" type="file" class="form-control validate" required /></div>
                                <div class="col-12 my-2"><label for="name">Playfield Description</label><textarea name="description" type="text" class="form-control validate" required /></textarea></div>
                                <button type="submit" name="add" class="btn btn-primary btn-block my-3">Add Playfield</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>    
        <!-- end models -->

        <!--start footer-->
        <?php include('includes/footer.html'); ?>
        <!--end footer-->
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>