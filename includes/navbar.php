
        <nav class="navbar navbar-expand-lg navbar-dark bg-main fixed-top">
            <div class="container">
                <a class="navbar-brand" href="index.php">Player Zone</a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="playfields.php">Playfields</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost/Player-zone/owner">Is you owner?</a>
                        </li>
                        <?php
                        if (!isset($_SESSION['username'])) {
                            echo "<li class='nav-item'>
                            <a class='nav-link text-white' href='login.php'>login</a>
                            </li>";
                        }
                        else{
                            echo  "<li class='nav-item dropdown'>
                                <a class='nav-link text-white dropdown-toggle' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                    Welcome, ".$_SESSION['full_name']."
                                </a>
                                <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                    <a class='dropdown-item' href='profile.php'>Profile</a>
                                    <a class='dropdown-item' href='logout.php'>Logout</a>
                                </div>
                            </li>";
                        }
                    ?>
                    </ul>
                </div>
            </div>
        </nav>
