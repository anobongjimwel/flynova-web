<?php
require_once "../../traits/DatabaseOriented.php";
require_once "../../classes/BookingHandler.php";
require_once "../../classes/ProfileHandler.php";
require_once "../../classes/LevelHandler.php";
require_once "../../classes/StatisticsHandler.php";
require_once "../../classes/AchievementHandler.php";
session_start();

if (
    isset($_SESSION['username']) && !empty($_SESSION['username']) &&
    isset($_SESSION['username']) && !empty($_SESSION['current_booking_simulation'])
) {
    $instruction = json_decode(BookingHandler::readInstruction($_SESSION['current_booking_simulation'], ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'])['instruction'], true);
    $xp = LevelHandler::getBookingXP($_SESSION['current_booking_simulation'], ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']);
    StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "easy_xp", $xp);
    switch ($instruction['booking_details']['category']) {
        case "easy":
            StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "easy_xp", $xp);
            if ($xp == BookingHandler::BOOKING_XP_EASY) {
                StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "perfect_flights", 1);
            }
            break;

        case "medium":
            StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "medium_xp", $xp);
            if ($xp == BookingHandler::BOOKING_XP_MEDIUM) {
                StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "perfect_flights", 1);
            }
            break;

        case "hard":
            StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "hard_xp", $xp);
            if ($xp == BookingHandler::BOOKING_XP_HARD) {
                StatisticsHandler::appendProfileStatistics(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], "perfect_flights", 1);
            }
            break;
    }

    LevelHandler::augmentUserXp(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], $xp);
    foreach (AchievementHandler::getAchievements() as $achievementName => $achievementCode) {
        AchievementHandler::updateAchievement(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], $achievementCode);
    }
    echo "<span style=\"font-size: 4em\" id=\"outerProgressText\">+<span id=\"innerProgressText\">$xp</span>xp</span><br />
                <span style='2.25em'>gained</span>";
} else {
    echo "BAD";
}
