<?php
    class CarrierHandler {
        use DatabaseOriented;

        public static function identifyCarrier($carrier_code) {
            $dbq = self::static_database()->query("SELECT * FROM carrier WHERE id = '$carrier_code'");
            if ($dbq->rowCount()==1) {
                return $dbq->fetch(PDO::FETCH_ASSOC)['name'];
            } else {
                return false;
            }
        }
    }
?>