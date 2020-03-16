<?php
    session_start();
    require_once "../../traits/DatabaseOriented.php";
    require_once "../../classes/ColleagueRelationsHandler.php";
    require_once "../../classes/ProfileHandler.php";


    if (
        isset($_POST['u']) && !empty($_POST['u']) &&
        isset($_SESSION['username']) && !empty($_SESSION['username'])
    ) {
        if (ColleagueRelationsHandler::doesColleagueRelationshipExists($_SESSION['username'], $_POST['u'])) {
            if (ColleagueRelationsHandler::updateColleagueRelationship($_POST['u'], $_SESSION['username'], ColleagueRelationsHandler::STATUS_DECLINE)) {
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