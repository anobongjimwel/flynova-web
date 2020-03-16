<?php
    class AirportHandler {
        use DatabaseOriented;

        public static function getAirports() {
            $query = self::static_database()->query("SELECT * FROM airport_codes");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getAllAirportCtr() {
            $query = self::static_database()->query("SELECT * FROM airport_codes");
            return $query->rowCount();
        }

        public static function getSearchResultsCtr($q) {
            $query = self::static_database()->query("SELECT * FROM airport_codes WHERE id LIKE '%$q%' OR name LIKE '%$q%' OR location LIKE '%$q%' OR country LIKE '%$q%' OR continent LIKE '%$q%'");
            return $query->rowCount();
        }

        public static function getSearchResults($q) {
            $query = self::static_database()->query("SELECT * FROM airport_codes WHERE id LIKE '%$q%' OR name LIKE '%$q%' OR location LIKE '%$q%' OR country LIKE '%$q%' OR continent LIKE '%$q%'");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getAirportPages($limit) {
            $query = self::static_database()->query("SELECT * FROM airport_codes");
            $total = $query->rowCount();
            $pages = $total / $limit;
            return $pages-1;
        }

        public static function getAirportsByPage($limit = '', $offset = '') {
            $limitingStr = ($limit!=""?" LIMIT $limit":"") . ($offset!=""?" OFFSET $offset":"");
            $query = self::static_database()->query("SELECT * FROM airport_codes".$limitingStr);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getAirportDetails($id) {
            $query = self::static_database()->query("SELECT * FROM airport_codes WHERE id = '$id'");
            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public static function checkIfAirportExist($id) {
            $query = self::static_database()->query("SELECT * FROM airport_codes WHERE id = '$id'");
            if ($query->rowCount()==0) {
                return false;
            } else {
                return true;
            }
        }

        // Administrative Gathering by Country

        public static function getCountryCount() {
            $query = self::static_database()->query("SELECT DISTINCT country FROM airport_codes ORDER BY country");
            return $query->rowCount();
        }

        public static function getCountriesForAirports() {
            $query = self::static_database()->query("SELECT DISTINCT country FROM airport_codes ORDER BY country");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getAirportsByCountrySelector($country) {
            $query = self::static_database()->query("SELECT DISTINCT *  FROM airport_codes WHERE country = '$country' ORDER BY country");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getAirportsByCountrySelectorCtr($country) {
            $query = self::static_database()->query("SELECT DISTINCT *  FROM airport_codes WHERE country = '$country' ORDER BY country");
            return $query->rowCount();
        }
    }