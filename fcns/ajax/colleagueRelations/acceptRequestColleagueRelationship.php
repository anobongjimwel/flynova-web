<?php
    session_start();
    require_once "../../traits/DatabaseOriented.php";
    require_once "../../classes/ColleagueRelationsHandler.php";
    require_once "../../classes/ProfileHandler.php";
    require_once "../../classes/NotificationHandler.php";


    if (
        isset($_POST['u']) && !empty($_POST['u']) &&
        isset($_SESSION['username']) && !empty($_SESSION['username'])
    ) {
        if (ColleagueRelationsHandler::doesColleagueRelationshipExists($_SESSION['username'], $_POST['u'])) {
            if (ColleagueRelationsHandler::updateColleagueRelationship($_POST['u'], $_SESSION['username'], ColleagueRelationsHandler::STATUS_ACCEPTED)) {
                $profileSender = ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME);
                $profileReciever = ProfileHandler::getProfile($_POST['u'],ProfileHandler::PROFILE_USERNAME);
                if (
                NotificationHandler::sendNotification($profileReciever['id'],"New Colleague","You and ".$profileSender['full_name']." (@".$profileSender['username'].") are now colleagues","ion ion-ios-contacts","","profile.php?u=".$profileSender['username']) &&
                NotificationHandler::sendNotification($profileSender['id'],"New Colleague","You and ".$profileReciever['full_name']." (@".$profileReciever['username'].") are now colleagues","ion ion-ios-contacts","","profile.php?u=".$profileReciever['username'])
                )
                echo "GOOD";
            } else {
                echo "BAD";
            }
        } else {
            echo "BAD (REQUEST EXISTS)";
        }
    } else {
        echo "BAD (INCOMPLETE ARGUMENT)";
    }