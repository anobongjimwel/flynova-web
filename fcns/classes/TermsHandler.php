<?php
    class TermsHandler {
        use DatabaseOriented;

        public static function getPrivacyPolicy() {
            $query = self::static_database()->query("SELECT value FROM terms WHERE name = 'privacyPolicy'");
            return $query->fetch(PDO::FETCH_ASSOC)['value'];
        }

        public static function getTermsAndAgreements() {
            $query = self::static_database()->query("SELECT value FROM terms WHERE name = 'termsAndAgreements'");
            return $query->fetch(PDO::FETCH_ASSOC)['value'];
        }

        public static function updatePrivacyPolicy($htmlString) {
            $query = self::static_database()->prepare("UPDATE terms SET value = :value WHERE name = 'privacyPolicy'");
            $query->bindParam(":value", $htmlString, PDO::PARAM_STR);
            return $query->execute();
        }

        public static function updateTermsAndAgreements($htmlString) {
            $query = self::static_database()->prepare("UPDATE terms SET value = :value WHERE name = 'termsAndAgreements'");
            $query->bindParam(":value", $htmlString, PDO::PARAM_STR);
            return $query->execute();
        }

        public static function appendFrequentlyAskedQuestion($question, $answer){
            $query = self::static_database()->prepare("INSERT INTO faqs (question, answer) VALUES(:question, :answer)");
            $query->bindParam(":question", $question, PDO::PARAM_STR);
            $query->bindParam(":answer", $answer, PDO::PARAM_STR);
            return $query->execute();
        }

        public static function getFrequentlyAskedQuestions() {
            $query = self::static_database()->query("SELECT * FROM faqs");
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function deleteFrequentlyAskedQuestion($faqId) {
            $query = self::static_database()->prepare("DELETE FROM faqs WHERE id = :faqid");
            $query->bindParam(":faqid", $faqId, PDO::PARAM_INT);
            return $query->execute();
        }

        public static function checkIfQuestionExistsInFAQs($question) {
            $query = self::static_database()->query("SELECT * FROM faqs WHERE question = '$question'");
            if ($query->rowCount()>0) {
                return true;
            } else {
                return false;
            }
        }

        public static function updateFrequentlyAskedQuestion($id, $answer) {
            $query = self::static_database()->prepare("UPDATE faqs SET answer = :answer WHERE id = :id");
            $query->bindParam(":answer", $answer, PDO::PARAM_STR);
            $query->bindParam(":id", $id, PDO::PARAM_INT);
            return $query->execute();
        }
    }