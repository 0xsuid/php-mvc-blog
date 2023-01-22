<?php

namespace Harsh\Blog\Helper;

use PDO;
use PDOException;

class DatabaseConnection
{
    private static $dbInstance = null;
    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        // Check if database instance is null
        if (self::$dbInstance == null) {
            try {
                $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
                self::$dbInstance = new PDO($dsn, DB_USER, DB_PASS);
                // set the PDO error mode to exception
                self::$dbInstance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$dbInstance;
    }
}
