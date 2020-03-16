<?php
    class NamesHandler {
        use DatabaseOriented;

        public static function getNames() {
            return self::static_database()->query("SELECT * FROM names");
        }

        public static function getNameById($id) {
            return self::static_database()->query("SELECT * FROM names WHERE id = $id");
        }
    }