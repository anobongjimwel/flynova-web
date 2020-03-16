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
        $matcher = BookingHandler::airportCodesMatch($_SESSION['current_booking_simulation'], ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']);
        if ($matcher[0]==true) {
            $instruction = json_decode(BookingHandler::readInstruction($_SESSION['current_booking_simulation'], ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'])['instruction'], true);
            StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "distance", $instruction['hidden_properties']['distance']);
            StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "flights", 1);
            switch ($instruction['booking_details']['destination_continent']) {
                case "Asia":
                    StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "destination_asia", 1);
                    break;
                case "Europe":
                    StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "destination_europe", 1);
                    break;
                case "North America":
                    StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "destination_north_america", 1);
                    break;
                case "South America":
                    StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "destination_south_america", 1);
                    break;
                case "Africa":
                    StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "destination_africa", 1);
                    break;
                case "Oceania":
                    StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "destination_oceania", 1);
                    break;
                case "Antarctica":
                    StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "destination_antarctica", 1);
                    break;
            }
            echo "GOOD";
        } else {
            $diminishedPoints = 0;
            switch (json_decode(BookingHandler::readInstruction($_SESSION['current_booking_simulation'], ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'])['instruction'], true)['booking_details']['category']) {
                case "easy":
                    $diminishedPoints = 40;
                    break;

                case "medium":
                    $diminishedPoints = 100;
                    break;

                case "hard":
                    $diminishedPoints = 150;
                    break;
            }
            LevelHandler::subtractBookingXp($_SESSION['current_booking_simulation'], $diminishedPoints);
            echo "-".$diminishedPoints."xp, ".$matcher[1];
        }
    } else {
        echo "BAD";
    }
