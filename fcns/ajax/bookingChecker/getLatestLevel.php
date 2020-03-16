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
    //unset($_SESSION['current_booking_simulation']);
    $levelRange = LevelHandler::identifyLevelRange(LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']));
    $percent = LevelHandler::getCurrentBaseLevel($levelRange['min'], LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']),$levelRange['max'], LevelHandler::LEVEL_PERCENTAGE);
    $curr = LevelHandler::getCurrentBaseLevel($levelRange['min'], LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']),$levelRange['max'], LevelHandler::LEVEL_NUMERICAL);
    echo $levelRange['min']."|".$curr."|".number_format($percent,2)."|".$levelRange['max'];
} else {
    echo "BAD";
}