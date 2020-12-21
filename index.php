<?php
    require_once('connection.php');
    session_start();
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
<body>

    <!--start navbar-->
    <?php include('includes/navbar.php'); ?>
	<!--end navbar-->
    <header id="header" class="header justify-content-center text-center text-white d-flex align-items-center">
        <div class="header__caption container">
            <h1 class="text-uppercase mb-4 text-success">Lorem ipsum dolor sit amet consectetur.</h1>
            <h5 class="mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus soluta earum cumque accusamus dolorum autem atque aut rerum at placeat!</h5>
        </div>
    </header>

    <section class="our-service py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12 py-5">
                    <h1 class="text-main h1-3rem">Our service</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Error quidem eligendi officiis veniam iste quasi consequuntur? Deleniti molestiae sed labore, aperiam praesentium exercitationem iste rem temporibus a dolorem illum, aliquid odit adipisci minus, minima eveniet perferendis dicta iure laboriosam itaque!</p>
                </div>
                <div class="col-lg-6 col-12">
                    <img src="images/undraw_junior_soccer_6sop.svg" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </section>

    <section class="how-we-work py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="mb-4 text-main h1-3rem">How we work</h1>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-3 text-center">
                    <div class="card border-2">
                        <div class="card-body">
                            <i class="fas fa-2x my-3 text-main fa-hand-pointer"></i>
                            <h5 class="card-subtitle my-3">Select Playfield</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-3 text-center">
                    <div class="card border-2">
                        <div class="card-body">
                            <i class="fas fa-2x my-3 text-main fa-user"></i>
                            <h5 class="card-subtitle my-3">Create account</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-3 text-center">
                    <div class="card border-2">
                        <div class="card-body">
                            <i class="fas fa-2x my-3 text-main fa-user-clock"></i>
                            <h5 class="card-subtitle my-3">Choose your type</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-3 text-center">
                    <div class="card border-2">
                        <div class="card-body">
                            <i class="fas fa-2x my-3 text-main fa-clipboard-check"></i>
                            <h5 class="card-subtitle my-3">Checkout you hours</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="contactus py-5">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-lg-6 col-sm-12">
                    <ul class="list-unstyled">
                        <h1 class="text-main h1-3rem">Contact Us</h1>

                        <li class="my-3"><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem atque aut tenetur vel esse unde necessitatibus quasi accusamus sint aspernatur.</p></li>
                        <li class="my-3"><i class="fas fa-address-book mr-3"></i>Conatct Details:</li>
                        <li class="my-3 py-2"><i class="fa fa-location-arrow mr-3"></i>Lorem, ipsum dolor.</li>
                        <li class="my-3 py-2"><i class="fas fa-mobile-alt mr-3"></i>01149917963</li>
                        <li class="my-3 py-2"><i class="fas fa-at mr-2"></i>Kickoff@gmail.com</li>
                    </ul>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3078.82517068075!2d31.1524446739454!3d29.98333748655518!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x145845edbf2545fb%3A0x2d83fba2be0cf93c!2sNazlet%20Al%20Batran%2C%20Al%20Haram%2C%20Giza%20Governorate!5e0!3m2!1sen!2seg!4v1591623908775!5m2!1sen!2seg" width="550" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!--start navbar-->
    <?php include('includes/footer.html'); ?>
	<!--end navbar-->

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="js/index.js"></script>
</body>
</html>