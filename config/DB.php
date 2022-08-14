<?php

namespace App\Config;

class DB
{
    private const SELECT = 'SELECT ', STAR = "* ", FROM = "FROM ", DELETE = 'DELETE', WHERE = 'WHERE ', UPDATE = 'UPDATE ', ORDER_BY = "ORDER BY ";
    private static string $tableName;
    private static string $orderBy                   = '';
    private static string $QueryStringTable;
    private static string $QueryStringExecuted;
    private static string $QueryStringWhereStatement = '';
    public static string  $SelectQuery               = '';
    private static bool   $SelectFuncIsCalled        = false;
    private static bool   $whereIsFuncCalled         = false;

    public function __call(string $name, array $arguments)
    {
        if (method_exists(__CLASS__, $name)) {
            return call_user_func_array([__CLASS__, $name], $arguments);
        }
        return "Call to non-static method: $name";
    }

    public static function table(string $table): DB
    {
        self::$QueryStringTable = self::SELECT . self::STAR . self::FROM . "`$table`";
        self::$tableName        = $table;
        return new static();
    }

    public function where(...$wheres): DB
    {
        $whereStatement = "";
        foreach ($wheres[0] as $key => $where) {
            $whereStatement .= "`$key` = '$where'";
        }
        self::$QueryStringWhereStatement = $whereStatement;
        self::$whereIsFuncCalled         = true;
        return new DB();
    }


    public function orWhere($queries): DB
    {
        $orWhere = "";
        foreach ($queries as $key => $query) {
            $orWhere .= "$key";
        }
        $query = self::$tableName;
        return new DB();
    }

    /**
     * @return bool|array
     */
    public function get(): mixed
    {
        if (!self::$SelectFuncIsCalled):
            $WhereQuery = "";
            if (strlen(self::$QueryStringWhereStatement) > 0) {
                $WhereQuery = " " . self::WHERE . self::$QueryStringWhereStatement;
            }
            $query = self::SELECT . self::$SelectQuery . self::STAR . self::FROM . self::$tableName . $WhereQuery;
        else:
            $query = self::$QueryStringTable;
        endif;
        if (self::$orderBy !== '') {
            $query .= self::$orderBy;
        }
        return self::QueryExecute($query, false);

    }

    public function orderBy(string $column, string $order): DB
    {
        self::$orderBy = " ORDER BY `$column` $order";
        return new DB();
    }


    private static function QueryExecute($query, bool $FETCH_MODE = false): mixed
    {
        $statement = Application::$app->database::$PDO->prepare($query);
        $statement->execute();
        if ($FETCH_MODE) {
            return $statement->fetch(\PDO::FETCH_OBJ);
        }
        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public function first(): void
    {
        $query = self::$QueryStringTable;
        self::QueryExecute($query, true);
    }

    public function select(...$selects): DB
    {
        $select = "";
        /** @var (int) $i */
        $lengthSelect = count($selects);
        $ii           = 0;
        for ($i = 0; $i < $lengthSelect; $i++) {
            $ii++;
            if ($ii == $lengthSelect) {
                $select .= " `$selects[$i]` ";
            } else {
                $select .= " `$selects[$i]`, ";
            }
        }
        self::$SelectQuery        = $select;
        self::$SelectFuncIsCalled = true;
        return new DB();
    }

    public function map(callable $function): void
    {

    }

}