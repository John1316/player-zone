<?php
require_once('connection.php');
session_start();
if (isset($_POST['add'])) {
    $name = $_POST['name']; 
    $description = $_POST['description']; 
    $hours = $_POST['hours']; 
    $price = $_POST['price']; 
    $playfieldImage = time() . '-' . $_FILES["addimg"]["name"];
    $target_dir = "../images/";
    $target_file = $target_dir . basename($playfieldImage);
    move_uploaded_file($_FILES["addimg"]["tmp_name"], $target_file);     

$ins= "INSERT INTO playfields (name,des,hours,image,price) VALUES('$name','$description','$hours','$playfieldImage','$price')"; 
    
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
if (isset($_POST['update'])) {
    $id = $_POST['pid'];
$updatename = $_POST['updatename']; 
$updatedescription = $_POST['updatedescription']; 
$updatehours = $_POST['updatehours']; 
$updateprice = $_POST['updateprice']; 
$updateImage = time() . '-' . $_FILES["updateimg"]["name"];
$target_dir = "../images/";
$target_file = $target_dir . basename($updateImage);
move_uploaded_file($_FILES["updateimg"]["tmp_name"], $target_file);     


$up= "UPDATE playfields SET name='$updatename' , des='$updatedescription', hours='$updatehours', image='$updateImage' ,price='$updateprice' WHERE id='$id'"; 

if(!mysqli_query($conn,$up)){ 
    die('Error:'. mysqli_error($conn));
} else {
    $updated ="Your Playfield updated successfully";
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
                                <div class="row mb-4 justify-content-between">
                                    <button data-toggle="modal" data-target="#add" class="btn btn-main">Add Playfield</button>
                                </div>
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
                                            $playfields = "SELECT * FROM playfields ORDER by id ASC";
                                            $query = mysqli_query($conn,$playfields) or die("Error:".mysqli_error($conn)) ;
                                            $result= mysqli_fetch_array($query);
                                            do{
                                            ?>
                                                <tr>
                                                    <th scope="row"><?php echo $result ['id']; ?></th>
                                                    <td><?php echo $result ['name']; ?></td>
                                                    <td><?php echo $result ['hours']; ?></td>
                                                    <td><?php echo substr($result['des'],0,50).'...' ?></td>
                                                    <td><img src="../images/<?php echo $result ['image']; ?>" height="100px" width="100px" alt=""></td>
                                                    <td><?php echo $result ['price']; ?></td>
                                                    <td><button data-toggle="modal" data-target="#update<?php echo $result ['id']; ?>" class="btn btn-info"><i class="fas fa-edit"></i></button>
                                                    <button data-toggle="modal" data-target="#delete<?php echo $result ['id']; ?>" class="btn btn-danger"><i class="fas fa-trash"></i></button></td>
                                                </tr>
                                                <div class="modal fade" id="update<?php echo $result ['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                <form action="playfields.php" method="post" enctype="multipart/form-data">
                                                                    <div class="row">
                                                                        <input name="pid" type="hidden" value="<?php echo $result ['id']; ?>" class="form-control validate">
                                                                        <div class="col-6 my-2"><label for="name">Playfield Name</label><input name="updatename" type="text" value="<?php echo $result ['name']; ?>" class="form-control validate" required /></div>
                                                                        <div class="col-6 my-2"><label for="name">Playfield Hours</label><input name="updatehours" type="number" value="<?php echo $result ['hours']; ?>" class="form-control validate" required /></div>
                                                                        <div class="col-6 my-2"><label for="name">Playfield Price</label><input name="updateprice" type="number" value="<?php echo $result ['price']; ?>" class="form-control validate" required /></div>
                                                                        <div class="col-6 my-2"><label for="name">Playfield Image</label><input name="updateimg" type="file" class="form-control validate" required /></div>
                                                                        <div class="col-12 my-2"><img src="../images/<?php echo $result ['image']; ?>" class="w-100" height="300px" alt=""></div>
                                                                        <div class="col-12 my-2"><label for="name">Playfield Description</label><textarea name="updatedescription" type="text" class="form-control validate" required><?php echo $result ['des']; ?></textarea></div>
                                                                        <button type="submit" name="update" class="btn btn-main btn-block my-3">Update Playfield</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>   

                                                <div class="modal fade" id="delete<?php echo $result ['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                <div class="col-6 my-2"><label for="name">Playfield Hours</label><input name="hours" type="number" class="form-control validate" required /></div>
                                <div class="col-6 my-2"><label for="name">Playfield Price</label><input name="price" type="number" class="form-control validate" required /></div>
                                <div class="col-6 my-2"><label for="name">Playfield Image</label><input name="addimg" type="file" class="form-control validate" required /></div>
                                <div class="col-12 my-2"><label for="name">Playfield Description</label><textarea name="description" type="text" class="form-control validate" required /></textarea></div>
                                <button type="submit" name="add" class="btn btn-main btn-block my-3">Add Playfield</button>
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