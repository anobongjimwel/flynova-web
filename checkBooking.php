<?php require_once "assets/php/requires/superHeader.php" ?>
<?php if (!(isset($_SESSION['username']) && !empty($_SESSION['username']))) {
    header("Location: index.php");
} ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once "assets/php/includes/header.php"?>
        <title>FlyNova Booking Session - Checking Booking</title>
        <link rel="stylesheet" href="assets/css/bookingPages.css" />
    </head>
    <body class="bg-dark">
        <?php include_once "assets/php/includes/nav.php" ?>
        <div class="container-fluid" id="bookingContainer">
            <div class="row d-none d-md-block" style="background-color: rgba(255,255,255,0.85)">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pb-3 pt-3"><h2>Booking Check</h2></div>
                    </div>
                </div>
            </div>
            <div class="container pb-5" style="min-height: 100vh;" >
                <div class="row pt-5 pb-3">
                    <div class="col-lg-6 col-12 d-none">
                        <div class="accordion w-100" id="accordionForBooking">
                            <div class="card">
                                <div class="card-header pb-0 pt-0 pl-2">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link w-100 h-100 text-left" type="button" data-toggle="collapse" data-target="#instructions" aria-expanded="true" aria-controls="collapseOne">
                                            <b>INSTRUCTIONS</b>
                                        </button>
                                    </h2>
                                </div>
                                <div id="instructions" class="collapse show" data-parent="#accordionForBooking">
                                    <div class="card-body pb-3 pt-2">
                                        <?php include_once "assets/php/includes/booking/bookingInstructions.php" ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header pb-0 pt-0 pl-2">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link w-100 h-100 text-left" type="button" data-toggle="collapse" data-target="#booking" aria-expanded="true" aria-controls="collapseOne">
                                            <b>BOOKING SUMMARY</b>
                                        </button>
                                    </h2>
                                </div>
                                <div id="booking" class="collapse" data-parent="#accordionForBooking">
                                    <div class="card-body pb-3 pt-2">
                                        <?php include_once "assets/php/includes/booking/bookingSimulation.php" ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header pb-0 pt-0 pl-2">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link w-100 h-100 text-left" type="button" data-toggle="collapse" data-target="#reciept" aria-expanded="true" aria-controls="collapseOne">
                                            <b>RECIEPT</b>
                                        </button>
                                    </h2>
                                </div>
                                <div id="reciept" class="collapse" data-parent="#accordionForBooking">
                                    <div class="card-body pb-3 pt-2">
                                        <div class="row">
                                            <div class="col-12">
                                                <span style="font-size: 2em">Passengers</span>
                                            </div>
                                            <div class="col-6">
                                                <span style="font-size: 1em">Adults:</span>
                                            </div>
                                            <div class="col-6">
                                                <span style="font-size: 1em; font-weight: 600">2</span>
                                            </div>
                                            <div class="col-6">
                                                <span style="font-size: 1em">Children:</span>
                                            </div>
                                            <div class="col-12">
                                                <hr />
                                            </div>
                                            <div class="col-12">
                                                <span style="font-size: 2em">Payment</span>
                                            </div>
                                            <div class="col-6">
                                                <span style="font-size: 1em">Card Type:</span>
                                            </div>
                                            <div class="col-6">
                                                <span style="font-size: 1em; font-weight: 600">Mastercard</span>
                                            </div>
                                            <div class="col-6">
                                                <span style="font-size: 1em">Card Number:</span>
                                            </div>
                                            <div class="col-6">
                                                <span style="font-size: 1em; font-weight: 600">XXXX-XXXX-XXXX-XXXX</span>
                                            </div>
                                            <div class="col-6">
                                                <span style="font-size: 1em">Expiry Date:</span>
                                            </div>
                                            <div class="col-6">
                                                <span style="font-size: 1em; font-weight: 600">11/24</span>
                                            </div>
                                            <div class="col-6">
                                                <span style="font-size: 1em">Security Code:</span>
                                            </div>
                                            <div class="col-6">
                                                <span style="font-size: 1em; font-weight: 600">160</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 offset-lg-3 col-12 pt-3 pt-lg-0">
                        <div id="rightWindow" class="pt-2 pb-3 pl-3 pr-3">
                            <form method="post" action="flightSimulationProcessor.php" enctype="application/x-www-form-urlencoded">
                            <div class="row">
                                <div class="col-12 pb-0 pt-0">
                                    <div class="row">
                                        <div class="col-2 col-lg-1 text-right">
                                            <img src="assets/img/avatars/female_1.png" style="height: 40px; position: relative; top: 2px; left: -7px;"/>
                                        </div>
                                        <div class="col-10 col-lg-11 m-0">
                                            <span class="d-block overflow-hidden" style="white-space: nowrap; font-size: 1em;"><?= ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['nickname'] ?></span>
                                            <span class="d-block" id="progressText" style="font-size: 0.75em">Level <?= LevelHandler::identifyLevelRange(LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']))['level'] ?>, <?= LevelHandler::identifyLevelRange(LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']))['name'] ?></span>
                                            <div class="progress mt-2 progress-bar-striped" >
                                                <div id="levelDisplay" class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?= number_format(LevelHandler::getCurrentBaseLevel($levelRange['min'], LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']), $levelRange['max'], LevelHandler::LEVEL_PERCENTAGE), 2) ?>%" aria-valuenow="<?= LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']); ?>" aria-valuemin="<?= $levelRange['min'] ?>" aria-valuemax="<?= $levelRange['max'] ?>">
                                                    <span class="text-white" id="xpDisplay" style="color: black; font-weight: 600;">
                                                        &nbsp;<?= LevelHandler::showShortenedXPCtr(LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']))?><sup>xp</sup>
                                                    </span>
                                                </div>
                                                <div id="levelProgressDisplay" class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 0" aria-valuenow="<?= $levelRange['min'] ?>" aria-valuemin="<?= $levelRange['min'] ?>" aria-valuemax="<?= $levelRange['max'] ?>">
                                                    <span class="text-white" id="xpProgressDisplay" style="color: black; font-weight: 600;">
                                                        <!--
                                                        &nbsp;<?= LevelHandler::showShortenedXPCtr(LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']))?><sup>xp</sup>
                                                        -->
                                                    </span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <hr />
                                </div>
                                <div class="col-12 text-center" id="xpGained">

                                </div>
                                <div class="col-12 pb-0 pt-0 checkingProcess">

                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once "assets/php/includes/footer.php" ?>
        <script>
            setNavbarPosition("sticky-top");

            let airportCodeXHR = new XMLHttpRequest();
            iziToast.show({
                target: ".checkingProcess",
                title: "Executing Airport Codes Check",
                message: "We are checking if the codes you have entered corresponds the given airports in the instructions.",
                layout: 2,
                timeout: 1000,
                imageWidth: 100,
                backgroundColor: "#ffffff",
                icon: "ion ion-ios-hourglass",
                close: false,
                closeOnEscape: false,
                closeOnClick: false,
                drag: false,
                pauseOnHover: false,
                onOpening: function () {

                    airportCodeXHR.onreadystatechange = function (ev) {
                        if (this.readyState == 4 && this.status == 200) {
                            if (this.responseText == "GOOD") {
                                iziToast.success({
                                    target: ".checkingProcess",
                                    title: "Airport Codes Check Successful",
                                    message: "Airport Codes does match with the instruction's airports.",
                                    layout: 2,
                                    timeout: false,
                                    icon: "ion ion-ios-checkmark-circle",
                                    close: false,
                                    backgroundColor: '#ff97ab',
                                    closeOnEscape: false,
                                    closeOnClick: false,
                                    drag: false,
                                    pauseOnHover: false,
                                    progressBar: false
                                });
                            } else {
                                iziToast.error({
                                    target: ".checkingProcess",
                                    title: "Airport Codes Check Failed",
                                    message: this.responseText,
                                    layout: 2,
                                    timeout: false,
                                    backgroundColor: '#a1a49f',
                                    icon: "ion ion-ios-close-circle",
                                    close: false,
                                    closeOnEscape: false,
                                    closeOnClick: false,
                                    drag: false,
                                    pauseOnHover: false,
                                    progressBar: false
                                });
                            }
                        }
                    };
                },
                onOpened: function (ev) {
                    airportCodeXHR.open("get", "fcns/ajax/bookingChecker/checkAirportCodes.php");
                },
                onClosing: function () {
                    airportCodeXHR.send();
                }
            });

            let routeCheckerXHR = new XMLHttpRequest();
            iziToast.show({
                target: ".checkingProcess",
                title: "Executing Route Simulation Check",
                message: "Here we are examining if we do cater the route made in your simulation.",
                layout: 2,
                timeout: 2000,
                imageWidth: 100,
                backgroundColor: "#ffffff",
                icon: "ion ion-ios-hourglass",
                close: false,
                closeOnEscape: false,
                closeOnClick: false,
                drag: false,
                pauseOnHover: false,
                onOpening: function () {

                    routeCheckerXHR.onreadystatechange = function (ev) {
                        if (this.readyState == 4 && this.status == 200) {
                            if (this.responseText == "GOOD") {
                                iziToast.success({
                                    target: ".checkingProcess",
                                    title: "Route Simulation Check Successful",
                                    message: "Route simulation is catered by our system.",
                                    layout: 2,
                                    timeout: false,
                                    icon: "ion ion-ios-checkmark-circle",
                                    close: false,
                                    backgroundColor: '#ff97ab',
                                    closeOnEscape: false,
                                    closeOnClick: false,
                                    drag: false,
                                    pauseOnHover: false,
                                    progressBar: false
                                });
                            } else {
                                iziToast.error({
                                    target: ".checkingProcess",
                                    title: "Route Simulation Check Failed",
                                    message: this.responseText,
                                    layout: 2,
                                    timeout: false,
                                    icon: "ion ion-ios-close-circle",
                                    backgroundColor: '#e3e7e1',
                                    close: false,
                                    closeOnEscape: false,
                                    closeOnClick: false,
                                    drag: false,
                                    pauseOnHover: false,
                                    progressBar: false
                                });
                            }
                        }
                    };
                },
                onOpened: function (ev) {
                    routeCheckerXHR.open("get", "fcns/ajax/bookingChecker/checkRouteIfAvailable.php");
                },
                onClosing: function () {
                    routeCheckerXHR.send();
                }
            });

            let routingCtrXHR = new XMLHttpRequest();
            iziToast.show({
                target: ".checkingProcess",
                title: "Executing Routing Counter Check",
                message: "Here we are examining if the number of flights made does match with the instructions (One-way / Round Trip).",
                layout: 2,
                timeout: 3000,
                imageWidth: 100,
                backgroundColor: "#ffffff",
                icon: "ion ion-ios-hourglass",
                close: false,
                closeOnEscape: false,
                closeOnClick: false,
                drag: false,
                pauseOnHover: false,
                onOpening: function () {

                    routingCtrXHR.onreadystatechange = function (ev) {
                        if (this.readyState == 4 && this.status == 200) {
                            if (this.responseText == "GOOD") {
                                iziToast.success({
                                    target: ".checkingProcess",
                                    title: "Route Counter Check Successful",
                                    message: "Route counters does match with the instructions.",
                                    layout: 2,
                                    timeout: false,
                                    icon: "ion ion-ios-checkmark-circle",
                                    close: false,
                                    backgroundColor: '#ff97ab',
                                    closeOnEscape: false,
                                    closeOnClick: false,
                                    drag: false,
                                    pauseOnHover: false,
                                    progressBar: false
                                });
                            } else {
                                iziToast.error({
                                    target: ".checkingProcess",
                                    title: "Route Counter Check Failed",
                                    message: this.responseText,
                                    layout: 2,
                                    timeout: false,
                                    icon: "ion ion-ios-close-circle",
                                    backgroundColor: '#e3e7e1',
                                    close: false,
                                    closeOnEscape: false,
                                    closeOnClick: false,
                                    drag: false,
                                    pauseOnHover: false,
                                    progressBar: false
                                });
                            }
                        }
                    };
                },
                onOpened: function (ev) {
                    routingCtrXHR.open("get", "fcns/ajax/bookingChecker/checkBookingCounter.php");
                },
                onClosing: function (ev) {
                    routingCtrXHR.send();
                }
            });

            let paymentChkrXHR = new XMLHttpRequest();
            iziToast.show({
                target: ".checkingProcess",
                title: "Executing Payment Details Check",
                message: "Here we are checking if you have provided the same payment details as stated in the instructions",
                layout: 2,
                timeout: 4000,
                imageWidth: 100,
                backgroundColor: "#ffffff",
                icon: "ion ion-ios-hourglass",
                close: false,
                closeOnEscape: false,
                closeOnClick: false,
                drag: false,
                pauseOnHover: false,
                onOpening: function () {

                    paymentChkrXHR.onreadystatechange = function (ev) {
                        if (this.readyState == 4 && this.status == 200) {
                            if (this.responseText == "GOOD") {
                                iziToast.success({
                                    target: ".checkingProcess",
                                    title: "Payment Details Check Successful",
                                    message: "Payment details does match with the instructions.",
                                    layout: 2,
                                    timeout: false,
                                    icon: "ion ion-ios-checkmark-circle",
                                    close: false,
                                    backgroundColor: '#ff97ab',
                                    closeOnEscape: false,
                                    closeOnClick: false,
                                    drag: false,
                                    pauseOnHover: false,
                                    progressBar: false
                                });
                            } else {
                                iziToast.error({
                                    target: ".checkingProcess",
                                    title: "Payment Details Check Failed",
                                    message: this.responseText,
                                    layout: 2,
                                    timeout: false,
                                    icon: "ion ion-ios-close-circle",
                                    backgroundColor: '#e3e7e1',
                                    close: false,
                                    closeOnEscape: false,
                                    closeOnClick: false,
                                    drag: false,
                                    pauseOnHover: false,
                                    progressBar: false
                                });
                            }
                        }
                    };
                },
                onOpened: function (ev) {
                    paymentChkrXHR.open("get", "fcns/ajax/bookingChecker/checkPaymentDetails.php");
                },
                onClosing: function (ev) {
                    paymentChkrXHR.send();
                }
            });

            let passengerChkrXHR = new XMLHttpRequest();
            iziToast.show({
                target: ".checkingProcess",
                title: "Executing Passenger Details Check",
                message: "Here we are checking if you have provided the right details of each of the passengers in the instructions.",
                layout: 2,
                timeout: 5000,
                imageWidth: 100,
                backgroundColor: "#ffffff",
                icon: "ion ion-ios-hourglass",
                close: false,
                closeOnEscape: false,
                closeOnClick: false,
                drag: false,
                pauseOnHover: false,
                onOpening: function () {

                    passengerChkrXHR.onreadystatechange = function (ev) {
                        if (this.readyState == 4 && this.status == 200) {
                            if (this.responseText == "GOOD") {
                                iziToast.success({
                                    target: ".checkingProcess",
                                    title: "Passenger Details Check Successful",
                                    message: "Passenger details does match with the instructions.",
                                    layout: 2,
                                    timeout: false,
                                    icon: "ion ion-ios-checkmark-circle",
                                    close: false,
                                    backgroundColor: '#ff97ab',
                                    closeOnEscape: false,
                                    closeOnClick: false,
                                    drag: false,
                                    pauseOnHover: false,
                                    progressBar: false
                                });
                            } else {
                                iziToast.error({
                                    target: ".checkingProcess",
                                    title: "Passenger Details Check Failed",
                                    message: this.responseText,
                                    layout: 2,
                                    timeout: false,
                                    icon: "ion ion-ios-close-circle",
                                    backgroundColor: '#e3e7e1',
                                    close: false,
                                    closeOnEscape: false,
                                    closeOnClick: false,
                                    drag: false,
                                    pauseOnHover: false,
                                    progressBar: false
                                });
                            }
                        }
                    };
                },
                onOpened: function (ev) {
                    passengerChkrXHR.open("get", "fcns/ajax/bookingChecker/checkPassengerDetails.php");
                },
                onClosing: function (ev) {
                    passengerChkrXHR.send();
                }
            });

            let seatDesignationChkr = new XMLHttpRequest();
            iziToast.show({
                target: ".checkingProcess",
                title: "Executing Passenger Details Check",
                message: "Here we are checking if the seats you have provided are under the said seating class.",
                layout: 2,
                timeout: 6000,
                imageWidth: 100,
                backgroundColor: "#ffffff",
                icon: "ion ion-ios-hourglass",
                close: false,
                closeOnEscape: false,
                closeOnClick: false,
                drag: false,
                pauseOnHover: false,
                onOpening: function () {

                    seatDesignationChkr.onreadystatechange = function (ev) {
                        if (this.readyState == 4 && this.status == 200) {
                            if (this.responseText == "GOOD") {
                                iziToast.success({
                                    target: ".checkingProcess",
                                    title: "Seat Designations Check Successful",
                                    message: "All seats does comply with their corresponding classes.",
                                    layout: 2,
                                    timeout: false,
                                    icon: "ion ion-ios-checkmark-circle",
                                    close: false,
                                    backgroundColor: '#ff97ab',
                                    closeOnEscape: false,
                                    closeOnClick: false,
                                    drag: false,
                                    pauseOnHover: false,
                                    progressBar: false
                                });
                            } else {
                                iziToast.error({
                                    target: ".checkingProcess",
                                    title: "Seat Designations Check Failed",
                                    message: this.responseText,
                                    layout: 2,
                                    timeout: false,
                                    icon: "ion ion-ios-close-circle",
                                    backgroundColor: '#e3e7e1',
                                    close: false,
                                    closeOnEscape: false,
                                    closeOnClick: false,
                                    drag: false,
                                    pauseOnHover: false,
                                    progressBar: false
                                });
                            }
                        }
                    };
                },
                onOpened: function (ev) {
                    seatDesignationChkr.open("get", "fcns/ajax/bookingChecker/checkSeatDesignations.php");
                },
                onClosing: function (ev) {
                    seatDesignationChkr.send();
                }
            });

            setTimeout(function() {
                let appendXP = new XMLHttpRequest();
                appendXP.onreadystatechange = function (ev) {
                    let levelDisplay = document.getElementById('levelDisplay');
                    let leveProgresslDisplay = document.getElementById('levelProgressDisplay');
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("xpGained").innerHTML = this.response + "<br /><a href='dashboard.php'><span style='font-size: 1.25em'><i class='ion ion-ios-arrow-back'></i> Back to Dashboard</span></a>";
                        document.getElementById("xpGained").classList.add("pb-5");
                        let innerProgressText = document.getElementById("innerProgressText");
                        let ctr = parseInt(innerProgressText.innerText);
                        innerProgressText.innerText = 0;

                        timedAugment = setInterval(function() {

                            if (innerProgressText.innerText < ctr) {
                                innerProgressText.innerText = parseInt(innerProgressText.innerText) + 1;
                            } else {
                                let updateLevelTextXHR = new XMLHttpRequest();
                                let updateLevelXPXHR = new XMLHttpRequest();
                                updateLevelTextXHR.onreadystatechange = function () {
                                    if (this.readyState == 4 && this.status == 200) {
                                        document.getElementById("progressText").innerHTML = this.response;
                                    }
                                };
                                updateLevelXPXHR.onreadystatechange = function () {
                                    if (this.readyState == 4 && this.status == 200) {
                                        if (parseInt(levelDisplay.getAttribute("aria-valuemin")) == 0 && parseInt(levelDisplay.getAttribute("aria-valuenow")) == 0) {
                                            document.getElementById("xpDisplay").innerHTML = "";
                                            document.getElementById("xpProgressDisplay").innerHTML = this.response;
                                        } else {
                                            document.getElementById("xpDisplay").innerHTML = this.response;
                                        }
                                    }
                                };
                                updateLevelTextXHR.open("get", "fcns/ajax/bookingChecker/getLatestLevelText.php");
                                updateLevelTextXHR.send();
                                updateLevelXPXHR.open("get", "fcns/ajax/bookingChecker/getLatestXPText.php");
                                updateLevelXPXHR.send();

                                let updateLevelXHR = new XMLHttpRequest();
                                updateLevelXHR.onreadystatechange = function () {
                                    if (this.readyState == 4 && this.status == 200) {
                                        const resp = this.responseText.split("|");
                                        if (leveProgresslDisplay.getAttribute("aria-valuemin")==resp[0] && leveProgresslDisplay.getAttribute("aria-valuemax")==resp[3]) {
                                            leveProgresslDisplay.setAttribute("aria-valuenow", innerProgressText.innerText);
                                            leveProgresslDisplay.style.width = ((parseInt(innerProgressText.innerText))/parseInt(levelDisplay.getAttribute("aria-valuemax"))*100)+"%";
                                        }
                                        else {
                                            levelDisplay.style.width = "100%";
                                            setTimeout(function () {
                                                levelDisplay.setAttribute("aria-valuenow", resp[1]);
                                                levelDisplay.setAttribute("aria-valuemin", resp[0]);
                                                levelDisplay.setAttribute("aria-valuemax", resp[3]);
                                                levelDisplay.style.width = "0%";
                                            }, 1000);
                                            setTimeout(function () {
                                                levelDisplay.style.width = resp[2]+"%";
                                            }, 2250);
                                        }

                                    }
                                };
                                updateLevelXHR.open("get", "fcns/ajax/bookingChecker/getLatestLevel.php");
                                updateLevelXHR.send();
                                clearInterval(timedAugment);
                            }
                        }, 10);

                    }
                };
                appendXP.open("get", "fcns/ajax/bookingChecker/appendUserXP.php");
                appendXP.send();
            }, 7000);


        </script>
    </body>
</html>