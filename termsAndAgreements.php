<?php require_once "assets/php/requires/superHeader.php" ?>
<?php
if (
    isset($_SESSION['username']) &&
    !empty($_SESSION['username'])
) {
    $profile = ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once "assets/php/includes/header.php"?>
        <title>FlyNova - Terms and Agreements</title>
        <link rel="stylesheet" href="assets/css/bookingPages.css" />
    </head>
    <body class="bg-dark">
        <?php include_once "assets/php/includes/nav.php" ?>
        <div class="container-fluid" id="bookingContainer">
            <div class="row" style="background-color: rgba(255,255,255,0.85)">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pb-3 pt-3" style="max-width: 50%; overflow-y: hidden"><h2>Terms<span class="d-none d-md-inline">&nbsp;and Agreements</span></h2></div>
                    </div>
                </div>
            </div>
            <div class="row text-white" style="min-height: 100vh">
                <div class="container pt-5 pb-5">
                    <span style="font-size: 2em">FlyNova Terms and Agreements</span>
                    <br /><br />
                    <span style="font-size: 1.25em">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome to FlyNova. Here are FlyNova, we are engaging ourselves to develop a system improves the memorizing and consuming experience of our fellow senior high school and tertiary students towards airport codes, airline codes, country codes and city codes.<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;In order to achieve </span>
                </div>
            </div>
        </div>
        <?php include_once "assets/php/includes/footer.php" ?>
        <script>
            setNavbarPosition("sticky-top");
        </script>
    </body>
</html>