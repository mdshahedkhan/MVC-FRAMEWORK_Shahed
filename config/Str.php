<?php

namespace App\Config;


class Str
{
    private static string $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";

    protected static $snakeCache;

    public static function snake($value, $delimiter = '_')
    {
        $key = $value . $delimiter;
        if (isset(static::$snakeCache[$key])) {
            return static::$snakeCache[$key];
        }
        if (!ctype_lower($value)) {
            $value = strtolower(preg_replace('/(.)(?=[A-Z])/', '$1' . $delimiter, $value));
        }
        return static::$snakeCache[$key] = $value;
    }

    public static function randomString($length = 25): string
    {
        $randomString = "";
        for ($i = 0; $i < $length; $i++) {
            $randomString .= self::$characters[rand(0, strlen(self::$characters) - 1)];
        }
        return $randomString;
    }

    public static function strlen($string): string
    {
        $len = 0;
        for ($i = 0; $i < strlen($string); $i++) {
            $len++;
        }
        return $len;
    }

    public function __call(string $name, array $arguments)
    {
        if (property_exists($this, $name)) {
            return call_user_func_array([$this, $name], $arguments);
        }
    }

    public function __set(string $name, $value): void
    {

    }
}