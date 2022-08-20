<?php

namespace App\Config;

abstract class Model extends BaseModel
{
    private static string $orderBy = '';
    private static string $where   = '';
    private static string $orWhere = '';

    public static function create(array $data)
    {
        // TODO: Implement create() method.
    }

    public static function TableName(): string
    {
        return Str::snake(basename(static::class));
    }

    public static function orderBy(string $column, string $orderBy = 'asc'): static
    {
        self::$orderBy = self::ORDER_BY . "$column $orderBy ";
        return new static();
    }

    public static function where($column, $where): static
    {
        self::$where = self::WHERE . "$column = '$where' ";
        return new static();
    }


    public static function get(): bool|array
    {
        $table     = static::TableName();
        $statement = static::query(self::SELECT . self::STAR . self::FROM . $table . " " . self::$where . self::$orWhere . self::$orderBy);
        dd($statement);
        exit();
        $statement->execute();
        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    private static function query($query): bool|\PDOStatement
    {
        return Application::$app::$database::$PDO->prepare($query);
    }


    public static function first()
    {
        $table     = static::TableName();
        $statement = static::query(self::SELECT . self::STAR . self::FROM . $table . " " . self::$where . self::$orderBy);
        $statement->execute();
        return $statement->fetch(\PDO::FETCH_OBJ);
    }


    public static function __callStatic(string $method, array $arguments)
    {
        if (method_exists(self::class, $method)) {
            return call_user_func_array([self::class, $method], $arguments);
        }
    }

    public static function orWhere(array $wheres = []): static
    {
        if (!empty($wheres)) {
            $query = "WHERE " . self::AND;
            foreach ($wheres as $key => $where) {
                $query .= "$key = '$where'";
            }
            self::$orWhere = $query;
        }
        return new static();
    }

}


