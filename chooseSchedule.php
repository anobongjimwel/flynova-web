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
                        <div class="col-12 pb-3 pt-3"><h2>Choose Schedule</h2></div>
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
                        <div id="rightWindow" class="pt-2 pb-3 pl-3 pr-3" style="max-height: calc(100vh); overflow-y: scroll">
                        <form method="post" action="flightSimulationProcessor.php" enctype="application/x-www-form-urlencoded">
                            <div class="row text-center sticky-top">
                                <div class="col-12" style="background-color: white">
                                    <span style="font-size: 1.1em; font-weight: 400"><i class="ion ion-ios-airplane" style="color: #1485ee;"></i>&nbsp;Economy Class,&nbsp;<i class="ion ion-ios-airplane" style="color: #9900cc;"></i>&nbsp;Business Class,&nbsp;<i class="ion ion-ios-airplane" style="color: #ed2f59;"></i>&nbsp;First Class</span>
                                </div>
                            </div>
                            <form method="post" action="flightSimulationProcessor.php" enctype="application/x-www-form-urlencoded">
                            <div class="row pt-3">
                                <?php $bookingDetails = BookingHandler::readBookingSimulation($_SESSION['current_booking_simulation'], ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'])?>
                                <?php $flightCtr = 0; ?>
                                <?php foreach ($bookingDetails['booking_details']['booking'] as $booking) {?>
                                <div class="col-12">
                                    <span style="font-size: 1.25em; font-weight: 400"><?= $booking['route'].", ".date('d F Y')?></span>
                                </div>
                                <div class="col-12 pt-2">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tr>
                                                <th>Pick</th>
                                                <th>Times</th>
                                                <th>Places</th>
                                                <th>Carrier</th>
                                                <th>Seats</th>
                                            </tr>
                                            <?php foreach(RouteHandler::getRouteSchedules(($booking['origin_country']==$booking['destination_country'])?"local":"international") as $schedule) {?>
                                            <?php
                                            // Getting End Times
                                            $dateInterval = RouteHandler::getRouteDuration(RouteHandler::getRouteDistance($bookingDetails['hidden_properties']['origin_code'], $bookingDetails['hidden_properties']['destination_code']));
                                            $startDate = new DateTime($booking['date'].", ".$schedule['departureTime']);
                                            try {
                                                $startDate->add(date_interval_create_from_date_string($dateInterval));
                                            } catch (Exception $exception) {
                                                echo $exception->getMessage();
                                            };
                                            $endDate = $startDate;

                                            ?>
                                            <?php $value = $booking['date'].", ".date("Hi", strtotime($schedule['departureTime'])) ."|". $endDate->format("Y-m-d, Hi") ."|". $schedule['carrier_code'] ?>
                                            <tr class="align-content-center">
                                                <td>
                                                    <input type="radio" class="form-control" name="flight-<?= $flightCtr ?>" value="<?= $value ?>"/>
                                                </td>
                                                <td class="text-nowrap" style="position: relative; top: -7px;">
                                                    <span style="font-size: 1em; font-weight: 400"><?= date("Hi", strtotime($booking['date'].", ".$schedule['departureTime'])) ?> H</span><br />
                                                    <span style="font-size: 1em; font-weight: 400"><?= $endDate->format("Hi") ?> H</span>
                                                </td>
                                                <td  class="text-nowrap" style="position: relative; top: -7px;">
                                                    <span style="font-size: 1em; font-weight: 400"><?= $booking['origin_code'] ?></span><br />
                                                    <span style="font-size: 1em; font-weight: 400"><?= $booking['destination_code'] ?></span>
                                                </td>
                                                <td class="text-nowrap">
                                                    <span style="font-size: 1em; position: relative; top: -7px"><?= $schedule['carrier_name'] ?></span>
                                                </td>
                                                <td class="text-nowrap">
                                                    <span class="text-nowrap" style="font-size: 2em; position: relative; top: -7px">
                                                        <?php if ($schedule['ecs']) {?><i class="ion ion-ios-airplane" style="color: #1485ee;"></i>&nbsp;<?php } ?>
                                                        <?php if ($schedule['bcs']) {?><i class="ion ion-ios-airplane" style="color: #9900cc;"></i>&nbsp;<?php } ?>
                                                        <?php if ($schedule['fcs']) {?><i class="ion ion-ios-airplane" style="color: #ed2f59;"></i><?php } ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                            <hr />
                            <?php $flightCtr+=1; } ?>
                                <div class="col-12 text-center">
                                    <button class="btn btn-dark" type="submit" name="submit" value="scheduling">
                                        <span class="ion ion-ios-calendar"></span> Choose Schedule
                                    </button>
                                </div>
                            </div>
                            </form>
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