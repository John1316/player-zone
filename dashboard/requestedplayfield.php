<?php
require_once('connection.php');
session_start();
if (isset($_POST['add'])) {
    $name = $_POST['name']; 
    $description = $_POST['description']; 
    $quantites = $_POST['quantity']; 
    $price = $_POST['price']; 
    $playfieldImage = time() . '-' . $_FILES["addimg"]["name"];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($playfieldImage);
    move_uploaded_file($_FILES["addimg"]["tmp_name"], $target_file);     

$ins= "INSERT INTO playfields (name,des,quantity,image,price) VALUES('$name','$description','$quantites','$playfieldImage','$price')"; 
    
if(!mysqli_query($conn,$ins)){ 
    die('Error:'. mysqli_error($conn));
} else {
    $added ="Your Playfield added successfully";

}

}
if (isset($_POST['delete'])) {
    $id = $_POST['did'];

$del= "DELETE FROM playfields WHERE id = '$id'"; 

if(!mysqli_query($conn,$del)){ 
    die('Error:'. mysqli_error($conn));
} else {
    $deleted ="Your playfield deleted successfully";
}

}
if (isset($_POST['accept'])) {
    $id = $_POST['acceptid'];
$acceptname = $_POST['acceptname']; 
$acceptdescription = $_POST['acceptdescription']; 
$accepthours = $_POST['accepthours']; 
$acceptprice = $_POST['acceptprice']; 
$acceptImage = time() . '-' . $_FILES["acceptimg"]["name"];
$target_dir = "../images/";
$target_file = $target_dir . basename($acceptImage);
move_uploaded_file($_FILES["acceptimg"]["tmp_name"], $target_file);     


$accept= "INSERT INTO playfields (name,des,hours,image,price) VALUES('$acceptname','$acceptdescription','$accepthours','$acceptImage','$acceptprice')"; 

if(!mysqli_query($conn,$accept)){ 
    die('Error:'. mysqli_error($conn));
} else {
    $accepted ="Your Playfield accepted successfully";
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
                                <div class="table-responsive">
                                    <table class="table table-striped min-height-table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Hours available</th>
                                                <th scope="col">Description</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            require_once('connection.php');
                                            $playfields = "SELECT * FROM  requested_playfield ORDER by requested_id ASC";
                                            $query = mysqli_query($conn,$playfields) or die("Error:".mysqli_error($conn)) ;
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
                                                    <td><button data-toggle="modal" data-target="#update<?php echo $result ['requested_id']; ?>" class="btn btn-info"><i class="fas fa-check"></i></button>
                                                    <button data-toggle="modal" data-target="#delete<?php echo $result ['requested_id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></button></td>
                                                </tr>
                                                <div class="modal fade" id="update<?php echo $result ['requested_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Edit Playfield</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <form action="" method="post" enctype="multipart/form-data">
                                                                    <div class="row">
                                                                        <div class="col-6 my-2"><label for="acceptname">Playfield Name</label><input name="acceptname" type="text" value="<?php echo $result ['name']; ?>" class="form-control validate" required /></div>
                                                                        <div class="col-6 my-2"><label for="accepthours">Playfield Hours</label><input name="accepthours" type="number" value="<?php echo $result ['hours_available']; ?>" class="form-control validate" required /></div>
                                                                        <div class="col-6 my-2"><label for="acceptprice">Playfield Price</label><input name="acceptprice" type="number" value="<?php echo $result ['price']; ?>" class="form-control validate" required /></div>
                                                                        <div class="col-6 my-2"><label for="acceptimg">Playfield Image</label><input name="acceptimg" type="file" class="form-control validate" required /></div>
                                                                        <div class="col-12 my-2"><label for="img">Playfield Image <img class="w-100" height="300px" src="../images/<?php echo $result ['image']; ?>" alt=""></div>
                                                                        <div class="col-12 my-2"><label for="acceptdescription">Playfield Description</label><textarea name="acceptdescription" row="5" col="3" type="text" class="form-control validate" required><?php echo $result ['description']; ?></textarea></div>
                                                                        <button type="submit" name="accept" class="btn btn-primary btn-block my-3">Accept Playfield</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>   

                                                <div class="modal fade" id="delete<?php echo $result ['requested_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalCenterTitle">Delete Playfield</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="container-fluid">
                                                                    <form action="playfields.php" method="post" enctype="multipart/form-data">
                                                                        <div class="row">
                                                                            <h6>Do you want to delete Playfield <input type="hidden" name="did" value="<?php echo $result ['id']; ?>"> <?php echo $result ['id']; ?> and his Name is <?php echo $result ['name']; ?></h6>
                                                                            <button type="submit" name="delete" class="btn btn-danger btn-block my-3">Delete Playfield</button>
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
                                <?php if(isset($accepted)): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <h5><?= $accepted ?></h5>
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
                        <form action="playfields.php" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-6 my-2"><label for="name">Playfield Name</label><input name="name" type="text" class="form-control validate" required /></div>
                                <div class="col-6 my-2"><label for="name">Playfield Hours</label><input name="quantity" type="number" class="form-control validate" required /></div>
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