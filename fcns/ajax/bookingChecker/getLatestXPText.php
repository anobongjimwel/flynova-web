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
    ?>
    &nbsp;<?= LevelHandler::showShortenedXPCtr(LevelHandler::getUserXP(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']))?><sup>xp</sup>
<?php
} else {
    echo "BAD";
}
?>