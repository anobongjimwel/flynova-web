<?php
    class Randomizer
    {
        public static function generate($numberOfBytes)
        {
            $alphaNum = 'A1aBbCcD2dEeF3f4G5gHhIiJjKkLlMm6N7nOoPpQqRrS8sTtUuVv9WwXxY0yZz';
            $string = "";
            if ($numberOfBytes>2) {
                for ($i = 0; $i < $numberOfBytes; $i++) {
                    $string.=$alphaNum[rand(0, strlen($alphaNum)-1)];
                }
                return $string;
            } else {
                return false;
            }
        }
    }
?>