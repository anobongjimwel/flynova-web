<?php
    require_once "../../traits/DatabaseOriented.php";
    require_once "../../classes/ProfileHandler.php";
    require_once "../../classes/NotificationHandler.php";
    session_start();

    if (is_array($notification = NotificationHandler::getLastUndisplayedNotification(ProfileHandler::getProfile($_SESSION['username'], ProfileHandler::PROFILE_USERNAME)['id']))) {
        $title = $notification['title'];
        $message = $notification['message'];
        $icon = $notification['icon'];
        $image = $notification['image'];
        $strToEcho = $notification['id']."|".$title."|".$message."|".$icon."|".$image."|".$notification['link'];
        echo $strToEcho;
    } else {
        echo "NONE";
    }
?>