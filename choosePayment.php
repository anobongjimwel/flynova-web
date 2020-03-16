<?php require_once "assets/php/requires/superHeader.php" ?>
<?php if (!(isset($_SESSION['username']) && !empty($_SESSION['username']))) {
    header("Location: index.php");
} ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once "assets/php/includes/header.php"?>
        <title>FlyNova Booking Session - Payment Details</title>
        <link rel="stylesheet" href="assets/css/bookingPages.css" />
    </head>
    <body class="bg-dark">
        <?php include_once "assets/php/includes/nav.php" ?>
        <div class="container-fluid" id="bookingContainer">
            <div class="row d-none d-md-block" style="background-color: rgba(255,255,255,0.85)">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pb-3 pt-3"><h2>Payment Details</h2></div>
                    </div>
                </div>
            </div>
            <div class="container pb-5" style="min-height: 100vh;" >
                <div class="row pt-5 pb-3">
                    <div class="col-lg-6 col-12">
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

                    <div class="col-lg-6 col-12 pt-3 pt-lg-0">
                        <div id="rightWindow" class="pt-2 pb-3 pl-3 pr-3">
                            <form method="post" action="flightSimulationProcessor.php" enctype="application/x-www-form-urlencoded">
                            <div class="row">
                                <div class="col-12 pb-0 pt-0">
                                    <span style="font-size: 1.5em">Payment Details</span>
                                    <hr />
                                </div>
                                <div class="col-12 pb-0 pt-0">
                                    <div class="row">
                                        <div class="col text-left"><label class="text-left">Card Number:</label></div>
                                    </div>
                                </div>
                                <div class="col-12 creditCardChecker">
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col text-left pr-1" style="padding-top: 10px;"><input class="form-control" name="card-1" id="card-1" maxlength="4" type="number"></div>
                                        <div class="col text-left pl-1 pr-1" style="padding-top: 10px;"><input class="form-control" name="card-2" id="card-2" maxlength="4" type="number"></div>
                                        <div class="col text-left pl-1 pr-1" style="padding-top: 10px;"><input class="form-control" name="card-3" id="card-3" maxlength="4" type="number"></div>
                                        <div class="col text-left pl-1" style="padding-top: 10px;"><input class="form-control" name="card-4" id="card-4" maxlength="4" type="number"></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col text-left pr-1" style="padding-top: 10px;"><label class="text-left">Expiry Date:</label></div>
                                        <div class="col text-left pr-1 pl-1" style="padding-top: 10px;"><label class="text-left">&nbsp;</label></div>
                                        <div class="col text-left pl-1" style="padding-top: 10px;"><label class="text-left">CVV:</label></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col text-left pr-1" style="padding-top: 10px;"><input class="form-control" type="number" name="expiry_date-1" placeholder="mm" maxlength="2" required></div>
                                        <div class="col text-left pr-1 pl-1" style="padding-top: 10px;"><input class="form-control" type="number" name="expiry_date-2" placeholder="yy" maxlength="2" required></div>
                                        <div class="col text-left pl-1" style="padding-top: 10px;"><input class="form-control" type="number" minlength="3" maxlength="4" placeholder="cvv" name="cvv" required></div>
                                    </div>
                                </div>
                                <div class="col-12">
                                   <hr />
                                </div>
                                <div class="col-12 pb-3 text-center pt-3">
                                    <button class="btn btn-dark" type="submit" name="submit" value="payment">
                                        <span class="ion ion-md-checkmark-circle-outline"></span> Finalize Booking for Checking
                                    </button>
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

            const card1 = document.getElementById("card-1");
            card1.onkeyup = function (ev) {
                const creditCardChecker = document.getElementsByClassName('creditCardChecker');
                if (card1.value.substring(0,1)=="4" && card1.value.length==1) {
                    creditCardChecker[0].innerHTML = "";
                    iziToast.show({
                        position: "center",
                        target: '.creditCardChecker',
                        title: "Visa",
                        message: "Credit card type detected",
                        layout: 2,
                        imageWidth: 100,
                        timeout: false,
                        backgroundColor: "#ae526d",
                        theme: 'dark',
                        icon: "ion ion-ios-card",
                        close: false,
                        display: 'replace',
                        targetFirst: true,
                        closeOnEscape: false,
                        closeOnClick: false,
                        drag: false
                    })
                } else if (card1.value.substring(0,1)=="5" && card1.value.length==1) {
                    creditCardChecker[0].innerHTML = "";
                    iziToast.show({
                        position: "center",
                        target: '.creditCardChecker',
                        title: "Mastercard",
                        targetFirst: true,
                        message: "Credit card type detected",
                        layout: 2,
                        imageWidth: 100,
                        timeout: false,
                        backgroundColor: "#ae526d",
                        theme: 'dark',
                        icon: "ion ion-ios-card",
                        close: false,
                        display: 'replace',
                        closeOnEscape: false,
                        closeOnClick: false,
                        drag: false
                    })
                } else if (card1.value.substring(0,1)=="6" && card1.value.length==1) {
                    creditCardChecker[0].innerHTML = "";
                    iziToast.show({
                        position: "center",
                        target: '.creditCardChecker',
                        title: "Discover",
                        message: "Credit card type detected",
                        layout: 2,
                        imageWidth: 100,
                        timeout: false,
                        backgroundColor: "#ae526d",
                        theme: 'dark',
                        icon: "ion ion-ios-card",
                        close: false,
                        display: 'replace',
                        targetFirst: true,
                        closeOnEscape: false,
                        closeOnClick: false,
                        drag: false
                    })
                } else if (card1.value.substring(0,2)=="37" && card1.value.length==2) {
                    creditCardChecker[0].innerHTML = "";
                    iziToast.show({
                        position: "center",
                        target: '.creditCardChecker',
                        title: "Amex (American Express)",
                        message: "Credit card type detected",
                        layout: 2,
                        imageWidth: 100,
                        timeout: false,
                        backgroundColor: "#ae526d",
                        theme: 'dark',
                        icon: "ion ion-ios-card",
                        close: false,
                        display: 'replace',
                        targetFirst: true,
                        closeOnEscape: false,
                        closeOnClick: false,
                        drag: false
                    })
                }
            };
        </script>
    </body>
</html>