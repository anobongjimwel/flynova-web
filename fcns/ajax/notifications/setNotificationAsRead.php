<?php
    require_once "../../traits/DatabaseOriented.php";
    require_once "../../classes/NotificationHandler.php";
    require_once "../../classes/ProfileHandler.php";
    session_start();

    if (
        isset($_POST['notificationId']) && !empty($_POST['notificationId']) &&
        isset($_SESSION['username']) && !empty($_SESSION['username'])
    ) {
        if (NotificationHandler::setNotificationAsRead(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id'], $_POST['notificationId'])) {
            echo "GOOD";
        } else {
            echo "FALSE";
        }
    } else {
        echo "BAD";
    }