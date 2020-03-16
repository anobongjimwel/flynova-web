<?php require_once "assets/php/requires/superHeader.php" ?>
<?php if (!(isset($_SESSION['username']) && !empty($_SESSION['username']))) {
    header("Location: index.php");
} ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once "assets/php/includes/header.php"?>
        <title>FlyNova Booking Session - Customer Details</title>
        <link rel="stylesheet" href="assets/css/bookingPages.css" />
    </head>
    <body class="bg-dark">
        <?php include_once "assets/php/includes/nav.php" ?>
        <div class="container-fluid" id="bookingContainer">
            <div class="row d-none d-md-block" style="background-color: rgba(255,255,255,0.85)">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pb-3 pt-3"><h2>Customer Details</h2></div>
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
                                    <span style="font-size: 1.5em">Customer Details</span>
                                    <hr />
                                </div>
                                <div class="col-12">
                                    <?php $bookingDetails = BookingHandler::readBookingSimulation($_SESSION['current_booking_simulation'], ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']) ?>
                                    <?php $peopleCtr = 0;?>
                                    <?php for ($i = 1; $i<=$bookingDetails['passengers']['adults']; $i++) { ?>
                                    <div class="row">
                                        <div class="col-12">
                                            <span style="font-size: 1.25em">Adult Passenger <?= $i ?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-left" style="padding-top: 10px;"><label class="text-left">Name</label><input name="name-<?= $peopleCtr ?>" class="form-control" type="text"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-left pr-1" style="padding-top: 10px;"><label class="text-left">Age</label><input  name="age-<?= $peopleCtr ?>" required="required" class="form-control" type="number" inputmode="numeric"></div>
                                        <div class="col text-left pl-1 pr-1" style="padding-top: 10px;">
                                            <label class="text-left">Nationality</label>
                                            <select class="form-control"  name="nationality-<?= $peopleCtr ?>" required="required">
                                                <?php foreach(NationalityHandler::getGeneralQryNationalities() as $nationality) {?>
                                                    <option value="<?php echo $nationality['nationality']?>"><?php echo $nationality['nationality']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col text-left pl-1" style="padding-top: 10px;"><label class="text-left">Baggage</label>
                                            <select class="form-control" required="required"  name="baggage-<?php echo $peopleCtr ?>">
                                                <option value="">-</option>
                                                <option value="0">0 Kgs</option>
                                                <option value="20">20 kgs</option>
                                                <option value="40">40 kgs</option>
                                                <option value="60">60 kgs</option>
                                                <option value="80">80 kgs</option>
                                            </select>
                                        </div>
                                        <div class="col-12 pt-2">
                                            <hr />
                                        </div>
                                    </div>
                                    <?php $peopleCtr+=1; } ?>
                                    <?php for ($i = 1; $i<=$bookingDetails['passengers']['children']; $i++) { ?>
                                        <div class="row">
                                            <div class="col-12">
                                                <span style="font-size: 1.25em">Child Passenger <?= $i ?></span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-left" style="padding-top: 10px;"><label class="text-left">Name</label><input name="name-<?= $peopleCtr ?>" class="form-control" type="text"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col text-left pr-1" style="padding-top: 10px;"><label class="text-left">Age</label><input  name="age-<?= $peopleCtr ?>" required="required" class="form-control" type="number" inputmode="numeric"></div>
                                            <div class="col text-left pl-1 pr-1" style="padding-top: 10px;">
                                                <label class="text-left">Nationality</label>
                                                <select class="form-control"  name="nationality-<?= $peopleCtr ?>" required="required">
                                                    <?php foreach(NationalityHandler::getGeneralQryNationalities() as $nationality) {?>
                                                        <option value="<?php echo $nationality['nationality']?>"><?php echo $nationality['nationality']?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col text-left pl-1" style="padding-top: 10px;"><label class="text-left">Baggage</label>
                                                <select class="form-control" required="required"  name="baggage-<?php echo $peopleCtr ?>">
                                                    <option value="">-</option>
                                                    <option value="0">0 Kgs</option>
                                                    <option value="20">20 kgs</option>
                                                    <option value="40">40 kgs</option>
                                                    <option value="60">60 kgs</option>
                                                    <option value="80">80 kgs</option>
                                                </select>
                                            </div>
                                            <div class="col-12 pt-2">
                                                <hr />
                                            </div>
                                        </div>
                                    <?php $peopleCtr+=1; } ?>
                                    <input type="hidden" name="peopleCount" value="<?php echo $peopleCtr?>" />
                                </div>
                                <div class="col-12 pb-3 text-center pt-3">
                                    <button class="btn btn-dark" type="submit" name="submit" value="passengerDetails">
                                        <span class="ion ion-ios-card"></span> Proceed to Payment
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
        </script>
    </body>
</html>