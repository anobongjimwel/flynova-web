<?php
    require_once "ProfileHandler.php";
    class ColleagueRelationsHandler {
        use DatabaseOriented;
        const STATUS_ACCEPTED = 'accepted';
        const STATUS_DECLINE = 'decline';
        const STATUS_REQUESTED = 'requested';

        public static function requestColleagueRelationship($userSender, $userReciever) {
            $idSender = ProfileHandler::getProfile($userSender, ProfileHandler::PROFILE_USERNAME)['id'];
            $idReciever = ProfileHandler::getProfile($userReciever, ProfileHandler::PROFILE_USERNAME)['id'];
            if (ProfileHandler::doesExistsById($idSender)) {
                if (ProfileHandler::doesExistsById($idReciever)) {
                    $requestColleagueRelationshipQry = self::static_database()->prepare("INSERT INTO colleagues (sender, reciever) VALUES (:sender, :reciever)");
                    $requestColleagueRelationshipQry->bindParam(":sender", $idSender, PDO::PARAM_STR);
                    $requestColleagueRelationshipQry->bindParam(":reciever", $idReciever, PDO::PARAM_STR);
                    if ($requestColleagueRelationshipQry->execute()) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public static function doesColleagueRelationshipExists($userSender, $userReciever) {
            $idSender = ProfileHandler::getProfile($userSender, ProfileHandler::PROFILE_USERNAME)['id'];
            $idReciever = ProfileHandler::getProfile($userReciever, ProfileHandler::PROFILE_USERNAME)['id'];
            if (ProfileHandler::doesExistsById(ProfileHandler::getProfile($userSender, ProfileHandler::PROFILE_USERNAME)['id'])) {
                if (ProfileHandler::doesExistsById(ProfileHandler::getProfile($userReciever, ProfileHandler::PROFILE_USERNAME)['id'])) {
                    $query = self::static_database()->query("SELECT * FROM colleagues WHERE (sender = '$idSender' AND reciever = '$idReciever') OR (sender = '$idReciever' AND reciever = '$idSender')");
                    if ($query->rowCount()>0) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public static function updateColleagueRelationship($userSender, $userReciever, $status) {
            $idSender = ProfileHandler::getProfile($userSender, ProfileHandler::PROFILE_USERNAME)['id'];
            $idReciever = ProfileHandler::getProfile($userReciever, ProfileHandler::PROFILE_USERNAME)['id'];
            if (self::doesColleagueRelationshipExists($userSender, $userReciever)) {
                switch ($status) {
                    case self::STATUS_ACCEPTED:
                        $query = self::static_database()->prepare("UPDATE colleagues SET status = '$status' WHERE sender = :sender AND reciever = :reciever");
                        $query->bindParam(":sender", $idSender, PDO::PARAM_STR);
                        $query->bindParam(":reciever", $idReciever, PDO::PARAM_STR);
                        if ($query->execute()) {
                            return true;
                        } else {
                            return false;
                        }
                        break;

                    case self::STATUS_DECLINE:
                        $query = self::static_database()->query("DELETE FROM colleagues WHERE (sender = '$idSender' AND reciever = '$idReciever') OR (reciever = '$idSender' AND sender = '$idReciever')");
                        return true;
                        break;

                    default:
                        return false;
                        break;
                }

            } else {
                return false;
            }
        }

        public static function identifyPositionOnRelationship($userToBeIdentified, $oppositeUser) {
            $idToBeIdentified = ProfileHandler::getProfile($userToBeIdentified, ProfileHandler::PROFILE_USERNAME)['id'];
            $oppositeId = ProfileHandler::getProfile($userToBeIdentified, ProfileHandler::PROFILE_USERNAME)['id'];
            if (self::doesColleagueRelationshipExists($oppositeUser, $userToBeIdentified)) {
                $query = self::static_database()->query("SELECT * FROM colleagues WHERE (sender = '$idToBeIdentified' OR reciever = '$oppositeId') AND (sender = '$oppositeId' OR reciever = '$idToBeIdentified') LIMIT 1")->fetch(PDO::FETCH_ASSOC)['sender'];
                if ($query==$idToBeIdentified) {
                    return "sender";
                } else {
                    return "reciever";
                }
            } else {
                return false;
            }
        }

        public static function identifyRelationshipStatus($userSender, $userReciever) {
            $idSender = ProfileHandler::getProfile($userSender, ProfileHandler::PROFILE_USERNAME)['id'];
            $idReciever = ProfileHandler::getProfile($userReciever, ProfileHandler::PROFILE_USERNAME)['id'];
            if (ProfileHandler::doesExistsById($idSender)) {
                if (ProfileHandler::doesExistsById($idReciever)) {
                    $requestColleagueRelationshipQry = self::static_database()->query("SELECT * FROM colleagues WHERE (sender = '$idSender' AND reciever = '$idReciever') OR (sender = '$idReciever' AND reciever = '$idSender') LIMIT 1")->fetch(PDO::FETCH_ASSOC);
                    return $requestColleagueRelationshipQry['status'];
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public static function gatherColleaguesOfUser($username) {
            $id = ProfileHandler::getProfile($username, ProfileHandler::PROFILE_USERNAME)['id'];
            if (ProfileHandler::doesExistsById($id)) {
                $query = self::static_database()->query("SELECT colleagues.id, users.username as username, users.email as email, users.full_name as full_name, users.xp as xp, users.nickname as nickname, users.country as country_id, nationalities.country as country FROM (SELECT sender as id FROM colleagues WHERE reciever = '$id' AND status = 'accepted'
                                                        UNION
                                                       SELECT reciever as id FROM colleagues WHERE sender = '$id' AND status = 'accepted') as colleagues LEFT JOIN users on colleagues.id = users.id LEFT JOIN nationalities ON users.country = nationalities.id ORDER BY full_name DESC");
                return $query->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        public static function gatherColleaguesOfUserCtr($username) {
            $id = ProfileHandler::getProfile($username, ProfileHandler::PROFILE_USERNAME)['id'];
            if (ProfileHandler::doesExistsById($id)) {
                $query = self::static_database()->query("SELECT colleagues.id, users.username as username, users.email as email, users.full_name as full_name, users.xp as xp, users.nickname as nickname, users.country as country_id, nationalities.country as country FROM (SELECT sender as id FROM colleagues WHERE reciever = '$id' AND status = 'accepted'
                                                        UNION
                                                       SELECT reciever as id FROM colleagues WHERE sender = '$id' AND status = 'accepted') as colleagues LEFT JOIN users on colleagues.id = users.id LEFT JOIN nationalities ON users.country = nationalities.id ORDER BY full_name DESC");
                return $query->rowCount();
            } else {
                return false;
            }
        }
    }