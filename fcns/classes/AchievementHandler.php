<?php
    require_once "NotificationHandler.php";

    class AchievementHandler {
        use DatabaseOriented;
        const BRONZE_SAFARI_ADVENTURER = 'AFRIC001';
        const SILVER_SAFARI_ADVENTURER = 'AFRIC002';
        const GOLD_SAFARI_ADVENTURER = 'AFRIC003';
        const BRONZE_TEMPLES_CONQUEROR = 'ASIA0001';
        const SILVER_TEMPLES_CONQUEROR = 'ASIA0002';
        const GOLD_TEMPLES_CONQUEROR = 'ASIA0003';
        const BRONZE_WANDERER_BUSINESSPERSON = 'BUS00001';
        const SILVER_WANDERER_BUSINESSPERSON = 'BUS00002';
        const GOLD_WANDERER_BUSINESSPERSON = 'BUS00003';
        const CIRCUMNAVIGATION_TRAVELER = 'CIRCUM01';
        const BRONZE_CLASSY_TRAVEL = 'CLASS001';
        const SILVER_CLASSY_TRAVEL = 'CLASS002';
        const GOLD_CLASSY_TRAVEL = 'CLASS003';
        const BRONZE_COSTLY_TRAVEL_ITINERARY = 'COSTLY01';
        const SILVER_COSTLY_TRAVEL_ITINERARY = 'COSTLY02';
        const GOLD_COSTLY_TRAVEL_ITINERARY = 'COSTLY03';
        const BRONZE_DEAD_END = 'DEAD0001';
        const SILVER_DEAD_END = 'DEAD0002';
        const GOLD_DEAD_END = 'DEAD0003';
        const BRONZE_FJORDS_CROSSER = 'EURO0001';
        const SILVER_FJORDS_CROSSER = 'EURO0002';
        const GOLD_FJORDS_CROSSER = 'EURO0003';
        const MOON_LOVER = 'LUNAR001';
        const BRONZE_CANYON_TRAVELLER = 'NAMRCA01';
        const SILVER_CANYON_TRAVELLER = 'NAMRCA02';
        const GOLD_CANYON_TRAVELLER = 'NAMRCA03';
        const BRONZE_ARCHIPELAGO_SWIMMER = 'OCEAN001';
        const SILVER_ARCHIPELAGO_SWIMMER = 'OCEAN002';
        const GOLD_ARCHIPELAGO_SWIMMER = 'OCEAN003';
        const ON_THE_OTHER_SIDE_OF_THE_WORLD = 'OTOSOTW1';
        const BRONZE_ECONOMIC_TRAVELER = 'PARS0001';
        const SILVER_ECONOMIC_TRAVELER = 'PARS0002';
        const GOLD_ECONOMIC_TRAVELER = 'PARS0003';
        const BRONZE_PERFECTIONIST = 'PERFECT1';
        const SILVER_PERFECTIONIST = 'PERFECT2';
        const GOLD_PERFECTIONIST = 'PERFECT3';
        const QUARTER_OBLATE_SPHEROID = 'QOSP0001';
        const BRONZE_GLACIER_MELTER = 'SAMRCA01';
        const SILVER_GLACIER_MELTER = 'SAMRCA02';
        const GOLD_GLACIER_MELTER = 'SAMRCA03';
        const BRONZE_SOUTHERN_WATER_BENDER = 'SWATERB1';
        const SILVER_SOUTHERN_WATER_BENDER = 'SWATERB2';
        const GOLD_SOUTHERN_WATER_BENDER = 'SWATERB3';

        private static function compareStatistic($required, $amount) {
            if (is_numeric($required) AND is_numeric($amount)) {
                if ($amount >= $required) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public static function updateAchievement($userId, $achievement) {
            if (isset($userId) && !empty($userId)) {
                if (self::isProfileExists($userId)) {
                    switch ($achievement) {
                        case self::BRONZE_SAFARI_ADVENTURER:
                            $statField = "destination_africa";
                            $reqAmt = 25;
                            break;

                        case self::SILVER_SAFARI_ADVENTURER:
                            $statField = "destination_africa";
                            $reqAmt = 50;
                            break;

                        case self::GOLD_SAFARI_ADVENTURER:
                            $statField = "destination_africa";
                            $reqAmt = 100;
                            break;

                        case self::BRONZE_TEMPLES_CONQUEROR:
                            $statField = "destination_asia";
                            $reqAmt = 25;
                            break;

                        case self::SILVER_TEMPLES_CONQUEROR:
                            $statField = "destination_asia";
                            $reqAmt = 50;
                            break;

                        case self::GOLD_TEMPLES_CONQUEROR:
                            $statField = "destination_asia";
                            $reqAmt = 100;
                            break;

                        case self::BRONZE_WANDERER_BUSINESSPERSON:
                            $statField = "business_class_bookings";
                            $reqAmt = 5;
                            break;

                        case self::SILVER_WANDERER_BUSINESSPERSON:
                            $statField = "business_class_bookings";
                            $reqAmt = 10;
                            break;

                        case self::GOLD_WANDERER_BUSINESSPERSON:
                            $statField = "business_class_bookings";
                            $reqAmt = 20;
                            break;

                        case self::CIRCUMNAVIGATION_TRAVELER:
                            $statField = "distance";
                            $reqAmt = 12742;
                            break;

                        case self::BRONZE_CLASSY_TRAVEL:
                            $statField = "first_class_bookings";
                            $reqAmt = 5;
                            break;

                        case self::SILVER_CLASSY_TRAVEL:
                            $statField = "first_class_bookings";
                            $reqAmt = 10;
                            break;

                        case self::GOLD_CLASSY_TRAVEL:
                            $statField = "first_class_bookings";
                            $reqAmt = 20;
                            break;

                        case self::BRONZE_COSTLY_TRAVEL_ITINERARY:
                            $statField = "expenses";
                            $reqAmt = 100000;
                            break;

                        case self::SILVER_COSTLY_TRAVEL_ITINERARY:
                            $statField = "expenses";
                            $reqAmt = 250000;
                            break;

                        case self::GOLD_COSTLY_TRAVEL_ITINERARY:
                            $statField = "expenses";
                            $reqAmt = 500000;
                            break;

                        case self::BRONZE_DEAD_END:
                            $statField = "deadend";
                            $reqAmt = 2;
                            break;

                        case self::SILVER_DEAD_END:
                            $statField = "deadend";
                            $reqAmt = 3;
                            break;

                        case self::GOLD_DEAD_END:
                            $statField = "deadend";
                            $reqAmt = 5;
                            break;

                        case self::BRONZE_FJORDS_CROSSER:
                            $statField = "destination_europe";
                            $reqAmt = 25;
                            break;

                        case self::SILVER_FJORDS_CROSSER:
                            $statField = "destination_europe";
                            $reqAmt = 50;
                            break;

                        case self::GOLD_FJORDS_CROSSER:
                            $statField = "destination_europe";
                            $reqAmt = 100;
                            break;

                        case self::MOON_LOVER:
                            $statField = "distance";
                            $reqAmt = 384000;
                            break;

                        case self::BRONZE_CANYON_TRAVELLER:
                            $statField = "destination_north_america";
                            $reqAmt = 25;
                            break;

                        case self::SILVER_CANYON_TRAVELLER:
                            $statField = "destination_north_america";
                            $reqAmt = 50;
                            break;

                        case self::GOLD_CANYON_TRAVELLER:
                            $statField = "destination_north_america";
                            $reqAmt = 100;
                            break;

                        case self::BRONZE_ARCHIPELAGO_SWIMMER:
                            $statField = "destination_oceania";
                            $reqAmt = 25;
                            break;

                        case self::SILVER_ARCHIPELAGO_SWIMMER:
                            $statField = "destination_oceania";
                            $reqAmt = 50;
                            break;

                        case self::GOLD_ARCHIPELAGO_SWIMMER:
                            $statField = "destination_oceania";
                            $reqAmt = 100;
                            break;

                        case self::ON_THE_OTHER_SIDE_OF_THE_WORLD:
                            $statField = "distance";
                            $reqAmt = 6371;
                            break;

                        case self::BRONZE_ECONOMIC_TRAVELER:
                            $statField = "economy_class_bookings";
                            $reqAmt = 25;
                            break;

                        case self::SILVER_ECONOMIC_TRAVELER:
                            $statField = "economy_class_bookings";
                            $reqAmt = 50;
                            break;

                        case self::GOLD_ECONOMIC_TRAVELER:
                            $statField = "economy_class_bookings";
                            $reqAmt = 100;
                            break;

                        case self::BRONZE_PERFECTIONIST:
                            $statField = "perfect_flights";
                            $reqAmt = 25;
                            break;

                        case self::SILVER_PERFECTIONIST:
                            $statField = "perfect_flights";
                            $reqAmt = 50;
                            break;

                        case self::GOLD_PERFECTIONIST:
                            $statField = "perfect_flights";
                            $reqAmt = 100;
                            break;

                        case self::QUARTER_OBLATE_SPHEROID:
                            $statField = "distance";
                            $reqAmt = 5;
                            break;

                        case self::BRONZE_GLACIER_MELTER:
                            $statField = "destination_south_america";
                            $reqAmt = 10;
                            break;

                        case self::SILVER_GLACIER_MELTER:
                            $statField = "destination_south_america";
                            $reqAmt = 15;
                            break;

                        case self::GOLD_GLACIER_MELTER:
                            $statField = "destination_south_america";
                            $reqAmt = 3186;
                            break;

                        case self::BRONZE_SOUTHERN_WATER_BENDER:
                            $statField = "destination_antarctica";
                            $reqAmt = 2;
                            break;

                        case self::SILVER_SOUTHERN_WATER_BENDER:
                            $statField = "destination_antarctica";
                            $reqAmt = 3;
                            break;

                        case self::GOLD_SOUTHERN_WATER_BENDER:
                            $statField = "destination_antarctica";
                            $reqAmt = 5;
                            break;
                    }
                    $statCheckerStr = "SELECT $statField FROM statistics WHERE id = '$userId'";
                    $achievementCheckStr = "SELECT a.achieved as achieved, ad.achieved_file as image, ad.name as name, ad.desc as description FROM achievements a LEFT JOIN achievements_desc ad ON a.achievement_id = ad.id WHERE a.user_id = '$userId' AND a.achievement_id = '".$achievement."'";
                    $achievementUpdateStr = "UPDATE achievements SET achieved = :num WHERE user_id = :userId AND achievement_id = '".$achievement."'";

                    $statChecker = self::static_database()->query($statCheckerStr)->fetch(PDO::FETCH_ASSOC)[$statField];
                    if (self::compareStatistic($reqAmt, $statChecker)) {
                        $achievementCheck = self::static_database()->query($achievementCheckStr)->fetch(PDO::FETCH_ASSOC);
                        if ($achievementCheck['achieved']==0) {
                            $achievementUpdate = self::static_database()->prepare($achievementUpdateStr);
                            $one = 1;
                            $achievementUpdate->bindParam(":num", $one, PDO::PARAM_INT);
                            $achievementUpdate->bindParam(":userId", $userId, PDO::PARAM_STR);
                            NotificationHandler::sendNotification($userId, $achievementCheck['name']. " achieved!", $achievementCheck['description'], '',$achievementCheck['image'],'achievements.php');
                            return $achievementUpdate->execute();
                        } else {
                            return true;
                        }
                    }
                } else {
                    return false;
                }
            } else {
                echo "Incomplete arguments";
                return false;
            }
        }

        private static function isProfileExists($userId) {
            if (isset($userId) && !empty($userId)) {
                $checkUser = self::static_database()->query("SELECT * FROM users WHERE id = '$userId'");
                if ($checkUser->rowCount() == 1) {
                    return true;
                } else {
                    echo "User not found";
                    return false;
                }
            } else {
                echo "Incomplete arguments!";
                return false;
            }
        }

        public static function getAchievements() {
            $refl = new ReflectionClass('AchievementHandler');
            return $refl->getConstants();
        }

        public static function getAllAchievementsFromDatabaseOfUser($userId) {
            $query = self::static_database()->query("SELECT * FROM achievements a INNER JOIN achievements_desc ad ON a.achievement_id = ad.id WHERE a.user_id = '$userId' ORDER BY a.achieved DESC, a.achievement_id ASC");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getAllAchievedAchievementsFromDatabaseOfUser($userId) {
            $query = self::static_database()->query("SELECT * FROM achievements a INNER JOIN achievements_desc ad ON a.achievement_id = ad.id WHERE a.user_id = '$userId' and a.achieved = 1 ORDER BY a.achievement_id ASC");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getFourMostAchievedAchievementsFromDatabaseOfUser($userId) {
            $query = self::static_database()->query("SELECT * FROM achievements a INNER JOIN achievements_desc ad ON a.achievement_id = ad.id WHERE a.user_id = '$userId' and a.achieved = 1 ORDER BY a.achievement_id ASC LIMIT 4 OFFSET 0");
            if ($query->rowCount()==0) {
                $query = self::static_database()->query("SELECT * FROM achievements a INNER JOIN achievements_desc ad ON a.achievement_id = ad.id WHERE a.user_id = '$userId' ORDER BY a.achievement_id ASC LIMIT 4 OFFSET 0");
            }
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getFiveMostAchievedAchievementsFromDatabaseOfUser($userId) {
            $query = self::static_database()->query("SELECT * FROM achievements a INNER JOIN achievements_desc ad ON a.achievement_id = ad.id WHERE a.user_id = '$userId' and a.achieved = 1 ORDER BY a.achievement_id ASC LIMIT 5 OFFSET 0");
            if ($query->rowCount()==0) {
                $query = self::static_database()->query("SELECT * FROM achievements a INNER JOIN achievements_desc ad ON a.achievement_id = ad.id WHERE a.user_id = '$userId' ORDER BY a.achievement_id ASC LIMIT 5 OFFSET 0");
            }
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>