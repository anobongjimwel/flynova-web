<?php
    class ProfileHandler {
        use DatabaseOriented;
        const PROFILE_ID = "id";
        const PROFILE_USERNAME = "username";

        public static function getProfile($id, $by) {
            $query = self::static_database()->query("SELECT * FROM users WHERE $by = '$id'");
            if ($query->rowCount()==0) {
                return false;
            }
            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public static function getFirstName($fullname) {
            return explode(" ", $fullname)[0];
        }

        public static function doesExistsById($id) {
            $query = self::static_database()->query("SELECT * FROM users WHERE id = '$id'");
            if ($query->rowCount()>0) {
                return true;
            } else {
                return false;
            }
        }
    }
?>