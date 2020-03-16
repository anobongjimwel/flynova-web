<?php
    require_once "../../traits/DatabaseOriented.php";
    require_once "../../classes/BookingHandler.php";
    require_once "../../classes/ProfileHandler.php";
    require_once "../../classes/LevelHandler.php";
    require_once "../../classes/StatisticsHandler.php";
    session_start();

    if (
        isset($_SESSION['username']) && !empty($_SESSION['username']) &&
        isset($_SESSION['username']) && !empty($_SESSION['current_booking_simulation'])
    ) {
        $instructions = json_decode(BookingHandler::readInstruction($_SESSION['current_booking_simulation'], ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'])['instruction'], true);
        $matcher = BookingHandler::checkSeatDesignation($_SESSION['current_booking_simulation'], ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']);
        if ($matcher[0] == true ) {
            echo "GOOD";
            switch ($instructions['booking_details']['class']) {
                case BookingHandler::BOOKING_CLASS_BUSINESS:
                    StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "business_class_bookings", 1);
                break;

                case BookingHandler::BOOKING_CLASS_ECONOMY:
                    StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "economy_class_bookings", 1);
                    break;

                case BookingHandler::BOOKING_CLASS_FIRST:
                    StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "first_class_bookings", 1);
                    break;
            }
        } else {
            $diminishedPoints = 0;
            switch ($instructions['booking_details']['category']) {
                case "easy":
                    $diminishedPoints = 5;
                    break;

                case "medium":
                    $diminishedPoints = 10;
                    break;

                case "hard":
                    $diminishedPoints = 30;
                    break;
            }
            LevelHandler::subtractBookingXp($_SESSION['current_booking_simulation'], $diminishedPoints);
            echo "-".$diminishedPoints."xp, ".$matcher[1];
        }
    } else {
        echo "BAD";
    }