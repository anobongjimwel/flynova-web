<?php require_once "assets/php/requires/superHeader.php" ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>FlyNova - Home</title>
        <?php include_once "assets/php/includes/header.php"?>
        <style>
            .tooltip {
                z-index: 999999999;
            }
        </style>
    </head>
    <body class="bg-dark">
        <?php include_once "assets/php/includes/nav.php" ?>
        <div class="container-fluid" style="background: url('assets/img/home_bg/airportParking.png') top left; background-size: cover">
            <div class="container">
                <div class="row align-content-center" style="height: 100vh">
                    <div class="col-md-5 col-12 pb-2 pt-5">
                        <!--
                        <img src="assets/img/home_bg/animatedAirport.gif" style="width: 100%"/>
                        -->
                    </div>
                    <div class="col-md-7">
                        <h1 class="d-none d-md-inline-block">FlyNova</h1>
                        <h4 class="d-inline-block d-md-none">FlyNova</h4><br />
                        <h2 class="bg-primary text-white p-2 d-none d-lg-inline-block"><span id="typingIntro" ></span></h2>
                        <h6 class="bg-primary text-white p-2 d-inline-block d-lg-none"><span id="typingIntro2"></span></h6>
                        <br />
                        <h6 class="d-inline-block d-md-none text-white bg-dark p-2">With the struggle of our fellow tourism students in memorizing and familiarizing airport codes, airline codes<sup>*</sup>, country codes<sup>*</sup>, and city codes<sup>*</sup>, our fellow IT students, <a href="#">Jimwel Anobong</a>, <a href="#">Bryan Orven Manzano</a>, and <a href="#">Jessica Echon</a> has developed FlyNova to provide ease and with a newer experience towards memorizing 'em.</h6>
                        <h4 class="d-none d-md-inline-block d-lg-none text-white bg-dark p-2">With the struggle of our fellow tourism students in memorizing and familiarizing airport codes, airline codes<sup>*</sup>, country codes<sup>*</sup>, and city codes<sup>*</sup>, our fellow IT students, <a href="#">Jimwel Anobong</a>, <a href="#">Bryan Orven Manzano</a>, and <a href="#">Jessica Echon</a> has developed FlyNova to provide ease and with a newer experience towards memorizing 'em.</h4>
                        <h4 class="d-none d-lg-inline-block">With the struggle of our fellow tourism students in memorizing and familiarizing airport codes, airline codes<sup>*</sup>, country codes<sup>*</sup>, and city codes<sup>*</sup>, our fellow IT students, <a href="#">Jimwel Anobong</a>, <a href="#">Bryan Orven Manzano</a>, and <a href="#">Jessica Echon</a> has developed FlyNova to provide ease and with a newer experience towards memorizing 'em.</h4>
                        <?php if (!(isset($_SESSION['username']) && !empty($_SESSION['username']))) { ?>
                        <br />
                        <button class="btn btn-primary text-white" style="color: black" data-toggle="collapse" data-target="#rightLogin"><span class="ion ion-ios-airplane"></span> Experience FlyNova</button>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>
        <div class="container-fluid" style="background-image: url('assets/img/home_bg/feature-bg.jpg'); background-size: contain">
            <div class="container">
                    <div class="row align-content-center pt-5 pb-5">
                        <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12 text-center pb-4">
                            <h2><span class="text-white bg-danger">&nbsp;Features&nbsp;</span></h2>
                            <p class="text-white">FlyNova is a Flight Booking Web-based Simulation app that comes with features that you as a learning individual, either a tourism student or not, might find very useful in using it. These are just some of it.</p>
                        </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <h4><span class="text-white"><span class="ion ion-ios-bulb"></span>&nbsp;Memorize with Ease</span></h4>
                        <p class="text-white">FlyNova made it interactive in a sense, you are to use the airport codes and not just memorize them. With that, familiarizing has neven been this easy.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <h4><span class="text-white"><span class="ion ion-ios-swap"></span>&nbsp;Also Non-Airport Codes</span></h4>
                        <p class="text-white">Airport codes included here is based on a database where in it includes naval / aerial fleets. We just thought you need that too.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <h4><span class="text-white"><span class="ion ion-ios-map"></span>&nbsp;
    Situation Based</span></h4>
                        <p class="text-white">Simulate as if you are to book a client / customer or someone with designated source and destination airports.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <h4><span class="text-white"><span class="ion ion-ios-eye"></span>&nbsp;
    Track Learning</span></h4>
                        <p class="text-white">Track learning by means of XP and also achievements. With these you are more motivated to achieve something while memorizing those codes.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <h4><span class="text-white"><span class="ion ion-ios-book"></span>&nbsp;Riskless Booking</span></h4>
                        <p class="text-white">Scared of practicing booking from other sites? Why? Due to money involvement or any other aspects? Learn here without risk, just reminders so that soon you are not to repeat such booking errors.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12">
                        <h4><span class="text-white"><span class="ion ion-ios-trophy"></span>&nbsp;Compete to be Quick</span></h4>
                        <p class="text-white">Compete through out your region in order to find out how competitive are you in memorizing and also how good are you in booking flights properly.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-worldwide" id="continentContainer">
            <div class="container">
                <div class="row align-content-center pt-5 pb-5">
                    <div class="col-12 pb-3 pt-2 pl-lg-0">
                        <h2 class="d-none d-lg-inline-block"><span class="bg-secondary p-1 text-white">SIMULATION FROM DIFFERENT CORNERS OF THE WORLD</span></h2>
                        <h2 class="d-inline-block d-lg-none bg-secondary p-1"><span class="text-white">SIMULATION FROM DIFFERENT CORNERS OF THE WORLD</span></h2>
                        <h6 class="bg-dark p-1"><span class="text-white">FlyNova caters different partnered airport codes in order to simulate flight booking from all corners of the world, including Antartica, when you get to book one based on the situations we provide.</span></h6>
                    </div>
                    <div class="col-12 col-lg-6 p-lg-0">
                        <div class="card h-100 w-100 text-white continent-cards" onmouseover="changeBgContinent('bg-asia')">
                            <div class="card-body">
                                <h5 class="card-title">Asia</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Earth's largest and most populous</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 pr-lg-0 pt-md-3 pt-lg-0">
                        <div class="row">
                            <div class="col-md-6 pt-3 pt-md-0">
                                <div class="card h-100 w-100 text-white continent-cards" onmouseover="changeBgContinent('bg-europe')">
                                    <div class="card-body">
                                        <h5 class="card-title">Europe</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pl-lg-0 pt-3 pt-md-0">
                                <div class="card h-100 w-100 text-white continent-cards" onmouseover="changeBgContinent('bg-northAmerica')">
                                    <div class="card-body border-white text-white">
                                        <h5 class="card-title">North America</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pt-lg-3 m-lg-0 pt-3 pt-md-3">
                                <div class="card h-100 w-100 text-white continent-cards" onmouseover="changeBgContinent('bg-southAmerica')">
                                    <div class="card-body border-white text-white">
                                        <h5 class="card-title">South America</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 pl-lg-0 pt-lg-3 m-lg-0 pt-3 pt-md-3">
                                <div class="card h-100 w-100 text-white continent-cards" onmouseover="changeBgContinent('bg-africa')">
                                    <div class="card-body text-white">
                                        <h5 class="card-title">Africa</h5>
                                        <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pt-lg-3 m-lg-0 pr-lg-0 pl-lg-0 pt-3 pt-md-3">
                        <div class="card h-100 w-100 text-white continent-cards" onmouseover="changeBgContinent('bg-oceania')">
                            <div class="card-body border-white text-white">
                                <h5 class="card-title">Oceania</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pt-lg-3 m-lg-0 pr-lg-0 pt-3 pt-md-3">
                        <div class="card h-100 w-100 text-white continent-cards" onmouseover="changeBgContinent('bg-antarctica')">
                            <div class="card-body border-white text-white">
                                <h5 class="card-title">Antarctica</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" style="background: url('assets/img/home_bg/airportBoardingShed.png') center; background-size: cover">
            <div class="container">
                <div class="row align-content-center pt-5 pb-5">
                    <div class="col-12 pb-5">
                        <h2 class="d-sm-inline-block d-none"><span class="text-white bg-danger">&nbsp;Airport Codes categorized&nbsp;</span></h2>
                        <h4 class="d-inline-block d-sm-none"><span class="text-white bg-danger">&nbsp;Airport Codes categorized&nbsp;</span></h4><br />
                        <h5 class="d-sm-inline-block d-none"><span class="text-white bg-secondary">&nbsp;Divided into three categories based on difficulty&nbsp;&nbsp;</span></h5>
                        <h6 class="d-inline-block d-sm-none text-white bg-secondary p-1"><span>Divided into three categories based on difficulty</span></h6>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="color: #9900cc">Easy</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Country Based</h6>
                                <p class="card-text">It caters local-based flights, provides 20xp points, less airport codes to memorize (except massively big countries with many airports of course), 2 - 613 airport codes globally and 2040 airport codes in US.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="color: #e332d1">Medium</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Continent Based</h6>
                                <p class="card-text">It caters continent-based flights, provides 50xp points, amount of airport codes per continent varies, 893 minimum airport codes (South America), 2920 maximum airport codes (North America).</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" style="color: #ed2f59">Hard</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Worldwide</h6>
                                <p class="card-text">It caters cross-continent flights, 100xp points, massive amounts of airport codes, 8995 airport codes to be exact, and lastly, a chance to go to only airport in Antartica. This category though is pretty hard.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if (!(isset($_SESSION['username']) && !empty($_SESSION['username']))) { ?>
        <div class="container-fluid" style="background-image: url('assets/img/home_bg/ready.jpg'); background-size: cover">
            <div class="container">
                <div class="row align-content-center pt-5 pb-5">
                    <div class="col-md-12 text-center pb-3 text-white">
                        <h2>Ready to be in the FlyNova Community?</h2>
                    </div>
                    <div class="col-md-6 text-white pb-5 pb-md-0">
                        <h4>Are you an individual?</h4>
                        <p>It is simple to register in the FlyNova Community. Just click at the button below so that it will bring you to the registration page. Once you already registered, you're good for playing. Good thing, being the community is all free so play and memorize all you want!</p>
                        <button class="btn btn-md btn-secondary d-block d-md-none"><span class="ion ion-ios-log-in"></span> Register Now</button>
                    </div>
                    <div class="col-md-6 text-white">
                        <h4>Are you a school or an organization?</h4>
                        <p>Proceed to the contact us page and let's have a talk. We are willing to have the system be used in your campus and outside by your students for them to learn more about airport codes, all for free.</p>
                        <button class="btn btn-md btn-secondary d-block d-md-none"><span class="ion ion-ios-call"></span> Contact Us</button>
                    </div>
                    <div class="col-md-6 text-white d-none d-md-block">
                        <button class="btn btn-md btn-secondary"><span class="ion ion-ios-log-in"></span> Register Now</button>
                    </div>
                    <div class="col-md-6 text-white d-none d-md-block">
                        <button class="btn btn-md btn-secondary"><span class="ion ion-ios-call"></span> Contact Us</button>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <div class="container-fluid bg-secondary">
            <div class="container">
                <div class="row align-content-center pt-5 pb-2">
                    <div class="col-12 pb-4 text-center pb-3">
                        <span style="color: rgb(179,179,179); font-size: 1.5em">Carriers Catered</span>
                    </div>
                    <div class="col-md-4 col-12 pb-3 pb-md-0">
                        <div class="card">
                            <img src="assets/img/home/airbus-330-300.jpg" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title" style="color: #9900cc">Airbus 330-300</h5>
                                <h6 class="card-subtitle mb-2 text-muted">298 seats<br />Business Class and Economy Class</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12 pb-3 pb-md-0">
                        <div class="card">
                            <img src="assets/img/home/airbus-320.jpg" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title" style="color: #e332d1">Airbus 320</h5>
                                <h6 class="card-subtitle mb-2 text-muted">168 seats<br />First Class and Economy Class</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-12">
                        <div class="card">
                            <img src="assets/img/home/boeing%20737-800.jpg" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title" style="color: #ed2f59">Boeing 737-800</h5>
                                <h6 class="card-subtitle mb-2 text-muted">192 seats<br />Economy Class</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-secondary">
            <div class="container">
                <div class="row align-content-center pt-5 pb-2">
                    <div class="col-md-12 text-center pb-3">
                        <span style="color: rgb(179,179,179); font-size: 1.5em">Simulated Credit Cards</span>
                    </div>
                    <div class="col-md-12 text-center">
                        <img src="assets/img/home/visa.png" style="height: 40px;" class="pl-md-1 pr-md-1 pt-md-0 pb-md-0 pt-2 pb-2"/>
                        <img src="assets/img/home/discover.png" style="height: 50px;" class="pl-md-1 pr-md-1 pt-md-0 pb-md-0 pt-2 pb-2"/><br class="d-block d-md-none">
                        <img src="assets/img/home/amex.png" style="height: 50px;" class="pl-md-1 pr-md-1 pt-md-0 pb-md-0 pt-2 pb-2"/>
                        <img src="assets/img/home/mastercard.png" style="height: 50px;" class="pl-md-1 pr-md-1 pt-md-0 pb-md-0 pt-2 pb-2"/><br class="d-block d-md-none">
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-secondary">
            <div class="container">
                <div class="row align-content-center pt-5 pb-2">
                    <span style="font-size: 0.7em; text-align: justify" class="text-white">1. The VISA logo is owned by Visa Inc., an american multination financial services. Credit card numbers generated here are just random set of numbers and do not correspond with any currently existing card numbers. If there may come a match, it's just completely coincidental.</span>
                    <span style="font-size: 0.7em; text-align: justify" class="text-white">2. The Discover logo is owned by Discover Financial Services, an american multination financial services. Credit card numbers generated here are just random set of numbers and do not correspond with any currently existing card numbers. If there may come a match, it's just completely coincidental.</span>
                    <span style="font-size: 0.7em; text-align: justify" class="text-white">3. The Mastercard logo is owned by Mastercard Incorporated, an american multination financial services. Credit card numbers generated here are just random set of numbers and do not correspond with any currently existing card numbers. If there may come a match, it's just completely coincidental.</span>
                    <span style="font-size: 0.7em; text-align: justify" class="text-white">4. The American Express logo is owned by American Express Company., an american multination financial services. Credit card numbers generated here are just random set of numbers and do not correspond with any currently existing card numbers. If there may come a match, it's just completely coincidental.</span>
                    <span style="font-size: 0.7em; text-align: justify" class="text-white">5. The picture assigned for the Airbus 330-300 is actually owned by Virgin Atlantic. We are in now way partnered with them or what, however, this will be replaced soon.</span>
                    <span style="font-size: 0.7em; text-align: justify" class="text-white">6. The picture assigned for the Airbus 320 is actually owned by AirAsia. We are in now way partnered with them or what, however, this will be replaced soon.</span>
                    <span style="font-size: 0.7em; text-align: justify" class="text-white">7. The picture assigned for the Boeing 737-800 is actually owned by Luxair. We are in now way partnered with them or what, however, this will be replaced soon.</span>
                    <span style="font-size: 0.7em; text-align: justify" class="text-white">8. FlyNova isn't a flight booking site but a flight booking simulation site. It helps those who are in need of assistance in memorizing airport codes at the same who is learning to book a flight properly. Even the title used to introduced this web-based system is particularly focused on tourism students of different schools, everyone can use the system. Whether they are flight attendants, students from other courses, or you just want to learn flight booking the riskless way. Please do remember that schedules generated here are not connected with any local or international flights, they are just data in order to make the experience somehow alike to what is like in real booking. In addition, the credit card information generated by the system are in no way valid, if 16 digit, expiry date or CVV have some similarities with what was generated by our system, that is purely unintentional and unexpected.</span>
                </div>
            </div>
        </div>
        <?php include_once "assets/php/includes/footer.php" ?>
        <script>
            setNavbarPosition("sticky-top")

            // Animated Texts
            let typingIntroOptions = {
                strings: ['Learn <b>Airport Codes</b> like never before.', 'Learn <b>Flight Booking</b> with 100% verity.', 'Innovate <b>IATA codes</b> while enjoying.', 'Assess <b>learning</b> through scored booking.', 'Serving <b>8992 Airports</b> with ease.', 'Serving <b>5523826 situational flights</b>.'],
                typeSpeed: 10,
                backSpeed: 20,
                backDelay: 2000,
                smartBackspace: true,
                loop: true
            };

            let typedIntro = new Typed('#typingIntro', typingIntroOptions);
            let typedIntro2 = new Typed('#typingIntro2', typingIntroOptions);
            typedIntro.start();
            typedIntro2.start();

            // Continent Changing

            function changeBgContinent(continentName) {
                let continentContainer = document.getElementById("continentContainer");
                continentContainer.classList.remove(continentContainer.classList[1]);
                continentContainer.classList.add(continentName);
            }
        </script>
    </body>
</html>