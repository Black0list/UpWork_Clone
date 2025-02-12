<?php

namespace App\config;

use PDO;
use PDOException;

class Database {
    private static string $servername = "localhost";
    private static string $username = "postgres";
    private static string $password = "abir2016.";
    private static string $dbname = "mvc_database";
    private static $connection;
    private static $instance;


    private function __construct(){
        if (!self::$connection) {
            try {
                self::$connection = new PDO(
                    "pgsql:host=" . self::$servername .
                    ";dbname=" . self::$dbname,
                    self::$username,
                    self::$password
                );
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }

    }

    public static function getInstance(): Database {
        if(!self::$instance){
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function getConnection(): PDO{
        return self::$connection;
    }
}