<?php require_once "assets/php/requires/superHeader.php" ?>
<?php
$profile = ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once "assets/php/includes/header.php"?>
        <title>FlyNova - About Us</title>
        <link rel="stylesheet" href="assets/css/bookingPages.css" />
    </head>
    <body class="bg-dark">
        <?php include_once "assets/php/includes/nav.php" ?>
        <div class="container-fluid" id="bookingContainer">
            <div class="row" style="background-color: rgba(255,255,255,0.85)">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pb-3 pt-3" style="max-width: 50%; overflow-y: hidden"><h2>About Us</h2></div>
                    </div>
                </div>
            </div>
            <div class="row" style="min-height: 100vh">
                <div class="col-12">
                    <div class="container pt-5 pb-5">
                        <div class="row">
                            <div class="col-4">
                                <div class="card w-100">
                                    <img src="assets/img/about_us/jimwel.jpg" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title">Jimwel Anobong</h5>
                                        <h6 class="card-subtitle">Programmer</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card w-100">
                                    <img src="assets/img/about_us/orven.jpg" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title">Orven Manzano</h5>
                                        <h6 class="card-subtitle">Project Manager</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card w-100">
                                    <img src="assets/img/about_us/chesca.jpg" class="card-img-top">
                                    <div class="card-body">
                                        <h5 class="card-title">Jessica Echon</h5>
                                        <h6 class="card-subtitle">Quality Assurance</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once "assets/php/includes/footer.php" ?>
        <script>
            setNavbarPosition("sticky-top");
        </script>
    </body>
</html>