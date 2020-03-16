<?php
    class ReviewerHandler {
        use DatabaseOriented;

        public static function getCountriesInContinent($continent) {
            $countries = self::static_database()->query("SELECT country FROM airport_codes WHERE continent = '$continent' GROUP BY country ORDER BY country");
            if ($countries->rowCount()==0) {
                return false;
            } else {
                return $countries->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        public static function getCodesInCountry($country) {
            $codes = self::static_database()->query("SELECT id, name, location FROM airport_codes WHERE country = '$country'");
            if ($codes->rowCount()==0) {
                return false;
            } else {
                return $codes->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
?>