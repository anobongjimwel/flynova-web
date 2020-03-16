<?php
    session_start();
    require_once "../traits/DatabaseOriented.php";
    require_once "../classes/SecurityHandler.php";

    if (SecurityHandler::logout()) {
        echo "GOOD";
    } else {
        echo "BAD";
    }