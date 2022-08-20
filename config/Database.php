<?php

namespace App\Config;

use PDO;

class Database
{
    public        $PDO;
    public string $username   = "root";
    public string $password   = "";
    public string $selverName = "localhost";
    public string $dbName     = "oasis";

    public function __construct()
    {
        try {
            $this->PDO = new PDO("mysql:host=$this->selverName;dbname=$this->dbName;", $this->username, $this->password);
            $this->PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $exception) {
            echo "Database Connection Failed: " . $exception->getMessage();
            exit;
        }
    }

    public static function PDO(): PDO
    {
        return self::$PDO;
    }
}