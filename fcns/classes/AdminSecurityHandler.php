<?php
    require_once "Randomizer.php";
    require_once "AchievementHandler.php";

    class AdminSecurityHandler {
        use DatabaseOriented;

        public static function login($username, $password) {
            if (self::checkUser($username, $password)) {
                $_SESSION['admin_username'] = $username;
                return $username;
            } else {
                return false;
            }
        }

        private static function checkUser($username, $password) {
            $hashedPassword = hash("sha512", $password);
            $userFinder = self::static_database()->query("SELECT * FROM admin_users WHERE username = '$username' AND password = '$hashedPassword'");
            if ($userFinder->rowCount()<1) {
                return false;
            } else {
                return true;
            }
        }

        public static function logout() {
            try {
                unset($_SESSION['admin_username']);
            } catch (Exception $e) {
                return false;
            } finally {
                return true;
            }
        }

        public static function isAdminUsernameSet() {
            return ( isset($_SESSION['admin_username']) && !empty($_SESSION['admin_username']) );
        }

        public static function getAdminProfile($username) {
            $query = self::static_database()->query("SELECT * FROM admin_users WHERE username = '$username'");
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }