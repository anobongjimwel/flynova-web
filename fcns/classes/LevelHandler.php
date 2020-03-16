<?php
    require_once "BookingHandler.php";

    class LevelHandler {
         use DatabaseOriented;
         const LEVEL_PERCENTAGE = 'percentage';
         const LEVEL_NUMERICAL = 'numerical';

         public static function identifyLevelRange($currentLevel)
         {
             if (is_numeric($currentLevel)) {
                 $query = self::static_database()->query("SELECT * FROM levels WHERE min <= $currentLevel AND max >= $currentLevel ");
                 if ($query->rowCount()==0) {
                     $query = self::static_database()->query("SELECT * FROM levels WHERE level = 200 ");
                 }
                 return $query->fetch(PDO::FETCH_ASSOC);
             }
         }

         public static function getUserXP($id) {
             $query = self::static_database()->query("SELECT xp FROM users WHERE id = '$id'");
             return $query->fetch(PDO::FETCH_ASSOC)['xp'];
         }

         public static function showShortenedXPCtr($xp) {
             if ($xp<1000) {
                 return (string) $xp;
             } else if ($xp<1000000) {
                 return number_format($xp / 1000,2) ."k";
             } else if ($xp<1000000000) {
                 return number_format($xp / 1000000,2) ."M";
             } else if ($xp<1000000000000) {
                 return number_format($xp / 1000000000,2) ."B";
             } else if ($xp<1000000000000000) {
                 return number_format($xp / 1000000000000,2) ."T";
             } else {
                 return (int) $xp / 1000000000000 ."Qd";
             }
         }

         public static function getLevelInterval($min, $max) {
            if (is_numeric($min) && is_numeric($max) && $min < $max) {
                return $max-$min;
            } else {
                return false;
            }
         }

         public static function getCurrentBaseLevel($min, $curr, $max, $returnType) {
             if (is_numeric($min) && is_numeric($max) && is_numeric($curr) && $min < $max  && $min <= $curr) {
                 if ($min != 0) {
                     $newMax = $max - $min;
                     $newCurr = $curr - $min;
                 } else {
                     $newMax = $max;
                     $newCurr = $curr;
                 }
                 switch ($returnType) {
                     case self::LEVEL_NUMERICAL:
                         return $newCurr;
                         break;

                     case self::LEVEL_PERCENTAGE:
                         return $curr / $max * 100;
                         break;
                 }
             } else {
                 switch ($returnType) {
                     case self::LEVEL_NUMERICAL:
                         return $curr;
                         break;

                     case self::LEVEL_PERCENTAGE:
                         if ($curr==0) {
                             return 0;
                         } else {
                             return 100;
                         }
                         break;
                 }
             }
         }

         public static function setBookingXp($bookingSession, $xp) {
             if (BookingHandler::checkBooking($bookingSession)) {
                  if (is_numeric($xp)) {
                      $q = self::static_database()->prepare("UPDATE booking_simulations SET xp = :xp WHERE id = :id");
                      $q->bindParam(":xp", $xp, PDO::PARAM_INT);
                      $q->bindParam(":id", $bookingSession, PDO::PARAM_STR);
                      $q->execute();
                      return true;
                  } else {
                      return false;
                  }
             } else {
                return false;
             }
         }

        public static function subtractBookingXp($bookingSession, $xp) {
            if (BookingHandler::checkBooking($bookingSession)) {
                if (is_numeric($xp)) {
                    $q = self::static_database()->prepare("UPDATE booking_simulations SET xp = xp - :xp WHERE id = :id");
                    $q->bindParam(":xp", $xp, PDO::PARAM_INT);
                    $q->bindParam(":id", $bookingSession, PDO::PARAM_STR);
                    $q->execute();
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public static function getBookingXP($bookingSession, $userId) {
            if (BookingHandler::checkBooking($bookingSession)) {
                $q = self::static_database()->query("SELECT xp FROM booking_simulations WHERE id = '$bookingSession' AND userID = '$userId'");
                return $q->fetch(PDO::FETCH_ASSOC)['xp'];
            } else {
                return false;
            }
        }

        public static function augmentUserXp($userId, $xp) {
             $user = self::static_database()->query("SELECT * FROM users WHERE id = '$userId'");
             if ($user->rowCount()==1) {
                 $update = self::static_database()->prepare("UPDATE users SET xp = xp + :xp WHERE id = :id");
                 $update->bindParam(":xp", $xp, PDO::PARAM_INT);
                 $update->bindParam(":id", $userId, PDO::PARAM_STR);
                 $update->execute();
                 return true;
             } else {
                 return false;
             }
        }
    }
?>