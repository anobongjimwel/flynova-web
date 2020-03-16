
<?php
    require_once "assets/php/requires/superHeader.php";
    if (!(isset($_SESSION['username']) && !empty($_SESSION['username']))) {
    header("Location: index.php");
    }

    if (isset($_POST['submit']) && !empty($_POST['submit'])) {
        switch ($_POST['submit']) {
            case 'routing':
                $from = $_POST['from-1'].$_POST['from-2'].$_POST['from-3'];
                $to = $_POST['to-1'].$_POST['to-2'].$_POST['to-3'];
                $dates = [];
                switch ($_POST['routeType']) {
                    case 1:
                        if (isset($_POST['departOn']) && !empty($_POST['departOn'])) {
                            $dates["departOn"] = strval($_POST['departOn']);
                        }
                        break;

                    case 2:
                        if (isset($_POST['departOn']) && !empty($_POST['departOn'])) {
                            $dates["departOn"] = strval($_POST['departOn']);
                        }
                        if (isset($_POST['arriveOn']) && !empty($_POST['arriveOn'])) {
                            $dates["arriveOn"] = strval($_POST['arriveOn']);
                        }
                        break;
                }
                BookingHandler::insertBookingRouteSimulation($from, $to, $_POST['routeType'], $_POST['adults'], $_POST['children'], $_SESSION['current_booking_simulation'], $dates, ProfileHandler::getProfile( $_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']);
                BookingHandler::setTimer($_SESSION['current_booking_simulation'], 5);
                header("Location: chooseSchedule.php");
                break;

            case 'scheduling':
                foreach ($_POST as $postKey => $postValue) {
                    if ($postKey!="submit" && substr($postKey,0,7)=="flight-") {
                        $flightCtr = substr($postKey,7,1);
                        $startTime = explode("|",$postValue)[0];
                        $endTime = explode("|",$postValue)[1];
                        $carrier = explode("|",$postValue)[2];
                        BookingHandler::insertBookingScheduleSimulation($_SESSION['current_booking_simulation'], $startTime, $endTime, $carrier, $flightCtr, ProfileHandler::getProfile( $_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']);
                    }
                }
                BookingHandler::setTimer($_SESSION['current_booking_simulation'], 5);
                header("Location: chooseSeats.php");
                break;

            case 'seating':
                foreach ($_POST as $postKey => $postValue) {
                    if ($postKey!="submit" && substr($postKey,0,8)=="seating-") {
                        $flightCtr = substr($postKey,8,1);
                        BookingHandler::insertBookingSeatsSimulation($_SESSION['current_booking_simulation'], $postValue, $flightCtr, ProfileHandler::getProfile( $_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']);
                    }
                }
                BookingHandler::setTimer($_SESSION['current_booking_simulation'], 5);
                header("Location: customerDetails.php");
                break;

            case 'passengerDetails':
                $peopleCount = $_POST['peopleCount'];
                $names = $age = $nationalities = $baggage = [];
                for ($i=0;$i<$peopleCount;$i++) {
                    array_push($names, $_POST['name-'.$i]);
                    array_push($age, $_POST['age-'.$i]);
                    array_push($nationalities, $_POST['nationality-'.$i]);
                    array_push($baggage, $_POST['baggage-'.$i]);
                }
                BookingHandler::insertBookingPassengerDetailsSimulation($_SESSION['current_booking_simulation'], $names, $age, $nationalities, $baggage, $peopleCount, ProfileHandler::getProfile( $_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']);
                BookingHandler::setTimer($_SESSION['current_booking_simulation'], 5);
                header('Location: choosePayment.php');
                break;

            case 'payment':
                $card = $_POST['card-1']."-".$_POST['card-2']."-".$_POST['card-3']."-".$_POST['card-4'];
                $expiryDate = $_POST['expiry_date-1']."/".$_POST['expiry_date-2'];
                $cvv = $_POST['cvv'];
                BookingHandler::insertBookingPaymentSimulation($card, $expiryDate, $cvv, $_SESSION['current_booking_simulation'], ProfileHandler::getProfile( $_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']);
                BookingHandler::setTimer($_SESSION['current_booking_simulation'], 5);
                header("Location: checkBooking.php");
                break;
        }
    }