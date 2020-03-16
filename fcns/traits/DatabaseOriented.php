<?php
    trait DatabaseOriented {
        private static function static_database() {
            $username = "root";
            $password = "";
            $destination = "mysql:host=localhost;dbname=flynova";
            $pdo = new PDO($destination, $username, $password);
            $pdo->exec("set names utf8");
            return $pdo;
        }

        private function database() {
            $username = "root";
            $password = "";
            $destination = "mysql:host=localhost;dbname=flynova";
            $pdo = new PDO($destination, $username, $password);
            $pdo->exec("set names utf8");
            return $pdo;
        }
    }
?>