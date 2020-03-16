<?php
    require_once "ProfileHandler.php";
    require_once "Randomizer.php";

    class NotificationHandler {
        use DatabaseOriented;

        public static function getLastUndisplayedNotification($userId) {
            $query = self::static_database()->query("SELECT * FROM notifications WHERE notified = 0 AND user_id = '$userId' ORDER BY date asc");
            if ($query->rowCount()>0) {
                return $query->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public static function setAllNotificationsRead($userId) {
            if (ProfileHandler::doesExistsById($userId)) {
                $query = self::static_database()->prepare("UPDATE notifications SET notified = 1, `read` = 1 WHERE user_id = :id");
                $query->bindParam(":id", $userId, PDO::PARAM_STR);
                return $query->execute();
            } else {
                return false;
            }
        }

        public static function getUnreadNotifications($userId) {
            if (ProfileHandler::doesExistsById($userId)) {
                $query = self::static_database()->query("SELECT * FROM notifications WHERE user_id = '$userId' AND `read` = 0 ORDER BY date desc");
                return $query->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        public static function doesExistsById($notificationId) {
            $query = self::static_database()->query("SELECT * FROM notifications WHERE id = '$notificationId'");
            if ($query->rowCount()>0) {
                return true;
            } else {
                return false;
            }
        }

        public static function setNotificationAsShown($userId, $notificationId) {
            if (ProfileHandler::doesExistsById($userId)) {
                if (self::doesExistsById($notificationId)) {
                    $query = self::static_database()->prepare("UPDATE notifications SET notified = 1 WHERE user_id = :userId AND id = :id");
                    $query->bindParam(":userId", $userId, PDO::PARAM_STR);
                    $query->bindParam(":id", $notificationId, PDO::PARAM_STR);
                    return $query->execute();
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public static function setNotificationAsRead($userId, $notificationId) {
            if (ProfileHandler::doesExistsById($userId)) {
                if (self::doesExistsById($notificationId)) {
                    $query = self::static_database()->prepare("UPDATE notifications SET notified = 1, `read` = 1 WHERE user_id = :userId AND id = :id");
                    $query->bindParam(":userId", $userId, PDO::PARAM_STR);
                    $query->bindParam(":id", $notificationId, PDO::PARAM_STR);
                    return $query->execute();
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public static function sendNotification($userId, $title, $message, $icon = 'ion ion-ios-notifications', $image = '', $link = '#') {
            while (true) {
                $notificationId = Randomizer::generate(20);
                if (!self::doesExistsById($notificationId)) {
                    break;
                }
            }
            $sendNotification = self::static_database()->prepare("INSERT INTO notifications (id, title, user_id, message, icon, image, link) VALUES (:id, :title, :user_id, :message, :icon, :image, :link)");
            $sendNotification->bindParam(":id", $notificationId, PDO::PARAM_STR);
            $sendNotification->bindParam(":title", $title, PDO::PARAM_STR);
            $sendNotification->bindParam(":user_id", $userId, PDO::PARAM_STR);
            $sendNotification->bindParam(":message", $message, PDO::PARAM_STR);
            $sendNotification->bindParam(":icon", $icon, PDO::PARAM_STR);
            $sendNotification->bindParam(":image", $image, PDO::PARAM_STR);
            $sendNotification->bindParam(":link", $link, PDO::PARAM_STR);
            if ($sendNotification->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }