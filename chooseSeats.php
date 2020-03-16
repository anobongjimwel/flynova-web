<?php require_once "assets/php/requires/superHeader.php" ?>
<?php if (!(isset($_SESSION['username']) && !empty($_SESSION['username']))) {
    header("Location: index.php");
} ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once "assets/php/includes/header.php"?>
        <title>FlyNova Booking Session - Choose Seats</title>
        <link rel="stylesheet" href="assets/css/bookingPages.css" />
        <style>
            /* Special Styling for Seats */

            input[type=checkbox]~label {
                content: url('assets/img/seats/unchecked.png');
                background-size: cover;
                width: 80%;
                height: 80%;
            }

            input[type=checkbox]:checked~label {
                content: url('assets/img/seats/checked.png');
            }

            input[type=checkbox]:disabled~label {
                content: url('assets/img/seats/disabled.png');
            }

            input[type=checkbox] {
                display: none;
            }
        </style>
    </head>
    <body class="bg-dark">
        <?php include_once "assets/php/includes/nav.php" ?>
        <div class="container-fluid" id="bookingContainer">
            <div class="row d-none d-md-block" style="background-color: rgba(255,255,255,0.85)">
                <div class="container">
                    <div class="row">
                        <div class="col-12 pb-3 pt-3"><h2>Choose Seats</h2></div>
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
                            <form method="post" enctype="application/x-www-form-urlencoded" action="flightSimulationProcessor.php">
                            <div class="row">
                                <div class="sticky-top col-12 text-center" style="background-color: white">
                                    <span style="font-size: 1.1em; font-weight: 400"><img src="assets/img/seats/unchecked.png" style="width: 1.1em; position: relative; top: -2px;"/>&nbsp;Seats Available, <img src="assets/img/seats/disabled.png" style="width: 1.1em; position: relative; top: -2px;"/>&nbsp;Seats Disabled, <img src="assets/img/seats/checked.png" style="width: 1.1em; position: relative; top: -2px;"/>&nbsp;Seats Selected</span>
                                </div>


                                <?php $seatCtr = 0 ?>
                                <?php $bookingDetails = BookingHandler::readBookingSimulation($_SESSION['current_booking_simulation'], ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']) ?>
                                <?php foreach($bookingDetails['booking_details']['booking'] as $booking) {?>
                                <?php
                                $carrier_name = CarrierHandler::identifyCarrier($booking['carrier']);
                                $carrier = $booking['carrier'];
                                switch ($carrier) {
                                    case "B737NG":
                                ?>

                                <div class="col-12">
                                    <div class="row pt-3">
                                        <div class="col-12">
                                            <span style="font-size: 1.25em; font-weight: 400">Boeing 737-800, <?= str_replace("-","<span class='ion ion-ios-airplane'></span>",$booking['route']) ?></span>
                                        </div>
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-12 pt-3">
                                                    <div class="row text-center">
                                                        <div class="col">
                                                            <span style="font-size: 1.5em; font-weight: 400">A</span>
                                                        </div>
                                                        <div class="col">
                                                            <span style="font-size: 1.5em; font-weight: 400">B</span>
                                                        </div>
                                                        <div class="col">
                                                            <span style="font-size: 1.5em; font-weight: 400"></span>
                                                        </div>
                                                        <div class="col">
                                                            <span style="font-size: 1.5em; font-weight: 400"></span>
                                                        </div>
                                                        <div class="col">
                                                            <span style="font-size: 1.5em; font-weight: 400"></span>
                                                        </div>
                                                        <div class="col">
                                                            <span style="font-size: 1.5em; font-weight: 400">C</span>
                                                        </div>
                                                        <div class="col">
                                                            <span style="font-size: 1.5em; font-weight: 400">D</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 pt-3">
                                                    <?php for ($col = 1; $col <= 32; $col++) { ?>
                                                        <div class="row text-center">
                                                            <div class="col" style="padding-top: 2px">
                                                                <div>
                                                                    <input type="checkbox" id="<?php echo $seatCtr?>-A<?php echo $col?>" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="A<?php echo $col?>"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                                    <label for="<?php echo $seatCtr?>-A<?php echo $col?>"></label>
                                                                </div>
                                                            </div>
                                                            <div class="col" style="padding-top: 2px">
                                                                <div>
                                                                    <input type="checkbox" id="<?php echo $seatCtr?>-B<?php echo $col?>"  name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="B<?php echo $col?>"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                                    <label for="<?php echo $seatCtr?>-B<?php echo $col?>"></label>
                                                                </div>
                                                            </div>
                                                            <div class="col" style="padding-top: 2px">
                                                                <div>
                                                                    <input type="checkbox" id="<?php echo $seatCtr?>-C<?php echo $col?>"  name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="C<?php echo $col?>"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                                    <label for="<?php echo $seatCtr?>-C<?php echo $col?>"></label>
                                                                </div>
                                                            </div>
                                                            <div class="col" style="padding-top: 2px;">
                                                                <span style="font-size: 1.5em; color: darkgray"><?php echo $col ?><sup>EC</sup></span>
                                                            </div>
                                                            <div class="col" style="padding-top: 2px;">
                                                                <div>
                                                                    <input type="checkbox" id="<?php echo $seatCtr?>-H<?php echo $col?>"  name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="H<?php echo $col?>"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                                    <label for="<?php echo $seatCtr?>-H<?php echo $col?>"></label>
                                                                </div>
                                                            </div>
                                                            <div class="col" style="padding-top: 2px;">
                                                                <div>
                                                                    <input type="checkbox" id="<?php echo $seatCtr?>-J<?php echo $col?>"  name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="J<?php echo $col?>"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                                    <label for="<?php echo $seatCtr?>-J<?php echo $col?>"></label>
                                                                </div>
                                                            </div>
                                                            <div class="col" style="padding-top: 2px;">
                                                                <div>
                                                                    <input type="checkbox" id="<?php echo $seatCtr?>-K<?php echo $col?>"  name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="K<?php echo $col?>"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                                    <label for="<?php echo $seatCtr?>-K<?php echo $col?>"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-12 pb-3">
                                                    <hr />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    break;
                                    case "AIR320":
                                ?>

                                <div class="col-12">
                                    <div class="row pt-3">
                                        <div class="col-12">
                                            <span style="font-size: 1.25em; font-weight: 400">Airbus 320, <?= str_replace("-","<span class='ion ion-ios-airplane'></span>",$booking['route']) ?></span>
                                        </div>
                                        <div class="col-12">
                                            <div class="row pb-3">
                                                <div class="col-12 pt-3">
                                                    <div class="row text-center">
                                                        <div class="col pr-0">
                                                            <span style="font-size: 1.5em; font-weight: 400">A</span>
                                                        </div>
                                                        <div class="col pl-0 pr-0">
                                                            <span style="font-size: 1.5em; font-weight: 400">B</span>
                                                        </div>
                                                        <div class="col pl-0 pr-0">
                                                            <span style="font-size: 1.5em; font-weight: 400"></span>
                                                        </div>
                                                        <div class="col pl-0 pr-0">
                                                            <span style="font-size: 1.5em; font-weight: 400"></span>
                                                        </div>
                                                        <div class="col pl-0 pr-0">
                                                            <span style="font-size: 1.5em; font-weight: 400"></span>
                                                        </div>
                                                        <div class="col pl-0 pr-0">
                                                            <span style="font-size: 1.5em; font-weight: 400">C</span>
                                                        </div>
                                                        <div class="col pl-0">
                                                            <span style="font-size: 1.5em; font-weight: 400">D</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 pt-3">
                                                    <?php for ($col = 1; $col <= 3; $col++) { ?>
                                                    <div class="row text-center">
                                                        <div class="col pr-0" style="padding-top: 2px;">
                                                            <div>
                                                                <input type="checkbox" id="<?php echo $seatCtr?>-A<?php echo $col?>"  name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>A"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                                <label for="<?php echo $seatCtr?>-A<?php echo $col?>"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                            <div>
                                                                <input type="checkbox" id="<?php echo $seatCtr?>-B<?php echo $col?>"  name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>B"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                                <label for="<?php echo $seatCtr?>-B<?php echo $col?>"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                        </div>
                                                        <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                            <span style="font-size: 1.5em; color: darkgray"><?php echo $col ?><sup>FC</sup></span>
                                                        </div>
                                                        <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                        </div>
                                                        <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                            <div>
                                                                <input type="checkbox" id="<?php echo $seatCtr?>-C<?php echo $col?>"  name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>C"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                                <label for="<?php echo $seatCtr?>-C<?php echo $col?>"></label>
                                                            </div>
                                                        </div>
                                                        <div class="col pl-0" style="padding-top: 2px;">
                                                            <div>
                                                                <input type="checkbox" id="<?php echo $seatCtr?>-D<?php echo $col?>"  name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>D"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                                <label for="<?php echo $seatCtr?>-D<?php echo $col?>"></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-12">
                                                    <div class="row text-center">
                                                        <div class="col pr-0">
                                                            <span style="font-size: 1.5em; font-weight: 400">A</span>
                                                        </div>
                                                        <div class="col pl-0 pr-0">
                                                            <span style="font-size: 1.5em; font-weight: 400">B</span>
                                                        </div>
                                                        <div class="col pl-0 pr-0">
                                                            <span style="font-size: 1.5em; font-weight: 400">C</span>
                                                        </div>
                                                        <div class="col pl-0 pr-0">
                                                            <span style="font-size: 1.5em; font-weight: 400"></span>
                                                        </div>
                                                        <div class="col pl-0 pr-0">
                                                            <span style="font-size: 1.5em; font-weight: 400">D</span>
                                                        </div>
                                                        <div class="col pl-0 pr-0">
                                                            <span style="font-size: 1.5em; font-weight: 400">E</span>
                                                        </div>
                                                        <div class="col pl-0">
                                                            <span style="font-size: 1.5em; font-weight: 400">F</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <?php for ($col = 4; $col <= 26; $col++) { ?>
                                                        <div class="row text-center">
                                                            <div class="col pr-0" style="padding-top: 2px;">
                                                                <div>
                                                                    <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>A" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>A"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                                    <label for="<?php echo $seatCtr?>-<?php echo $col?>A"></label>
                                                                </div>
                                                            </div>
                                                            <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                                <div>
                                                                    <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>B" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>B"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                                    <label for="<?php echo $seatCtr?>-<?php echo $col?>B"></label>
                                                                </div>
                                                            </div>
                                                            <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                                <div>
                                                                    <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>C" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>C"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                                    <label for="<?php echo $seatCtr?>-<?php echo $col?>C"></label>
                                                                </div>
                                                            </div>
                                                            <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                                <span style="font-size: 1.5em; color: darkgray"><?php echo $col ?><sup>EC</sup></span>
                                                            </div>
                                                            <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                                <div>
                                                                    <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>D" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>D"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                                    <label for="<?php echo $seatCtr?>-<?php echo $col?>D"></label>
                                                                </div>
                                                            </div>
                                                            <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                                <div>
                                                                    <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>E" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>E"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                                    <label for="<?php echo $seatCtr?>-<?php echo $col?>E"></label>
                                                                </div>
                                                            </div>
                                                            <div class="col pl-0" style="padding-top: 2px;">
                                                                <div>
                                                                    <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>F" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>F"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                                    <label for="<?php echo $seatCtr?>-<?php echo $col?>F"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="col-12 pb-3">
                                                    <hr />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    break;
                                    case "A330FC":
                                ?>

                                <div class="col-12">
                                    <div class="row pt-3">
                                        <div class="col-12">
                                            <span style="font-size: 1.25em; font-weight: 400">Airbus 300-330, <?= str_replace("-","<span class='ion ion-ios-airplane'></span>",$booking['route']) ?></span>
                                        </div>
                                        <div class="col-12 pt-3">
                                            <div class="row text-center">
                                                <div class="col pr-0">
                                                    <span style="font-size: 1.5em; font-weight: 400">A</span>
                                                </div>
                                                <div class="col pl-0 pr-0">
                                                    <span style="font-size: 1.5em; font-weight: 400">C</span>
                                                </div>
                                                <div class="col pl-0 pr-0">
                                                    <span style="font-size: 1.5em; font-weight: 400"></span>
                                                </div>
                                                <div class="col pl-0 pr-0">
                                                    <span style="font-size: 1.5em; font-weight: 400">D</span>
                                                </div>
                                                <div class="col pl-0 pr-0">
                                                    <span style="font-size: 1.5em; font-weight: 400">H</span>
                                                </div>
                                                <div class="col pl-0 pr-0">
                                                    <span style="font-size: 1.5em; font-weight: 400"></span>
                                                </div>
                                                <div class="col pl-0 pr-0">
                                                    <span style="font-size: 1.5em; font-weight: 400">J</span>
                                                </div>
                                                <div class="col pl-0">
                                                    <span style="font-size: 1.5em; font-weight: 400">L</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-3">
                                            <?php for ($col = 15; $col <= 20; $col++) { ?>
                                                <div class="row text-center">
                                                    <div class="col pr-0" style="padding-top: 2px;">
                                                        <div>
                                                            <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>A" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>A"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                            <label for="<?php echo $seatCtr?>-<?php echo $col?>A"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                        <div>
                                                            <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>C" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>C"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                            <label for="<?php echo $seatCtr?>-<?php echo $col?>C"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                        <span style="color: darkgray; font-size: 1.5em"><?= $col ?><sup>BC</sup></span>
                                                    </div>
                                                    <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                        <div>
                                                            <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>D" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>D"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                            <label for="<?php echo $seatCtr?>-<?php echo $col?>D"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                        <div>
                                                            <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>H" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>H"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                            <label for="<?php echo $seatCtr?>-<?php echo $col?>H"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                        <span style="color: darkgray; font-size: 1.5em"><?= $col ?><sup>BC</sup></span>
                                                    </div>
                                                    <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                        <div>
                                                            <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>J" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>J"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                            <label for="<?php echo $seatCtr?>-<?php echo $col?>J"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col pl-0" style="padding-top: 2px;">
                                                        <div>
                                                            <input type="checkbox" id="<?php echo $seatCtr?>-L<?php echo $col?>I" name="seating-<?php echo $seatCtr?>" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>L"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                            <label for="<?php echo $seatCtr?>-<?php echo $col?>L"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-12 pt-3">
                                            <div class="row text-center">
                                                <div class="col pr-0">
                                                    <span style="font-size: 1.25em; font-weight: 400">A</span>
                                                </div>
                                                <div class="col pr-0 pl-0">
                                                    <span style="font-size: 1.25em; font-weight: 400">C</span>
                                                </div>
                                                <div class="col pl-0 pr-0">
                                                    <span style="font-size: 1.25em; font-weight: 400"></span>
                                                </div>
                                                <div class="col pl-0 pr-0">
                                                    <span style="font-size: 1.25em; font-weight: 400">D</span>
                                                </div>
                                                <div class="col pl-0 pr-0">
                                                    <span style="font-size: 1.25em; font-weight: 400">E</span>
                                                </div>
                                                <div class="col pl-0 pr-0">
                                                    <span style="font-size: 1.25em; font-weight: 400">F</span>
                                                </div>
                                                <div class="col pl-0 pr-0">
                                                    <span style="font-size: 1.25em; font-weight: 400">H</span>
                                                </div>
                                                <div class="col pl-0 pr-0">
                                                    <span style="font-size: 1.25em; font-weight: 400"></span>
                                                </div>
                                                <div class="col pl-0 pr-0">
                                                    <span style="font-size: 1.25em; font-weight: 400">J</span>
                                                </div>
                                                <div class="col pl-0">
                                                    <span style="font-size: 1.25em; font-weight: 400">L</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 pt-3">
                                            <?php for ($col = 30; $col <= 47; $col++) { ?>
                                                <div class="row text-center">
                                                    <div class="col pr-0" style="padding-top: 2px;">
                                                        <div>
                                                            <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>A" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>A"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                            <label for="<?php echo $seatCtr?>-<?php echo $col?>A"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col pr-0 pl-0" style="padding-top: 2px;">
                                                        <div>
                                                            <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>C" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>C"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                            <label for="<?php echo $seatCtr?>-<?php echo $col?>C"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                        <span style="color: darkgray; font-size: 1em"><?php echo $col ?><sup>EC</sup></span>
                                                    </div>
                                                    <div class="col pr-0 pl-0" style="padding-top: 2px;">
                                                        <div>
                                                            <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>D" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>D"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                            <label for="<?php echo $seatCtr?>-<?php echo $col?>D"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col pr-0 pl-0" style="padding-top: 2px;">
                                                        <div>
                                                            <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>E" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>E"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                            <label for="<?php echo $seatCtr?>-<?php echo $col?>E"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col pr-0 pl-0" style="padding-top: 2px;">
                                                        <div>
                                                            <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>F" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>F"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                            <label for="<?php echo $seatCtr?>-<?php echo $col?>F"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col pr-0 pl-0" style="padding-top: 2px;">
                                                        <div>
                                                            <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>H" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>H"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                            <label for="<?php echo $seatCtr?>-<?php echo $col?>H"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col pl-0 pr-0" style="padding-top: 2px;">
                                                        <span style="color: darkgray; font-size: 1em"><?php echo $col ?><sup>EC</sup></span>
                                                    </div>
                                                    <div class="col pr-0 pl-0" style="padding-top: 2px;">
                                                        <div>
                                                            <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>J" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>J"  onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                            <label for="<?php echo $seatCtr?>-<?php echo $col?>J"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col pl-0" style="padding-top: 2px;">
                                                        <div>
                                                            <input type="checkbox" id="<?php echo $seatCtr?>-<?php echo $col?>L" name="seating-<?php echo $seatCtr?>[]" class="seating-<?php echo $seatCtr?>" value="<?php echo $col?>L" onchange="disableUnselectedCheckbox<?php echo $seatCtr?>()"/>
                                                            <label for="<?php echo $seatCtr?>-<?php echo $col?>L"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <div class="col-12 pb-3">
                                            <hr />
                                        </div>
                                    </div>
                                </div>

                                <?php
                                    break;
                                    }
                                ?>

                                <script>
                                    function disableUnselectedCheckbox<?php echo $seatCtr?>() {
                                        var seating<?php echo $seatCtr?> = document.querySelectorAll(".seating-<?php echo $seatCtr ?>");
                                        var seatingCtr<?php echo $seatCtr?> = document.querySelectorAll(".seating-<?php echo $seatCtr ?>:checked").length;
                                        if (seatingCtr<?php echo $seatCtr?> >= <?php echo($bookingDetails['passengers']['adults'] + $bookingDetails['passengers']['children'])?>) {
                                            for (i = 0; i < seating<?php echo $seatCtr?>.length ; i++) {
                                                if (!seating<?php echo $seatCtr?>[i].checked) {
                                                    seating<?php echo $seatCtr?>[i].setAttribute('disabled', 'disabled');
                                                }
                                            }
                                        } else {
                                            for (i = 0; i < seating<?php echo $seatCtr?>.length ; i++) {
                                                seating<?php echo $seatCtr?>[i].removeAttribute('disabled');
                                            }
                                        }
                                    }
                                </script>

                                <?php $seatCtr+=1;  } ?>

                                <div class="col-12 pb-3 text-center">
                                    <button class="btn btn-dark" type="submit" name="submit" value="seating">
                                        <span class="ion ion-ios-arrow-forward"></span> Proceed
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