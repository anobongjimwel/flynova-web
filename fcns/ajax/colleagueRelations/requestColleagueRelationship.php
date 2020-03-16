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
        if (!ColleagueRelationsHandler::doesColleagueRelationshipExists($_SESSION['username'], $_POST['u'])) {
            if (ColleagueRelationsHandler::requestColleagueRelationship($_SESSION['username'], $_POST['u'])) {
                $profileSender = ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME);
                $profileReciever = ProfileHandler::getProfile($_POST['u'],ProfileHandler::PROFILE_USERNAME);
                if (NotificationHandler::sendNotification($profileReciever['id'],"Colleague Relationship Request",$profileSender['full_name']." (@".$profileSender['username'].") would like to be colleagues with you","ion ion-ios-person-add","","profile.php?u=".$profileSender['username'])) {
                    echo "GOOD";
                } else {
                    echo "BAD (FAILED TO SEND NOTIFICATION)";
                }
            } else {
                echo "BAD (FAILED TO REQUEST COLLEAGUE RELATIONSHIP)";
            }
        } else {
            echo "BAD (REQUEST EXISTS)";
        }
    } else {
        echo "BAD (INCOMPLETE ARGUMENT)";
    }