<?php require_once "assets/php/requires/superHeader.php" ?>
<?php if (!(isset($_SESSION['username']) && !empty($_SESSION['username']))) {
    header("Location: index.php");
} ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once "assets/php/includes/header.php"?>
    </head>
    <body class="bg-dark">
        <?php include_once "assets/php/includes/nav.php" ?>
        <div class="container-fluid" style="background-image: url('assets/img/home_bg/continents/worldwide.jpg'); background-position: center; background-size: cover; background-repeat: no-repeat">
            <div class="container">
                <div class="row align-content-center" style="height: 100vh;">
                    <div class="col-md-8 offset-md-2 col-12 pt-5">
                        <img src="assets/img/flightLoading/loading.gif" style="width: 100px; position: relative; left: -28px;"/><br />
                        <b><span style="font-size: 1.1em" class="d-inline-block bg-danger text-white p-2">
                                <span id="processName">
                                    Loading...
                                </span>
                        </span></b><br />
                        <span style="font-size: 0.75em" class="d-inline-block bg-secondary text-white p-2 mt-2" id="processDescription">
                            Please wait patiently, don't close or exit this page.
                        </span><br />
                    </div>
                </div>
            </div>
        </div>
        <?php include_once "assets/php/includes/footer.php" ?>
        <script>
            setNavbarPosition("sticky-top");
            main_bgm_play();

            <?php switch ($_GET['category']) {
            case "easy": ?>
            sound_announce_easy();
            <?php break; ?>
            <?php case "medium": ?>
            sound_announce_medium();
            <?php break; ?>
            <?php case "hard": ?>
            sound_announce_hard();
            <?php break; } ?>

            // Animated Loading

            let processNameOptions = {
                strings: ["","<span class='ion ion-ios-list'></span> Preparing Instructions...","<span class='ion ion-ios-list'></span>  Setting Flight Descriptions...", "<span class='ion ion-ios-people'></span> Identifying Passengers...","<span class='ion ion-ios-code-working'></span> Getting IATA Codes...","<span class='ion ion-ios-card'></span> Securing Credit Cards...","<span class='ion ion-ios-people'></span> Finalizing Booking Instructions...","<span class='ion ion-ios-airplane'></span> Loading Booking Simulation...","<span class='ion ion-ios-infinite'></span> Loading takes longer than usual..."],
                typeSpeed: 10,
                backSpeed: 10,
                backDelay: 5000,
                smartBackspace: true,
                loop: false
            };

            let processName = new Typed('#processName', processNameOptions);
            let processNameHandler = document.getElementById("processName");
            let processDescription = document.getElementById("processDescription");
            processName.start();

            // Flight Processing Loading
            const xmlHttp = new XMLHttpRequest();
            xmlHttp.onreadystatechange = function() {
                if (this.status==200 && this.readyState==4) {
                    if (this.responseText=="GOOD") {
                        location.href = "chooseRoute.php";
                    } else {
                        processName.stop();
                        processNameHandler.innerHTML = "<span class='ion ion-ios-bug'></span> Failed to load simulation";
                        processDescription.innerText = "Please try again! This page will go back to dashboard in 5 seconds";
                        setTimeout(function() {location.href="dashboard.php"}, 5000);                    }
                }
            };
            xmlHttp.open("POST","fcns/ajax/flight_maker.php", true);
            xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            <?php
            if (isset($_GET['category']) && !empty($_GET['category'])) {
                switch ($_GET['category']) {
                    case 'hard':
                        echo "setTimeout(function () {xmlHttp.send('category=hard')}, 10000);";
                        break;

                    case 'medium':
                        if (isset($_GET['continent']) && !empty($_GET['continent'])) {
                            echo "setTimeout(function () {xmlHttp.send('category=medium&continent=".$_GET['continent']."')}, 10000);";
                        } else {
                            echo "Location.href = 'dashboard.php'";
                        };
                        break;

                    case 'easy':
                        if (isset($_GET['country']) && !empty($_GET['country'])) {
                            echo "setTimeout(function () {xmlHttp.send('category=easy&country=".$_GET['country']."')}, 10000);";
                        } else {
                            echo "Location.href = 'dashboard.php'";
                        };
                        break;
                }

            } else {
                echo "location.href='dashboard.php'";
            }
            ?>
        </script>
    </body>
</html>