<?php
    require_once "../traits/DatabaseOriented.php";
    require_once "../classes/SecurityHandler.php";

    if (
        isset($_POST['register']) &&
        isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['username']) && !empty($_POST['username']) &&
        isset($_POST['name']) && !empty($_POST['name']) &&
        isset($_POST['nickname']) && !empty($_POST['nickname']) &&
        isset($_POST['country']) && !empty($_POST['country']) &&
        isset($_POST['password']) && !empty($_POST['password'])
    ) {
        $email = $_POST['email'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $nickname = $_POST['nickname'];
        $country = $_POST['country'];
        $password = $_POST['password'];

        $response = "";

        if (!SecurityHandler::checkEmail($email)) {
            if (!SecurityHandler::checkUsername($username)) {
                if (SecurityHandler::register($name, $username, $password, $nickname, $email, $country)) {
                    $response = "GOOD";
                } else {
                    $response = "Failed to register account due to conflict.";
                }
            } else {
                $response = "Username already belongs to another user. Please try another one.";
            }
        } else {
            $response = "Email already belongs to another user. Please try another one.";
        }
    } else {
        $response = "Incomplete information has been sent.";
    }

    echo $response;