<?php

namespace App\Config;

use PDO;
use PDOException;

class Database
{
    private const DB_SERVERNAME = "localhost";
    private const DB_USERNAME = "root";
    private const DB_PASSWORD = "";
    private const DB_NAME = "oasis";
    public static PDO $PDO;

    public function __construct()
    {
        try {
            $DB_SERVERNAME = self::DB_SERVERNAME;
            $DB_NAME       = self::DB_NAME;
            self::$PDO     = new PDO("mysql:host=$DB_SERVERNAME;dbname=$DB_NAME", self::DB_USERNAME, self::DB_PASSWORD);
            self::$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection failed" . $exception->getMessage();
            die();
        }
    }
}