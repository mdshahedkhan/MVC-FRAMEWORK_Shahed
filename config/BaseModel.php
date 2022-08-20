<?php

namespace App\Config;

abstract class BaseModel
{
    protected const SELECT = 'SELECT ', STAR = "* ", FROM = "FROM ", DELETE = 'DELETE', WHERE = 'WHERE ', UPDATE = 'UPDATE ', ORDER_BY = " ORDER BY ", AND = ' AND ';

    abstract public static function create(array $data);

    abstract protected static function TableName(): string;

}