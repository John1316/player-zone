<?php
require_once('connection.php'); 
session_start();
if (isset($_POST['submit'])) {
    $uname = $_POST['username'];
    $pass = $_POST['pass']; 

    $sql = "SELECT * FROM admins WHERE uname = '$uname' and pass = '$pass'";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        echo('check as something went wrong in the sql statement');
    } else {
        while ($row = mysqli_fetch_array($result))
        {
            $_SESSION['owner_id'] = $row['owner_id'];
        }
        
        $count = mysqli_num_rows($result);
        if (empty($email)) {
            $errlog ="please fill this field to login";
        }
        if (empty($pass)) {
            $errlog ="please fill this field to login";
        }
            if ($count == 1) {
                $_SESSION['uname'] = $uname;
                header("location: dashboard.php");
            } else {
                $logfailed = "Your email or password is uncorrect";
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
        <link rel="stylesheet" href="css/dashboard_style.css">
        <style>
                .card{
                    width: 35%;
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50% , -50%);
                }
                @media screen and (max-width:1025px){
                    .card{
                        width: 50%;
                    }
                }
                @media screen and (max-width:500px){
                    .card{
                        width: 75%;
                    }
                }
        </style>
        <title>Login</title>
    </head>
    <body class="login">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h1 class="text-main">Login</h1>
                                <form action="index.php" method="post">
                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" name="username" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Passowrd</label>
                                        <input type="password" name="pass" class="form-control">
                                    </div>
                                    <button name="submit" type="submit" class="btn btn-success">Log in</button>
                                </form>
                            </div>
                        </div>
                    </div>
                        
                </div>
                <?php if(isset($logfailed)): ?>
                <div class="alert alert-danger alert-dismissible fade show w-100 my-3" role="alert">
                    <h5><?= $logfailed ?></h5>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <?php endif; ?>

        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="js/index.js"></script>
    </body>
</html>