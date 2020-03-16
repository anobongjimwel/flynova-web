<?php
    class PaymentHandler {
        const VISA = "visa";
        const MASTERCARD = "mastercard";
        const AMEX = "amex";
        const DISCOVER = "discover";
        const CVV = "cvv";
        const cardType = "cardType";

        public static function generateCardNumber($cardType) {
            switch ($cardType) {
                case PaymentHandler::VISA:
                    $cardNumber = "4".PaymentHandler::generateNumbers(15);
                    return $cardNumber;
                    break;

                case PaymentHandler::MASTERCARD:
                    $cardNumber = "5".PaymentHandler::generateNumbers(15);
                    return $cardNumber;
                    break;

                case PaymentHandler::AMEX:
                    $cardNumber = "37".PaymentHandler::generateNumbers(14);
                    return $cardNumber;
                    break;

                case PaymentHandler::DISCOVER:
                    $cardNumber = "6".PaymentHandler::generateNumbers(15);
                    return $cardNumber;
                    break;

                default:
                    return false;
                    break;
            }
        }

        public static function generateCVV($cardType) {
            switch ($cardType) {
                case PaymentHandler::MASTERCARD:
                case PaymentHandler::VISA:
                case PaymentHandler::DISCOVER:
                    return self::generateNumbers(3);
                    break;

                case PaymentHandler::AMEX:
                    return self::generateNumbers(4);
                    break;

                default:
                    return false;
                    breaK;
            }
        }

        public static function generateExpiryDate($currentMonth, $currentDay ,$currentYear) {
            if (is_numeric($currentMonth) && is_numeric($currentYear) && is_numeric($currentDay)) {
                try {
                    $date = new DateTime($currentYear . "-" . $currentMonth . "-" . $currentDay);
                    $date->add(new DateInterval('P5Y'));
                    return $date->format("m/y");
                } catch (Exception $e) {
                    echo $e->getMessage();
                    return false;
                }
            } else {
                return false;
            }
        }

        public static function compare($type, $strA, $strB) {
            switch ($type) {
                case self::cardType:
                    return $strA === $strB;
                    break;

                case self::CVV:
                    return $strA === $strB;
                    break;

                default:
                    return false;
                    break;
            }
        }

        public static function identifyCard($cardNumber) {
            if (mb_strlen($cardNumber)==16) {
                if (substr($cardNumber,0,2)=="37") {
                    return self::AMEX;
                } else {
                    switch (substr($cardNumber,0,1)) {
                        case "4":
                            return self::VISA;
                            break;

                        case "5":
                            return self::MASTERCARD;
                            break;

                        case "6":
                            return self::DISCOVER;
                            break;

                        default:
                            return false;
                            break;
                    }
                }
            } else {
                return false;
            }
        }

        public static function addDashes($cardNumber) {
            if (strlen($cardNumber)==16) {
                return substr($cardNumber,0,4)."-".substr($cardNumber,4,4)."-".substr($cardNumber,8,4)."-".substr($cardNumber,12,4);
            }
        }

        private static function generateNumbers($amountOfNumber) {
            $numbers = "";
            for ($i = 1; $i <= $amountOfNumber; $i++) {
                $numbers .= rand(0, 9);
            }
            return $numbers;
        }
    }
?>