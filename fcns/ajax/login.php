<?php
    session_start();
    require_once "../traits/DatabaseOriented.php";
    require_once "../classes/SecurityHandler.php";

    if (isset($_POST['username']) && !empty($_POST['username']) &&
        isset($_POST['password']) && !empty($_POST['password'])
    ) {
        if (SecurityHandler::login($_POST['username'], $_POST['password'])!=false) {
            echo "GOOD";
        } else {
            echo "BAD";
        }
    }
