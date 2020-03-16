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
        <title>FlyNova - Frequently Asked Questions</title>
        <link rel="stylesheet" href="assets/css/bookingPages.css" />
    </head>
    <body class="bg-dark">
        <?php include_once "assets/php/includes/nav.php" ?>
        <div class="container-fluid" id="bookingContainer">
            <div class="row" style="background-color: rgba(255,255,255,0.85)">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pb-3 pt-3" style="max-width: 50%; overflow-y: hidden"><h2>FAQs</h2></div>
                    </div>
                </div>
            </div>
            <div class="row" style="min-height: 100vh">
                <div class="container pt-5 pb-5">
                </div>
            </div>
        </div>
        <?php include_once "assets/php/includes/footer.php" ?>
        <script>
            setNavbarPosition("sticky-top");
        </script>
    </body>
</html>