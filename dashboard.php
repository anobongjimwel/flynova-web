<?php require_once "assets/php/requires/superHeader.php" ?>
<?php if (!(isset($_SESSION['username']) && !empty($_SESSION['username']))) {
    header("Location: index.php");
}?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>FlyNova - Dashboard</title>
        <?php include_once "assets/php/includes/header.php"?>
        <style>
            .carousel-indicators span, .carousel-indicators span.active{
                font-size: 2em;
            }

            .carousel-indicators span {
                opacity: 0.5;
            }
        </style>
    </head>
    <body class="bg-dark">
        <?php include_once "assets/php/includes/nav.php" ?>
        <div class="container-fluid p-0">
            <!-- Mobile Display, Priority -->

            <div class="carousel slide d-block d-md-none" id="carouselForMobileAnimatedDashboard" data-ride="carousel">
                <ol class="carousel-indicators">
                    <span class="ion ion-ios-airplane text-white active p-1"  data-target="#carouselForLargeAnimatedDashboard" data-slide-to="0"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForMobileAnimatedDashboard" data-slide-to="1"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForMobileAnimatedDashboard" data-slide-to="2"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForMobileAnimatedDashboard" data-slide-to="3"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForMobileAnimatedDashboard" data-slide-to="4"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForMobileAnimatedDashboard" data-slide-to="5"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForMobileAnimatedDashboard" data-slide-to="6"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForMobileAnimatedDashboard" data-slide-to="7"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForMobileAnimatedDashboard" data-slide-to="8"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForMobileAnimatedDashboard" data-slide-to="9"></span>
                </ol>
                <div class="carousel-inner m-0">
                    <div class="carousel-item active">
                        <a href="#" onclick="easySelector()">
                            <img class="w-100" src="assets/img/dashboard/mobile-easy_scored.png"/>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="#" onclick="mediumSelector()">
                            <img class="w-100" src="assets/img/dashboard/mobile-medium_scored.png"/>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="#" onclick="location.href='flightLoading.php?category=hard'">
                            <img class="w-100" src="assets/img/dashboard/mobile-hard_scored.png"/>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="#" onclick="location.href='reviewer_asia.php'">
                            <img class="w-100" src="assets/img/dashboard/mobile-asia_reviewer.png"/>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="#" onclick="location.href='reviewer_northAmerica.php'">
                            <img class="w-100" src="assets/img/dashboard/mobile-north_america_reviewer.png"/>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="#" onclick="location.href='reviewer_southAmerica.php'">
                            <img class="w-100" src="assets/img/dashboard/mobile-south_america_reviewer.png"/>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="#" onclick="location.href='reviewer_africa.php'">
                            <img class="w-100" src="assets/img/dashboard/mobile-africa_reviewer.png"/>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="#" onclick="location.href='reviewer_oceania.php'">
                            <img class="w-100" src="assets/img/dashboard/mobile-oceania_reviewer.png"/>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="#" onclick="location.href='reviewer_europe.php'">
                            <img class="w-100" src="assets/img/dashboard/mobile-europe_reviewer.png"/>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <<a href="#" onclick="location.href='reviewer_antarctica.php'">
                            <img class="w-100" src="assets/img/dashboard/mobile-antarctica_reviewer.png"/>
                        </a>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselForMobileAnimatedDashboard" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselForMobileAnimatedDashboard" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>


            <!-- Bigger Display -->
            <div class="carousel slide d-none d-md-block" id="carouselForLargeAnimatedDashboard" data-ride="carousel">
                <ol class="carousel-indicators">
                    <span class="ion ion-ios-airplane text-white active p-1"  data-target="#carouselForLargeAnimatedDashboard" data-slide-to="0"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForLargeAnimatedDashboard" data-slide-to="1"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForLargeAnimatedDashboard" data-slide-to="2"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForLargeAnimatedDashboard" data-slide-to="3"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForLargeAnimatedDashboard" data-slide-to="4"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForLargeAnimatedDashboard" data-slide-to="5"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForLargeAnimatedDashboard" data-slide-to="6"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForLargeAnimatedDashboard" data-slide-to="7"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForLargeAnimatedDashboard" data-slide-to="8"></span>
                    <span class="ion ion-ios-airplane text-white p-1"  data-target="#carouselForLargeAnimatedDashboard" data-slide-to="9"></span>
                </ol>
                <div class="carousel-inner m-0">
                    <div class="carousel-item active">
                        <a href="#" onclick="easySelector()">
                            <video  class="d-block w-100" autoplay loop>
                                <source src="assets/videos/dashboard/easy_scored.mp4" type="video/mp4"/>
                            </video>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="#" onclick="mediumSelector()">
                            <video  class="d-block w-100" autoplay loop>
                                <source src="assets/videos/dashboard/medium_scored.mp4" type="video/mp4"/>
                            </video>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="#" onclick="location.href='flightLoading.php?category=hard'">
                            <img class="w-100" src="assets/img/dashboard/hard_scored.png"/>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="reviewer_asia.php">
                            <video class="d-block w-100" autoplay loop>
                                <source src="assets/videos/dashboard/asia_reviewer.mp4" type="video/mp4"/>
                            </video>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="#" onclick="location.href='reviewer_northAmerica.php'">
                            <img class="w-100" src="assets/img/dashboard/north_america_reviewer.png"/>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="#" onclick="location.href='reviewer_southAmerica.php'">
                            <img class="w-100" src="assets/img/dashboard/south_america_reviewer.png"/>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="#" onclick="location.href='reviewer_africa.php'">
                            <img class="w-100" src="assets/img/dashboard/africa_reviewer.png"/>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="#" onclick="location.href='reviewer_oceania.php'">
                            <img class="w-100" src="assets/img/dashboard/oceania_reviewer.png"/>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="#" onclick="location.href='reviewer_europe.php'">
                            <img class="w-100" src="assets/img/dashboard/europe_reviewer.png"/>
                        </a>
                    </div>
                    <div class="carousel-item">
                        <a href="reviewer_antarctica.php">
                            <video  class="d-block w-100" autoplay loop>
                                <source src="assets/videos/dashboard/antarctica_reviewer.mp4" type="video/mp4"/>
                            </video>
                        </a>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselForLargeAnimatedDashboard" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselForLargeAnimatedDashboard" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <!-- Special Datalist for Easy -->
        <datalist id="easyChoices">
            <?php foreach (BookingHandler::getAllCountries() as $country) {?>
                <option value="<?php echo $country['country']?>">
                    <?php echo $country["country"] ?>
                </option>
            <?php } ?>
        </datalist>
        <?php include_once "assets/php/includes/footer.php" ?>
        <script>
            setNavbarPosition("fixed-top");

            main_bgm_play();

            function mediumSelector() {
                iziToast.question({
                    close: true,
                    overlay: true,
                    title: 'Medium Difficulty',
                    message: 'Which continent?',
                    backgroundColor: '#ffb8f5',
                    timeout: false,
                    progressBar: false,
                    position: 'center',
                    drag: false,
                    inputs: [
                        ['<select><option value="North America">North America</option><option value="South America">South America</option><option value="Europe">Europe</option><option value="Africa">Africa</option><option value="Asia">Asia</option><option value="North America">Oceania</option></select>', 'change', function (instance, toast, select, e) {
                        }]
                    ],
                    buttons: [
                        ['<button><b>Confirm</b></button>', function (instance, toast, button, e, inputs) {

                            location.href = "flightLoading.php?category=medium&continent=" + inputs[0].value;
                            instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                        }, false]
                    ]
                });
            }

            function easySelector() {
                iziToast.question({
                    overlay: true,
                    drag: false,
                    close: true,
                    title: 'Easy Difficulty',
                    message: 'Which country?',
                    backgroundColor: '#ffb8f5',
                    timeout: false,
                    progressBar: false,
                    position: 'center',
                    inputs:
                        [
                            ['<input type=\'text\' list=\'easyChoices\' />', 'change', function (instance, toast, select, e) {
                            }]
                        ],
                    buttons: [
                        ['<button id=\'easyAccept\'><b>Confirm</b></button>', function (instance, toast, button, e, inputs) {
                            location.href = "flightLoading.php?category=easy&country=" + inputs[0].value;
                            instance.hide({transitionOut: 'fadeOut'}, toast, 'button');
                        }, false]
                    ]
                });
            }



            $('.carousel').carousel({
                interval: false,
                keyboard: true
            });
            document.getElementsByClassName('carousel')[0].focus();
        </script>
    </body>
</html>