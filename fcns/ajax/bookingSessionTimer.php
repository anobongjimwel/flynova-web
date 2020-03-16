<?php
    session_start();
    require_once "../../fcns/traits/DatabaseOriented.php";
    require_once "../../fcns/classes/BookingHandler.php";

    switch (BookingHandler::getTimer($_SESSION['current_booking_simulation'])['time']) {
        case false:
            echo "FALSE";
            break;

        case 0:
            echo "0";
            break;

        default:
            echo BookingHandler::getTimer($_SESSION['current_booking_simulation'])['time'];
    }