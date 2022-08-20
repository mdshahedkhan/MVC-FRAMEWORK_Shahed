<?php

namespace App\Config;

use JetBrains\PhpStorm\NoReturn;

class Schema
{
    private static string $query     = "";
    private static string $dropQuery = '';

    public static function create(string $table, callable $callable): void
    {
        self::$query = $table;
    }

    /**
     * @param string $tableName
     * @return void
     */
    public static function dropIfExists(string $tableName): void
    {
        self::$dropQuery = "DROP TABLE $tableName";
    }


    public static function runQuery(): void
    {
        $statement = Application::$app->database->PDO;
        $statement->exec("CREATE TABLE users");
    }

    public static function __callStatic(string $name, array $arguments)
    {
        if (method_exists(self::class, $name)) {
            return call_user_func_array([Schema::class, $name], $arguments);
        }
    }


}