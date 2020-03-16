<?php
    session_start();
    require_once "../../fcns/traits/DatabaseOriented.php";
    require_once "../../fcns/classes/PaymentHandler.php";
    require_once "../../fcns/classes/RouteHandler.php";
    require_once "../../fcns/classes/NationalityHandler.php";
    require_once "../../fcns/classes/NamesHandler.php";
    require_once "../../fcns/classes/BookingHandler.php";
    require_once "../../fcns/classes/ProfileHandler.php";

    if (isset($_POST['category']) && !empty($_POST['category'])) {
        try {
            $category = $_POST['category'];

            switch ($_POST['category']) {
                case 'hard':
                    $assocArray = ['category' => 'hard'];
                    break;

                case 'medium':
                    $assocArray = ['category' => 'medium', 'continent' => $_POST['continent']];
                    break;

                case 'easy':
                    $assocArray = ['category' => 'easy', 'country' => $_POST['country']];
            }

            $currentBookingSession = BookingHandler::initiateInstructionJSON($assocArray, ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']);
            BookingHandler::initiateBookingJSON($currentBookingSession);
            BookingHandler::initiateRecieptJSON($currentBookingSession);
            echo "GOOD";
        } catch (Exception $e) {
            echo "BAD";
        }
    }

    class InvalidArgumentOnBookingInitiation extends Exception {}