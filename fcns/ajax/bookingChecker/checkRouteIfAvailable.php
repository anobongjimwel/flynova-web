<?php
    require_once "../../traits/DatabaseOriented.php";
    require_once "../../classes/BookingHandler.php";
    require_once "../../classes/StatisticsHandler.php";
    require_once "../../classes/ProfileHandler.php";
    require_once "../../classes/LevelHandler.php";
    session_start();

    if (
        isset($_SESSION['username']) && !empty($_SESSION['username']) &&
        isset($_SESSION['username']) && !empty($_SESSION['current_booking_simulation'])
    ) {
        if (BookingHandler::bookingRouteAvailable($_SESSION['current_booking_simulation'], ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'])==true) {
            echo "GOOD";
            StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "flights", 1);
        } else {
            $diminishedPoints = 0;
            switch (json_decode(BookingHandler::readInstruction($_SESSION['current_booking_simulation'], ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'])['instruction'], true)['booking_details']['category']) {
                case "easy":
                    $diminishedPoints = 30;
                    break;

                case "medium":
                    $diminishedPoints = 60;
                    break;

                case "hard":
                    $diminishedPoints = 90;
                    break;
            }
            StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "deadend", 1);
            LevelHandler::subtractBookingXp($_SESSION['current_booking_simulation'], $diminishedPoints);
            echo "-".$diminishedPoints."xp, "."The flight route is not being catered by our system. This may be due to you having typed a wrong airport code or not matching instruction's route.";
        }
    } else {
        echo "BAD";
    }