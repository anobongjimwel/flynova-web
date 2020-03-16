<?php
    class RouteHandler {
        use DatabaseOriented;
        const ROUTE_MEDIUM = 'medium';
        const ROUTE_HARD = 'hard';
        const ROUTE_EASY = 'easy';
        const ROUTE_INTERNATIONAL = 'international';
        const ROUTE_LOCAL = 'local';

        public static function getHardRoute() {
            $q = self::static_database()->query("SELECT id FROM situational_routes WHERE category = 'Hard'");
            return $q->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getMediumRoute($continent) {
            $q = self::static_database()->query("SELECT id FROM situational_routes WHERE category = 'Medium' and source_continent = '$continent' and destination_continent = '$continent'");
            return $q->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getEasyRoute($country) {
            $q = self::static_database()->query("SELECT id FROM situational_routes WHERE category = 'Easy' and source_country = '$country'");
            if ($q->rowCount()==0) {
                return false;
            } else {
                return $q->fetchAll(PDO::FETCH_ASSOC);
            }
        }

        public static function getRouteById($id) {
            $q = self::static_database()->query("SELECT sr.id as id, sr.source as source, acS.name as source_name, sr.source_country as source_country, sr.source_continent as source_continent, sr.distance as distance, sr.destination as destination, acD.name as destination_name, sr.destination_country as destination_country, sr.destination_continent
                FROM situational_routes sr 
                INNER JOIN airport_codes acS ON sr.source = acS.id 
                INNER JOIN airport_codes acD ON sr.destination = acD.id 
                WHERE sr.id = '$id'");
            if ($q->rowCount()==0) {
                return false;
            } else {
                return $q->fetch(PDO::FETCH_ASSOC);
            }
        }

        public static function getRouteDuration($distance) {
            $hrs = number_format(($distance / 930),0);
            if ($hrs >= 1) {
                $minutes = ($distance % 930 > 415) ? 30 : 0;
            } else {
                $minutes = 30;
            }
            return ($hrs<>0?$hrs." hours":"").($minutes==30?"30 minutes":""); // DateInterval String
        }

        public static function getRouteDistance($source, $destination) {
            $q = self::static_database()->query("SELECT * FROM situational_routes WHERE source = '$source' AND destination = '$destination'");
            if ($q->rowCount()==0) {
                return false;
            } else {
                return $q->fetch(PDO::FETCH_ASSOC)['distance'];
            }
        }

        public static function getRouteSchedules($type) {
            switch ($type) {
                case 'local':
                case 'international':
                    $q = self::static_database()->query("SELECT fs.id as id, fs.departureTime as departureTime, fs.carrier as carrier_code, c.name as carrier_name, c.business_class_seating as bcs, c.first_class_seating as fcs, c.economy_class_seating as ecs
                            FROM flight_schedules fs
                            INNER JOIN carrier c ON fs.carrier = c.id
                              WHERE fs.type = '$type'
                            ORDER BY fs.departureTime");
                    return $q->fetchAll(PDO::FETCH_ASSOC);
                    break;

                default:
                    return false;
            }
        }

        // Administrator Functions

        public static function getEasyRoutes($sourceCode) {
            $query = self::static_database()->query("SELECT situational_routes.id as id, situational_routes.destination as dst, airport_codes.name as destination_name, airport_codes.country as destination_country, airport_codes.continent as destination_continent, situational_routes.distance as distance FROM situational_routes INNER JOIN airport_codes ON situational_routes.destination = airport_codes.id  WHERE source = '$sourceCode' AND category = 'Easy'");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getEasyRoutesCtr($sourceCode) {
            $query = self::static_database()->query("SELECT * FROM situational_routes WHERE source = '$sourceCode' AND category = 'Easy'");
            return $query->rowCount();
        }

        public static function getMediumRoutes($sourceCode) {
            $query = self::static_database()->query("SELECT situational_routes.id as id, situational_routes.destination as dst, airport_codes.name as destination_name, airport_codes.country as destination_country, airport_codes.continent as destination_continent, situational_routes.distance as distance FROM situational_routes INNER JOIN airport_codes ON situational_routes.destination = airport_codes.id  WHERE source = '$sourceCode' AND category = 'Medium'");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getMediumRoutesCtr($sourceCode) {
            $query = self::static_database()->query("SELECT * FROM situational_routes WHERE source = '$sourceCode' AND category = 'Medium'");
            return $query->rowCount();
        }

        public static function getHardRoutes($sourceCode) {
            $query = self::static_database()->query("SELECT situational_routes.id as id, situational_routes.destination as dst, airport_codes.name as destination_name, airport_codes.country as destination_country, airport_codes.continent as destination_continent, situational_routes.distance as distance FROM situational_routes INNER JOIN airport_codes ON situational_routes.destination = airport_codes.id  WHERE source = '$sourceCode' AND category = 'Hard'");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getHardRoutesCtr($sourceCode) {
            $query = self::static_database()->query("SELECT * FROM situational_routes WHERE source = '$sourceCode' AND category = 'Hard'");
            return $query->rowCount();
        }

        public static function getArrivingRoutes($sourceCode) {
            $query = self::static_database()->query("SELECT situational_routes.id as id, situational_routes.source as src, airport_codes.name as source_name, airport_codes.country as source_country, airport_codes.continent as source_continent, situational_routes.distance as distance FROM situational_routes INNER JOIN airport_codes ON situational_routes.source = airport_codes.id WHERE destination = '$sourceCode'");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getArrivingRoutesCtr($sourceCode) {
            $query = self::static_database()->query("SELECT * FROM situational_routes WHERE destination = '$sourceCode'");
            return $query->rowCount();
        }
    }
?>