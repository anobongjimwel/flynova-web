<?php

class StatisticsHandler {
    use DatabaseOriented;

    public static function getProfileStatisticalData($userId) {
        $query = self::static_database()->query("SELECT * FROM statistics WHERE id = '$userId'");
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public static function appendProfileStatistics($userId, $statName, $addend) {
        if (is_numeric($addend) && self::static_database()->query("SELECT * FROM users WHERE id = '$userId'")->rowCount()>0) {
            $query = self::static_database()->prepare("UPDATE statistics SET $statName = $statName + :addend WHERE id = :id");
            $query->bindParam(":addend", $addend, PDO::PARAM_INT);
            $query->bindParam(":id", $userId, PDO::PARAM_STR);
            return $query->execute();
        }
    }

    public static function showShortenedValue($value) {
        if ($value<1000) {
            return (string) $value;
        } else if ($value<1000000) {
            return number_format($value / 1000,2) ."k";
        } else if ($value<1000000000) {
            return number_format($value / 1000000,2) ."M";
        } else if ($value<1000000000000) {
            return number_format($value / 1000000000,2) ."B";
        } else if ($value<1000000000000000) {
            return number_format($value / 1000000000000,2) ."T";
        } else {
            return (int) $value / 1000000000000 ."Qd";
        }
    }
}
