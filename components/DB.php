<?php
    class DB
    {
        public static function getConnection()
        {
            $charset = "utf8";
            $paramsPath = ROOT . '/config/db_params.php';
            $params = include($paramsPath);
            $dsn = "mysql:host={$params['host']};dbname={$params['dbname']};charset=$charset";
            $db = new PDO($dsn, $params['user'], $params['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            return $db;
        }
    }
