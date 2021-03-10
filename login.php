<?php
require_once('connection.php');
session_start();

if(isset($_POST['registsubmit']))
{
    $fname = $_POST['fullname'];
    $uname = $_POST['uname'];
    $phone = $_POST['phone'];
    $pass = sha1($_POST['password']);
    $un = "SELECT uname FROM users WHERE uname = '$uname'"; 
    $ph = "SELECT phone FROM users WHERE phone = '$phone'"; 
    $um_conn = mysqli_query($conn,$un)or die(mysqli_error($conn));   
    $ph_conn = mysqli_query($conn,$ph)or die(mysqli_error($conn)); 


    if (mysqli_num_rows($um_conn) >0){
        $um = "Your Username already existed";
    }
    elseif (mysqli_num_rows($ph_conn) >0){
        $phonerror = "Your phone already existed";
    }
    
    else 
    {
        $ins= "INSERT INTO users (full_name,uname,phone,pass) VALUES('$fname','$uname','$phone','$pass')";
        $success = "Your information posted successfully";
        if(!mysqli_query($conn,$ins)){ 
        die('Error:'. mysqli_error($conn));
        } 
        
    }
}
if (isset($_POST['loginsubmit'])) {
    $username = $_POST['username'];
    $loginpass = sha1($_POST['pass']);

    $sql = "SELECT * FROM users WHERE uname = '$username' and pass = '$loginpass' ";
    $result = mysqli_query($conn, $sql);
    
    if (!$result) {
        echo('check as something went wrong in the sql statement');
    } else {
        while ($row = mysqli_fetch_array($result))
        {
            $_SESSION['users_id'] = $row['users_id'];
            $_SESSION['full_name'] = $row['full_name'];
            $_SESSION['uname'] = $row['uname'];
            $_SESSION['phone'] = $row['phone'];
        }
        $count = mysqli_num_rows($result);
            if ($count == 1) {
                $_SESSION['username'] = $username;
                header("location: index.php");
            } else {
                $logfalied = "Your Username or Password is uncorrect";
            }
        
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
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"> 
        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Home</title>
    </head>
    <body class="login d-flex justify-content-center align-items-center">


        <section class="login-sec py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-12 border-right mb-4">
                                        <h1 class="text-main">Login</h1>
                                        <form action="" method="post">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" name="username" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Passowrd</label>
                                                <input type="password" name="pass" class="form-control" required>
                                            </div>
                                            <button name="loginsubmit" type="submit" class="btn btn-success">Log in</button>
                                        </form>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <h1 class="text-main">Register</h1>
                                        <form action="login.php" method="post">
                                            <div class="form-group">
                                                <label for="fullname">Full Name</label>
                                                <input type="text" name="fullname" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" name="uname" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="number" name="phone" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Passowrd</label>
                                                <input type="password" name="password" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="cpassword">Confirm Passowrd</label>
                                                <input type="password" name="cpassword" class="form-control" required>
                                            </div>
                                            <button name="registsubmit" class="btn btn-success">Register</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($logfalied)): ?>
                        <div class="alert alert-danger alert-dismissible fade show w-100 my-3" role="alert">
                            <h5><?= $logfalied ?></h5>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($success)): ?>
                        <div class="alert alert-success alert-dismissible fade show w-100 my-3" role="alert">
                            <h5><?= $success ?></h5>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($phonerror)): ?>
                        <div class="alert alert-danger alert-dismissible fade show w-100 my-3" role="alert">
                            <h5><?= $phonerror ?></h5>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($um)): ?>
                        <div class="alert alert-danger alert-dismissible fade show w-100 my-3" role="alert">
                            <h5><?= $um ?></h5>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif; ?>
                        <?php if(isset($passless)): ?>
                        <div class="alert alert-danger alert-dismissible fade show w-100 my-3" role="alert">
                            <h5><?= $passless ?></h5>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php endif; ?>
                        
                    </div>
                </div>
            </div>
        </section>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/index.js"></script>
    </body>
</html>