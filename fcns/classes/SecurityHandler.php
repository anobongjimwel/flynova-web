<?php
    require_once "Randomizer.php";
    require_once "AchievementHandler.php";

    class SecurityHandler {
        use DatabaseOriented;

        public static function login($username, $password) {
            if (self::checkUser($username, $password)) {
                $_SESSION['username'] = $username;
                return $username;
            } else {
                return false;
            }
        }

        public static function register($name, $username, $password, $nickname, $email, $country) {
            $userRegistor = self::static_database()->prepare("INSERT INTO users (id, username, password, email, full_name, country, nickname) VALUES (:id, :username, :password, :email, :name, :country, :nickname)");
            $twelveKeyId = "";
            while (true) {
                $twelveKeyId = Randomizer::generate(12);
                if (self::static_database()->query("SELECT id FROM users WHERE id = '".$twelveKeyId."'")->rowCount()==0) {
                    break;
                }
            }
            $userRegistor->bindParam(":id",$twelveKeyId, PDO::PARAM_STR);
            $userRegistor->bindParam(":name",$name, PDO::PARAM_STR);
            $userRegistor->bindParam(":username",$username, PDO::PARAM_STR);
            $hashedPassword = hash("sha512", $password);
            $userRegistor->bindParam(":password",$hashedPassword, PDO::PARAM_STR);
            $userRegistor->bindParam(":nickname",$nickname, PDO::PARAM_STR);
            $userRegistor->bindParam(":email",$email, PDO::PARAM_STR);
            $userRegistor->bindParam(":country",$country, PDO::PARAM_INT);
            if  ($userRegistor->execute()) {
                /*$ addAchievements = self::static_database()->prepare("INSERT INTO achievements (user_id, achievement_id) SELECT '$twelveKeyId' as userid, achievement_id FROM achievements_desc");
                $addAchievements->execute(); */
                // TODO reconsider using INSERT INTO SELECT for a more efficient adding experience
                $achievementsAppend = true;
                foreach (AchievementHandler::getAchievements() as $achievementName => $achievementCode) {
                    $addAchievements = self::static_database()->prepare("INSERT INTO achievements (user_id, achievement_id) VALUES (:userid, :achievementid)");
                    $addAchievements->bindParam(":userid", $twelveKeyId, PDO::PARAM_STR);
                    $addAchievements->bindParam(":achievementid", $achievementCode, PDO::PARAM_STR);
                    if ($addAchievements->execute()) {
                    } else {
                        $achievementsAppend = false;
                    }
                }
                if ($achievementsAppend) {
                    $addStatistics = self::static_database()->prepare("INSERT INTO statistics (id) VALUES (:userid)");
                    $addStatistics->bindParam(":userid", $twelveKeyId, PDO::PARAM_STR);
                    if ($addStatistics->execute()) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }

        private static function checkUser($username, $password) {
            $hashedPassword = hash("sha512", $password);
            $userFinder = self::static_database()->query("SELECT * FROM users WHERE username = '$username' AND password = '$hashedPassword'");
            if ($userFinder->rowCount()<1) {
                return false;
            } else {
                return true;
            }
        }

        public static function checkEmail($email) {
            $userFinder = self::static_database()->query("SELECT * FROM users WHERE email = '$email'");
            if ($userFinder->rowCount()<1) {
                return false;
            } else {
                return true;
            }
        }

        public static function checkUsername($username) {
            $userFinder = self::static_database()->query("SELECT * FROM users WHERE username = '$username'");
            if ($userFinder->rowCount()<1) {
                return false;
            } else {
                return true;
            }
        }

        public static function logout() {
            try {
                if (isset ($_SESSION['current_booking_simulation'])) {
                    unset($_SESSION['current_booking_simulation']);
                }
                unset($_SESSION['username']);
            } catch (Exception $e) {
                return false;
            } finally {
                return true;
            }
        }
    }