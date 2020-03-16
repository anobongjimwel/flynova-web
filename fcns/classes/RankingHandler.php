<?php

    class RankingHandler {
        use DatabaseOriented;

        public static function ordinal($number) {
            $ends = array('th','st','nd','rd','th','th','th','th','th','th');
            if ((($number % 100) >= 11) && (($number%100) <= 13))
                return $number. 'th';
            else
                return $number. $ends[$number % 10];
        }

        public static function getGlobalRanking($limit = '', $offset = '') {
            $limitingStr = ($limit!=""?" LIMIT $limit":"") . ($offset!=""?" OFFSET $offset":"");
            $query = self::static_database()->query("SELECT * FROM (SELECT users.id, users.username, users.full_name, users.xp, nationalities.country, @curRank := @curRank + 1 as rank FROM users LEFT JOIN nationalities ON users.country = nationalities.id, (SELECT @curRank := 0 rankStart) ranker ORDER BY xp desc) source" . $limitingStr);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getNewestUsers($limit = '', $offset = '') {
            $limitingStr = ($limit!=""?" LIMIT $limit":"") . ($offset!=""?" OFFSET $offset":"");
            $query = self::static_database()->query("SELECT * FROM users ORDER BY registerDate" . $limitingStr);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getSearchedUsers($q, $limit = '', $offset = '') {
            $limitingStr = ($limit!=""?" LIMIT $limit":"") . ($offset!=""?" OFFSET $offset":"");
            $query = self::static_database()->query("SELECT * FROM users WHERE username LIKE '%$q%' OR full_name LIKE '%$q%'" . $limitingStr);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getCountryRanking($countryCode, $limit = '', $offset = '') {
            $limitingStr = ($limit!=""?" LIMIT $limit":"") . ($offset!=""?" OFFSET $offset":"");
            $query = self::static_database()->query("SELECT * FROM (SELECT users.id, users.username, users.full_name, users.xp, nationalities.country, @curRank := @curRank + 1 as rank FROM users LEFT JOIN nationalities ON users.country = nationalities.id, (SELECT @curRank := 0 rankStart) ranker WHERE users.country = $countryCode ORDER BY xp desc) source" . $limitingStr);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getTopCountriesWithUsers($limit = '', $offset = '') {
            $limitingStr = ($limit!=""?" LIMIT $limit":"") . ($offset!=""?" OFFSET $offset":"");
            $query = self::static_database()->query("SELECT shortCode, count(users.country) as ctr FROM nationalities LEFT JOIN users ON nationalities.id = users.country GROUP BY nationalities.id ORDER BY count(users.country) desc, shortCode desc" . $limitingStr);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getAccumulatedUsersFromMonth($month, $year, $date) {
            $query = self::static_database()->query("SELECT * FROM users WHERE registerDate < '$year-$month-$date'");
            return $query->rowCount();
        }

        public static function getOverallAccumulatedUsers() {
            $query = self::static_database()->query("SELECT * FROM users");
            return $query->rowCount();
        }

        public static function getAccumulatedRegisteredForTheMonth($month, $year) {
            $query = self::static_database()->query("SELECT * FROM users WHERE month(registerDate) = $month AND year(registerDate) = $year");
            return $query->rowCount();
        }

        public static function getAmongColleaguesRanking($userId, $limit = '', $offset = '') {
            if (ProfileHandler::doesExistsById($userId)) {
            $limitingStr = ($limit!=""?" LIMIT $limit":"") . ($offset!=""?" OFFSET $offset":"");
            $query = self::static_database()->query(
                "SELECT * FROM (SELECT users.id, users.full_name, users.username, users.xp, nationalities.country, @curRank := @curRank+1 as rank
                                FROM users
                                  RIGHT JOIN
                                  (SELECT sender as id FROM colleagues WHERE reciever = '$userId' AND status = 'accepted'
                                    UNION
                                      SELECT reciever as id FROM colleagues WHERE sender = '$userId' AND status = 'accepted'
                                    UNION
                                      SELECT @myself := '$userId' as id) colleaguesToBeRanked ON colleaguesToBeRanked.id = users.id
                                  LEFT JOIN nationalities ON users.country = nationalities.id,
                                  (SELECT @curRank := 0 rankStart) ranker
                                  ORDER BY users.xp DESC) source ORDER BY rank ASC"
                    . $limitingStr
                );
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public static function getUserProximityInGlobalRanking($rankNumber, $rankFlooring = 2, $rankCeiling = 2) {
            $query = self::static_database()->query(
                "SELECT * FROM (
                  SELECT users.id, users.full_name, users.username, users.xp, nationalities.country, @curRank := @curRank + 1 AS rank
                  FROM users
                    LEFT JOIN nationalities ON users.country = nationalities.id,
                    (SELECT @curRank := 0) ranker
                  ORDER BY xp DESC
                ) as source
                WHERE rank >= $rankNumber-$rankFlooring AND rank <= $rankNumber+$rankCeiling
                "
            );
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getUserPositionInGlobalRanking($userId) {
            if (ProfileHandler::doesExistsById($userId)) {
                $query = self::static_database()->query(
                    "SELECT rank FROM (
                          SELECT *
                          FROM (
                                 SELECT
                                    users.id,
                                   @curRank := @curRank + 1 AS rank
                                 FROM users,
                                   (SELECT @curRank := 0 rankStart) ranker
                                 ORDER BY xp DESC
                               ) AS rank2
                        ) rank3 WHERE id = '$userId'"
                );
                return $query->fetch(PDO::FETCH_ASSOC)['rank'];
            } else {
                return false;
            }
        }

        public static function getUserProximityInCountryRanking($rankNumber, $userId, $country, $rankFlooring = 2, $rankCeiling = 2) {
            $query = self::static_database()->query(
                "SELECT *
                    FROM 
                      (SELECT
                         users.id,
                         users.username,
                         users.full_name,
                         users.xp,
                         nationalities.country,
                         @curRank := @curRank + 1 as rank
                       FROM users
                         LEFT JOIN nationalities ON users.country = nationalities.id, 
                         (SELECT @curRank := 0 rankStart) ranker
                       WHERE users.country = $country ORDER BY xp desc) source
                    WHERE source.rank <= $rankNumber+$rankFlooring AND source.rank >= $rankNumber-$rankCeiling
                    "
            );
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getUserPositionInCountryRanking($userId, $countryCode) {
            if (ProfileHandler::doesExistsById($userId)) {
                $query = self::static_database()->query(
                    "SELECT rank FROM (
                          SELECT *
                          FROM (
                                 SELECT users.id, @curRank := @curRank + 1 AS rank
                                 FROM users,
                                   (SELECT @curRank := 0 rankStart) ranker
                                 WHERE users.country = $countryCode
                                 ORDER BY xp DESC) source
                        ) rank2
                        WHERE id = '$userId'"
                );
                return $query->fetch(PDO::FETCH_ASSOC)['rank'];
            } else {
                return false;
            }
        }

        public static function getUserProximityInColleagues($rankNumber, $userId, $country, $rankFlooring = 2, $rankCeiling = 2) {
            $query = self::static_database()->query(
                "SELECT * FROM (
                      SELECT *
                      FROM (SELECT
                              users.id,
                              users.full_name,
                              users.username,
                              users.xp,
                              nationalities.country,
                              @curRank := @curRank + 1 AS rank
                            FROM users
                              RIGHT JOIN
                              (SELECT sender AS id
                               FROM colleagues
                               WHERE reciever = '$userId' AND status = 'accepted'
                               UNION
                               SELECT reciever AS id
                               FROM colleagues
                               WHERE sender = '$userId' AND status = 'accepted'
                               UNION
                               SELECT @myself := '$userId' AS id) colleaguesToBeRanked ON colleaguesToBeRanked.id = users.id
                              LEFT JOIN nationalities ON users.country = nationalities.id,
                              (SELECT @curRank := 0 rankStart) ranker
                            ORDER BY users.xp DESC) source
                    ) source2 WHERE rank <= $rankNumber+$rankCeiling AND rank >= $rankNumber-$rankFlooring
                    ORDER BY rank ASC
                    "
            );
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function getUserPositionInColleagues($userId) {
            if (ProfileHandler::doesExistsById($userId)) {
                $query = self::static_database()->query(
                    "SELECT rank FROM (
SELECT * FROM (SELECT users.id, @curRank := @curRank+1 as rank
                                FROM users
                                  RIGHT JOIN
                                  (SELECT sender as id FROM colleagues WHERE reciever = '$userId' AND status = 'accepted'
                                    UNION
                                      SELECT reciever as id FROM colleagues WHERE sender = '$userId' AND status = 'accepted'
                                    UNION
                                      SELECT @myself := '$userId' as id) colleaguesToBeRanked ON colleaguesToBeRanked.id = users.id,
                                  (SELECT @curRank := 0 rankStart) ranker
                                  ORDER BY users.xp DESC) source
) source2
WHERE id = '$userId'"
                );
                return $query->fetch(PDO::FETCH_ASSOC)['rank'];
            } else {
                return false;
            }
        }
    }