<?php
    class NationalityHandler {
        use DatabaseOriented;

        public static function getGeneralQryNationalities() {
            return $query = self::static_database()->query("SELECT CONCAT(country, ' (' ,nationality, ')') as nationality FROM nationalities ORDER BY country");
        }

        public static function getCountryNames() {
            return $query = self::static_database()->query("SELECT id, country FROM nationalities ORDER BY country");
        }
    }