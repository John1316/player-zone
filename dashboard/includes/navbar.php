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
        <title>Title</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-main fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="dashboard.php">Dashboard</a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="timeslots.php">Time Slots</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="playfields.php">Playfields</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reservations.php">Reservations</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="users.php">Users</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="requestedplayfield.php">Requested</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="reviews.php">Reviews</a>
                        </li>
                        <?php
                        if (!isset($_SESSION['uname'])) {
                            echo "<li class='nav-item'>
                            <a class='nav-link text-white' href='index.php'>login</a>
                            </li>";
                        }
                        else{
                            echo  "<li class='nav-item dropdown'>
                                <a class='nav-link text-white dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Welcome, ".$_SESSION['uname']."
                                </a>
                                <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                    <a class='dropdown-item' href='logout.php'>Logout</a>
                                </div>
                            </li>";
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/popper.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>