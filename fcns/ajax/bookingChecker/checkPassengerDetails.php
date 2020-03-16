<?php
    require_once "../../traits/DatabaseOriented.php";
    require_once "../../classes/BookingHandler.php";
    require_once "../../classes/ProfileHandler.php";
    require_once "../../classes/LevelHandler.php";
    session_start();

    if (
        isset($_SESSION['username']) && !empty($_SESSION['username']) &&
        isset($_SESSION['username']) && !empty($_SESSION['current_booking_simulation'])
    ) {
        $matcher = BookingHandler::checkPassengerDetails($_SESSION['current_booking_simulation'], ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']);
        if ($matcher[0] == true ) {
            echo "GOOD";
        } else {
            $diminishedPoints = 0;
            switch (json_decode(BookingHandler::readInstruction($_SESSION['current_booking_simulation'], ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'])['instruction'], true)['booking_details']['category']) {
                case "easy":
                    $diminishedPoints = 5;
                    break;

                case "medium":
                    $diminishedPoints = 10;
                    break;

                case "hard":
                    $diminishedPoints = 20;
                    break;
            }
            LevelHandler::subtractBookingXp($_SESSION['current_booking_simulation'], $diminishedPoints);
            echo "-".$diminishedPoints."xp, ".$matcher[1];
        }
    } else {
        echo "BAD";
    }