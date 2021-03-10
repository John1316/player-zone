
        <nav class="navbar navbar-expand-lg navbar-dark bg-main fixed-top">
            <div class="container">
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

                        
                            <li class='nav-item dropdown'>
                                <a class='nav-link text-white' href='logout.php'>
                                    Welcome, <?php echo $_SESSION['username'] ?>
                                </a>
                            </li>
                    </ul>
                </div>
            </div>
        </nav>
