<?php
    class SeatHandler {
        use DatabaseOriented;
        const A330FC = "A330FC";
        const AIR320 = "AIR320";
        const B737NG = "B737NG";
        const ECONOMY = "economy_class";
        const BUSINESS = "business_class";
        const FIRSTCLASS = "first_class";

        public static function identifySeat($seat, $carrier) {
            $dbq = self::static_database()->query("SELECT category FROM carrier_seats WHERE seatno = '$seat' AND carrier_id = '$carrier'");
            if ($dbq->rowCount()==1) {
                return $dbq->fetch(PDO::FETCH_ASSOC)['category'];
            } else {
                return false;
            }
        }

        public static function reiterateSeatsToString($seatArray) {
            $arrayCtr = count($seatArray);
            $seatingString = "";
            $ctr = 0;
            foreach ($seatArray as $item) {
                $seatingString.=$item;
                if ($ctr!=$arrayCtr-1) {
                    $seatingString.=", ";
                }
                $ctr+=1;
            }
            return $seatingString;
        }
    }
?>