<?php require_once "assets/php/requires/superHeader.php" ?>
<?php if (!(isset($_SESSION['username']) && !empty($_SESSION['username']))) {
    header("Location: index.php");
} ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once "assets/php/includes/header.php"?>
        <title>FlyNova Booking Session - Choose Route</title>
        <link rel="stylesheet" href="assets/css/bookingPages.css" />
    </head>
    <body class="bg-dark">
        <?php include_once "assets/php/includes/nav.php" ?>
        <div class="container-fluid" id="bookingContainer">
            <div class="row d-none d-md-block" style="background-color: rgba(255,255,255,0.85)">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pb-3 pt-3"><h2>Choose Route</h2></div>
                    </div>
                </div>
            </div>
            <div class="container pb-5" style="min-height: 100vh;" >
                <div class="row pt-5 pb-5">
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
                            <span style="font-size: 1.5em; font-weight: 400">Where would you like to go?</span>
                            <div class="row pt-3">
                                <div class="col-12 col-md-6">
                                    <span style="font-size: 1em">FLYING FROM</span>
                                    <div class="row pt-2">
                                        <div class="col-12">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control text-center" id="inlineFormInputGroup" style="font-size: 33px;" maxlength="1" minlength="1" required="required" name="from-1">
                                                <input type="text" class="form-control text-center" id="inlineFormInputGroup" style="font-size: 33px;" maxlength="1" minlength="1" required="required" name="from-2">
                                                <input type="text" class="form-control text-center" id="inlineFormInputGroup" style="font-size: 33px;" maxlength="1" minlength="1" required="required" name="from-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <span style="font-size: 1em">FLYING TO</span>
                                    <div class="row pt-2">
                                        <div class="col-12">
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control text-center" id="inlineFormInputGroup" style="font-size: 33px;" maxlength="1" minlength="1" required="required" name="to-1">
                                                <input type="text" class="form-control text-center" id="inlineFormInputGroup" style="font-size: 33px;" maxlength="1" minlength="1" required="required" name="to-2">
                                                <input type="text" class="form-control text-center" id="inlineFormInputGroup" style="font-size: 33px;" maxlength="1" minlength="1" required="required" name="to-3">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <label>ROUTE</label>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons" style="width: 100%;">
                                        <label class="btn btn-danger active" onclick="toggleReturnDatePicker(1)">One-Way<input type="radio" name="routeType" value="1" checked="checked"></label>
                                        <label class="btn btn-danger" onclick="toggleReturnDatePicker(2)">Round Trip<input type="radio" name="routeType" value="2"></label>
                                    </div>
                                </div>
                                <div class="col-12 pt-2 pt-xl-0 col-xl-6">
                                    <div class="form-row p-0">
                                        <div class="col-6" style="position: relative; top: -5px;">
                                            <label class="col-form-label">ADULTS</label><select class="form-control" name="adults"><option value="0">0 (Zero)</option><option value="1">1 (One)</option><option value="2">2 (Two)</option><option value="3">3 (Three)</option><option value="4">4 (Four)</option><option value="5">5 (Five)</option></select></label>
                                        </div>
                                        <div class="col-6" style="position: relative; top: -5px;">
                                            <label class="col-form-label">BELOW 18</label><select class="form-control" name="children"><option value="0">0 (Zero)</option><option value="1">1 (One)</option><option value="2">2 (Two)</option><option value="3">3 (Three)</option><option value="4">4 (Four)</option><option value="5">5 (Five)</option></select></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label>DEPARTING ON</label>
                                    <input type="date" class="form-control" name="departOn" id="departure" />
                                </div>
                                <div class="col-6 col-md-6">
                                    <div class="form-row d-none" id="returnDatePicker">
                                        <label>RETURNING ON</label>
                                        <input type="date" class="form-control" name="arriveOn" id="arrival" />
                                    </div>
                                </div>
                                <div class="col-12 text-center pt-3">
                                    <button class="btn btn-dark" type="submit" name="submit" value="routing"><span class="ion ion-ios-search"></span> Search Flight</button>
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
            function toggleReturnDatePicker(num) {
                switch (num) {
                    case 1:
                        document.getElementById("returnDatePicker").classList.add("d-none");
                        break;

                    case 2:
                        document.getElementById("returnDatePicker").classList.remove("d-none");
                        break;
                }
            }
        </script>
    </body>
</html>