<?php
    require_once "Randomizer.php";
    require_once "LevelHandler.php";
    require_once "SeatHandler.php";
    require_once "CarrierHandler.php";


    class BookingHandler {
        const BOOKING_XP_EASY = 100;
        const BOOKING_XP_MEDIUM = 250;
        const BOOKING_XP_HARD = 500;
        const BOOKING_CLASS_FIRST = "First Class";
        const BOOKING_CLASS_BUSINESS = "Business Class";
        const BOOKING_CLASS_ECONOMY = "Economy Class";

        use DatabaseOriented;

        public static function initiateInstructionJSON($arguments, $userid) {
            if (isset($_SESSION['current_booking_simulation'])) {
                unset($_SESSION['current_booking_simulation']);
            }

            switch ($arguments['category']) {
                case "hard":
                    $routes = RouteHandler::getHardRoute();
                    break;

                case "medium":
                    $routes = RouteHandler::getMediumRoute($arguments['continent']);
                    break;


                case "easy":
                    $routes = RouteHandler::getEasyRoute($arguments['country']);
            };
            $route = RouteHandler::getRouteById($routes[rand(0, count($routes) - 1)]['id']);

            // Booking Details
            $booking['booking_details']['type'] = ["One-way", "Round Trip"][rand(0, 1)];
            $booking['booking_details']['origin'] = $route['source_name'];
            $booking['booking_details']['origin_country'] = $route['source_country'];
            $booking['booking_details']['destination'] = $route['destination_name'];
            $booking['booking_details']['destination_country'] = $route['destination_country'];

            $classes = [self::BOOKING_CLASS_ECONOMY, self::BOOKING_CLASS_FIRST, self::BOOKING_CLASS_BUSINESS];
            $booking['booking_details']['class'] = $classes[rand(0, count($classes) - 1)];
            $booking['booking_details']['category'] = $arguments['category'];
            $booking['booking_details']['destination_continent'] = $route['destination_continent'];

            // Passengers
            $adults = rand(1, 2);
            $children = rand(0, 2);
            $booking['passengers'] = [
                "adult" => $adults,
                "children" => $children,
                "details" => []
            ];

            $baggages = [0, 20, 40, 60, 80];

            $nationalitiesCtr = NationalityHandler::getGeneralQryNationalities()->rowCount();
            $nationalities = NationalityHandler::getGeneralQryNationalities()->fetchAll(PDO::FETCH_ASSOC);
            $currentNationality = $nationalities[rand(0, $nationalitiesCtr - 1)]['nationality'];

            $ctr = 0;
            for ($i = 0; $i < $adults; $i++) {
                array_push($booking['passengers']['details'],
                    [
                        "name" => NamesHandler::getNameById(rand(1, 2000))->fetch(PDO::FETCH_ASSOC)['name'],
                        "age" => rand(19, 64),
                        "nationality" => $currentNationality,
                        "type" => "adult",
                        "baggage" => $baggages[rand(0, count($baggages) - 1)]
                    ]);
                $ctr += 1;
            }

            for ($i = 0; $i < $children; $i++) {
                array_push($booking['passengers']['details'],
                    [
                        "name" => NamesHandler::getNameById(rand(1, 2000))->fetch(PDO::FETCH_ASSOC)['name'],
                        "age" => rand(1, 18),
                        "nationality" => $currentNationality,
                        "type" => "children",
                        "baggage" => $baggages[rand(0, count($baggages) - 1)]
                    ]);
                $ctr += 1;
            }

            // Hidden Properties
            $booking['hidden_properties'] = [
                "origin_code" => $route['source'],
                "destination_code" => $route['destination'],
                "distance" => $route['distance']
            ];

            // Payment Section
            $cards = [PaymentHandler::VISA, PaymentHandler::MASTERCARD, PaymentHandler::DISCOVER, PaymentHandler::AMEX];
            $selectedCard = $cards[rand(0, count($cards) - 1)];
            $booking['payment']['card_type'] = $selectedCard;
            $booking['payment']['card_number'] = PaymentHandler::addDashes(PaymentHandler::generateCardNumber($selectedCard));
            $booking['payment']['expiry_date'] = strval(PaymentHandler::generateExpiryDate(date('m'), date('d'), date('y')));
            $booking['payment']['security_code'] = PaymentHandler::generateCVV($selectedCard);
            $instruction = json_encode($booking, JSON_UNESCAPED_SLASHES);


            while (true) {
                $id = Randomizer::generate(12);
                if (self::checkBooking($id)==false) {
                    break;
                }
            }

            $q = self::static_database()->prepare("INSERT INTO booking_simulations (id, userID, instruction) VALUES (:id, :userid, :instruction)");
            $q->bindParam(":id", $id, PDO::PARAM_STR);
            $q->bindParam(":userid", $userid, PDO::PARAM_STR);
            $q->bindParam(":instruction", $instruction, PDO::PARAM_STR);
            $q->execute();
            $_SESSION['current_booking_simulation']=$id;
            switch ($arguments['category']) {
                case "hard":
                    LevelHandler::setBookingXp($id, self::BOOKING_XP_HARD);
                    break;

                case "medium":
                    LevelHandler::setBookingXp($id, self::BOOKING_XP_MEDIUM);
                    break;


                case "easy":
                    LevelHandler::setBookingXp($id, self::BOOKING_XP_EASY);
            };
            return $id;
        }

        public static function initiateBookingJSON($bookingSession) {
            $booking['booking_details'] = [
                'type' => "",
                'booking' => []
            ];
            $booking['passengers'] = [
                'adults' => 0,
                'children' => 0,
                'details' => []
            ];
            $booking['payment'] = [
                'card_type' => '',
                'card_number' => '',
                'expiry_date' => '',
                'security_code' => ''
            ];
            $bookingJson = json_encode($booking, JSON_UNESCAPED_SLASHES);
            if (self::checkBooking($bookingSession)) {
                $query = self::static_database()->prepare('UPDATE booking_simulations SET simulation = :simulation WHERE id = :booking');
                $query->bindParam(":simulation", $bookingJson, PDO::PARAM_STR);
                $query->bindParam(":booking", $bookingSession, PDO::PARAM_STR);
                $query->execute();
            }
        }

        public static function initiateRecieptJSON($bookingSession) {
            $reciept['flight_charges'] = [];
            $reciept['taxes'] = [
                'administrative_fee' => 0,
                'fuel_surcharge' => 0,
                'vat' => 0,
                'aviation_security_fee' => 0,
                'passenger_service_charge' => 0
            ];
            $reciept['total'] = 0;
            $recieptJSON = json_encode($reciept, JSON_UNESCAPED_SLASHES);
            if (self::checkBooking($bookingSession)) {
                $query = self::static_database()->prepare('UPDATE booking_simulations SET reciept = :reciept WHERE id = :booking');
                $query->bindParam(":reciept", $recieptJSON, PDO::PARAM_STR);
                $query->bindParam(":booking", $bookingSession, PDO::PARAM_STR);
                $query->execute();
            }
        }

        public static function checkBooking($id) {
            $q = self::static_database()->query("SELECT * FROM booking_simulations WHERE id = '$id'");
            if ($q->rowCount()==0) {
                return false;
            } else {
                return true;
            }
        }

        public static function insertBookingRouteSimulation($from, $to, $routeType, $adults, $children, $bookingSession, $dates, $userID) {
            if (self::checkBooking($bookingSession)) {
                $booking = self::readBookingSimulation($bookingSession, $userID);
                $booking['passengers']['adults'] = $adults;
                $booking['passengers']['children'] = $children;


                //removalOfArrayIfExist
                foreach ($booking['booking_details']['booking'] as $booking_detail) {
                    array_pop($booking['booking_details']['booking']);
                }

                $booking['hidden_properties']['origin_code'] = $from;
                $booking['hidden_properties']['destination_code'] = $to;

                //fromDetails
                $fromDetails = self::getAirportByCode($from);
                $toDetails = self::getAirportByCode($to);
                //toDetails
                switch ($routeType) {
                    case 1:
                        $booking['booking_details']['type'] = "One-way";
                        array_push($booking['booking_details']['booking'],
                            [
                               "route" => $from." - ".$to,
                               "origin" => ($fromDetails==false?null:$fromDetails['name']),
                               "origin_code" => $from,
                               "origin_country" => ($fromDetails==false?null:$fromDetails['country']),
                               "destination" => ($toDetails==false?null:$toDetails['name']),
                               "destination_code" => $to,
                               "destination_country" => ($toDetails==false?null:$toDetails['country']),
                               "destination_continent" => ($toDetails==false?null:$toDetails['continent']),
                               "departure" => "",
                               "arrival" => "",
                               "date" => $dates['departOn'],
                               "carrier" => "",
                               "seats" => []
                            ]);
                        break;

                    case 2:
                        $booking['booking_details']['type'] = "Round Trip";
                        array_push($booking['booking_details']['booking'],
                            [
                                "route" => $from." - ".$to,
                                "origin" => ($fromDetails==false?null:$fromDetails['name']),
                                "origin_code" => $from,
                                "origin_country" => ($fromDetails==false?null:$fromDetails['country']),
                                "destination" => ($toDetails==false?null:$toDetails['name']),
                                "destination_code" => $to,
                                "destination_country" => ($toDetails==false?null:$toDetails['country']),
                                "destination_continent" => ($toDetails==false?null:$toDetails['continent']),
                                "carrier" => "",
                                "departure" => "",
                                "arrival" => "",
                                "date" => $dates['departOn'],
                                "seats" => []
                            ]);
                        array_push($booking['booking_details']['booking'],
                            [
                                "route" => $to." - ".$from,
                                "origin" => ($toDetails==false?null:$toDetails['name']),
                                "origin_code" => $to,
                                "origin_country" => ($toDetails==false?null:$toDetails['country']),
                                "destination" => ($fromDetails==false?null:$fromDetails['name']),
                                "destination_code" => $to,
                                "destination_country" => ($fromDetails==false?null:$fromDetails['country']),
                                "destination_continent" => ($fromDetails==false?null:$fromDetails['continent']),
                                "carrier" => "",
                                "departure" => "",
                                "arrival" => "",
                                "date" => $dates['arriveOn'],
                                "seats" => []
                            ]);
                        break;
                };
                self::setBookingSimulation(json_encode($booking, JSON_UNESCAPED_SLASHES), $bookingSession);
            } else {
                return false;
            }
        }

        public static function insertBookingPaymentSimulation($card, $expiryDate, $cvv, $bookingSession, $userId) {
            if (self::checkBooking($bookingSession)) {
                $booking = self::readBookingSimulation($bookingSession, $userId);
                $booking['payment']['card_number'] = $card;
                if (substr($card,0,1)=="4") {
                    $booking['payment']['card_type'] = "visa";
                } elseif (substr($card,0,1)=="5") {
                    $booking['payment']['card_type'] = "mastercard";
                } elseif (substr($card,0,1)=="6") {
                    $booking['payment']['card_type'] = "discover";
                } elseif (substr($card,0,2)=="37") {
                    $booking['payment']['card_type'] = "amex";
                } else {
                    $booking['payment']['card_type'] = "unsupported";
                }
                $booking['payment']['expiry_date'] = $expiryDate;
                $booking['payment']['security_code'] = $cvv;
                self::setBookingSimulation(json_encode($booking, JSON_UNESCAPED_SLASHES), $bookingSession);
            } else {
                return false;
            }
        }

        public static function insertBookingScheduleSimulation($bookingSession, $startTime, $endTime, $carrier, $flightCounter, $userId) {
            if (self::checkBooking($bookingSession)) {
                $booking = self::readBookingSimulation($bookingSession, $userId);
                $booking['booking_details']['booking'][$flightCounter]['departure'] = $startTime;
                $booking['booking_details']['booking'][$flightCounter]['arrival'] = $endTime;
                $booking['booking_details']['booking'][$flightCounter]['carrier'] = $carrier;
                self::setBookingSimulation(json_encode($booking, JSON_UNESCAPED_SLASHES), $bookingSession);
            } else {
                return false;
            }
        }

        public static function insertBookingSeatsSimulation($bookingSession, $seats, $flightCounter, $userId) {
            if (self::checkBooking($bookingSession)) {
                $booking = self::readBookingSimulation($bookingSession, $userId);
                $booking['booking_details']['booking'][$flightCounter]['seats'] = $seats;
                self::setBookingSimulation(json_encode($booking, JSON_UNESCAPED_SLASHES), $bookingSession);
            } else {
                return false;
            }
        }

        public static function insertBookingPassengerDetailsSimulation($bookingSession, $names, $ages, $nationalities, $baggages, $personCtr, $userId) {
            if (self::checkBooking($bookingSession)) {
                $booking = self::readBookingSimulation($bookingSession, $userId);
                for ($i=0; $i<$personCtr; $i++) {
                    $booking['passengers']['details'][$i]['name'] = $names[$i];
                    $booking['passengers']['details'][$i]['age'] = $ages[$i];
                    $booking['passengers']['details'][$i]['nationality'] = $nationalities[$i];
                    $booking['passengers']['details'][$i]['baggage'] = $baggages[$i];
                }
                self::setBookingSimulation(json_encode($booking, JSON_UNESCAPED_SLASHES), $bookingSession);
            } else {
                return false;
            }
        }

        public static function setBookingSimulation($bookingJson, $bookingSession) {
            if (self::checkBooking($bookingSession)) {
                $query = self::static_database()->prepare('UPDATE booking_simulations SET simulation = :simulation WHERE id = :booking');
                $query->bindParam(":simulation", $bookingJson, PDO::PARAM_STR);
                $query->bindParam(":booking", $bookingSession, PDO::PARAM_STR);
                $query->execute();
            }
        }

        public static function readBookingSimulation($bookingSession, $userId) {
            if (self::checkBooking($bookingSession)) {
                $query = self::static_database()->query("SELECT simulation FROM booking_simulations WHERE id = '$bookingSession' AND userID = '$userId'");
                return json_decode($query->fetch(PDO::FETCH_ASSOC)['simulation'], true);
            }
        }

        public static function readInstruction($id, $userId) {
            $q = self::static_database()->query("SELECT instruction FROM booking_simulations WHERE id = '$id' AND userID = '$userId'");
            if ($q->rowCount()==0) {
                return false;
            } else {
                return $q->fetch(PDO::FETCH_ASSOC);
            }
        }

        public static function getAirportByCode($code) {
            $query = self::static_database()->query("SELECT * FROM airport_codes WHERE id = '$code'");
            if ($query->rowCount()==0) {
                return false;
            } else {
                return $query->fetch(PDO::FETCH_ASSOC);
            }
        }

        public static function setTimer($bookingSession, $timeInMinutes) {
            $q = self::static_database()->prepare("UPDATE booking_simulations SET time = :time WHERE id = :bookingSession");
            $q->bindParam(":time", $timeInMinutes, PDO::PARAM_INT);
            $q->bindParam(":bookingSession", $bookingSession, PDO::PARAM_STR);
            if ($q->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public static function getTimer($bookingSession) {
            $q = self::static_database()->query("SELECT time FROM booking_simulations WHERE id = '$bookingSession'");
            if ($q->rowCount()==0) {
                return false;
            } else {
                return $q->fetch(PDO::FETCH_ASSOC);
            }
        }



        public static function getUnfinishedTimers() {
            $q = self::static_database()->query("SELECT id, time FROM booking_simulations WHERE time <> 0");
            return $q->fetchAll(PDO::FETCH_ASSOC);
        }



        public static function getAllCountries() {
            $countries = self::static_database()->query("SELECT country FROM airport_codes GROUP BY country ORDER BY country");
            return $countries->fetchAll(PDO::FETCH_ASSOC);
        }

        // Booking Check Onwards
        public static function airportCodesMatch($bookingSession, $userId) {
            if (self::checkBooking($bookingSession)) {
                $instruction = json_decode(self::readInstruction($bookingSession, $userId)['instruction'], true);
                $simulation = self::readBookingSimulation($bookingSession, $userId);
                $return = [true, ""];
                if ($instruction['hidden_properties']['origin_code']!=$simulation['hidden_properties']['origin_code']) {
                    $return[0] = false;
                    $return[1] .= "Origin code does not match. ";
                }
                if ($instruction['hidden_properties']['destination_code']!=$simulation['hidden_properties']['destination_code']) {
                    $return[0] = false;
                    $return[1] .= "Destination code does not match. ";
                }
                return $return;
            } else {
                return false;
            }
        }

        public static function bookingRouteAvailable($bookingSession, $userId) {
            if (self::checkBooking($bookingSession)) {
                $simulation = self::readBookingSimulation($bookingSession, $userId);
                if (self::static_database()->query("SELECT * FROM situational_routes WHERE source = '".$simulation['hidden_properties']['origin_code']."' AND destination = '".$simulation['hidden_properties']['destination_code']."'")->rowCount()==1) {
                    return true;
                } else {
                    return false;
                }
            }
        }

        public static function checkBookingCounter($bookingSession, $userId) {
            if (self::checkBooking($bookingSession)) {
                $return = [true, ""];
                $instruction = json_decode(self::readInstruction($bookingSession, $userId)['instruction'], true);
                $simulation = self::readBookingSimulation($bookingSession, $userId);
                switch ($instruction['booking_details']['type']) {
                    case "One-way":
                        if ($instruction['booking_details']['type']!=$simulation['booking_details']['type'] || count($simulation['booking_details']['booking'])!=1) {
                            $return[0] = false;
                            $return[1] .= "The instruction says one-way but the simulated one is not.";
                        };
                        break;

                    case "Round Trip":
                        if ($instruction['booking_details']['type']!=$simulation['booking_details']['type'] || count($simulation['booking_details']['booking'])!=2) {
                            $return[0] = false;
                            $return[1] .= "The instruction says round trip but the simulated one is not.";
                        };
                        break;
                }
                return $return;
            }
        }

        public static function checkSeatDesignation($bookingSession, $userId) {
            function ordinal($number)
            {
                $ends = array('th', 'st', 'nd', 'rd', 'th', 'th', 'th', 'th', 'th', 'th');
                if ((($number % 100) >= 11) && (($number % 100) <= 13))
                    return $number . 'th';
                else
                    return $number . $ends[$number % 10];
            }

            $return = [true, ""];
            $instruction = json_decode(self::readInstruction($bookingSession, $userId)['instruction'], true);
            $simulation = self::readBookingSimulation($bookingSession, $userId);
            if (self::checkBooking($bookingSession)) {
                $class = "";
                switch ($instruction['booking_details']['class']) {
                    case "First Class":
                        $class = SeatHandler::FIRSTCLASS;
                        break;

                    case "Business Class":
                        $class = SeatHandler::BUSINESS;
                        break;

                    case "Economy Class":
                        $class = SeatHandler::ECONOMY;
                        break;
                }
                foreach ($simulation['booking_details']['booking'] as $booking) {
                    foreach ($booking['seats'] as $seat) {
                        if ($class != SeatHandler::identifySeat($seat, $booking['carrier'])) {
                            $return[0] = false;
                            $return[1] .= $booking['carrier'].":".$seat." is not a ".mb_strtolower($instruction['booking_details']['class'])." seat. ";
                        }
                    }
                }
                return $return;
            }
        }

        public static function checkPassengerDetails($bookingSession, $userId) {
            if (self::checkBooking($bookingSession)) {
                $return = [true, ""];
                $instruction = json_decode(self::readInstruction($bookingSession, $userId)['instruction'], true);
                $simulation = self::readBookingSimulation($bookingSession, $userId);
                if (
                    count($instruction['passengers']['details']) != count($simulation['passengers']['details'])
                ) {
                    $return[0] = false;
                    $return[1] .= "The passenger count is already not the same as the instructions provided. ";
                } else {
                    for ($i = 0; $i < count($instruction['passengers']['details']); $i++) {
                        $instructionDetail = $instruction['passengers']['details'][$i];
                        $simulationDetail = $simulation['passengers']['details'][$i];
                        if ($instructionDetail['name'] != $simulationDetail['name']) {
                            $return[0] = false;
                            $return[1] .= $instructionDetail['name'] . " is not included in the simulation's passengers. ";
                        } else {
                            if ($instructionDetail['age'] != $simulationDetail['age']) {
                                $return[0] = false;
                                $return[1] .= $instructionDetail['name'] ."'s age didn't match. ";
                            }
                            if ($instructionDetail['nationality'] != $simulationDetail['nationality']) {
                                $return[0] = false;
                                $return[1] .= $instructionDetail['name'] ."'s nationality didn't match. ";
                            }
                            if ($instructionDetail['baggage'] != $simulationDetail['baggage']) {
                                $return[0] = false;
                                $return[1] .= $instructionDetail['name'] ."'s baggage weight didn't match. ";
                            }
                        }
                    }
                }
                return $return;
            } else {
                return false;
            }
        }

        public static function paymentMatch($bookingSession, $userId) {
            if (self::checkBooking($bookingSession)) {
                $return = [true, ""];
                $instruction = json_decode(self::readInstruction($bookingSession, $userId)['instruction'], true);;
                $simulation = self::readBookingSimulation($bookingSession, $userId);
                if ($instruction['payment']['card_type'] != $simulation['payment']['card_type']) {
                    $return[0] = false;
                    $return[1] = "Card type didn't match. ";
                }
                if ($instruction['payment']['card_number'] != $simulation['payment']['card_number']) {
                    $return[0] = false;
                    $return[1] = "Card number didn't match. ";
                }
                if ($instruction['payment']['expiry_date'] != $simulation['payment']['expiry_date']) {
                    $return[0] = false;
                    $return[1] = "Expiry date didn't match. ";
                }
                if ($instruction['payment']['security_code'] != $simulation['payment']['security_code']) {
                    $return[0] = false;
                    $return[1] = "CVV / Security code didn't match. ";
                }
                return $return;
            } else {
                return false;
            }
        }


        // For profile

        public static function getBookingsByUser($userId) {
            $query = self::static_database()->query("SELECT * FROM booking_simulations WHERE userID = '$userId' ORDER BY date desc LIMIT 10 OFFSET 0");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }