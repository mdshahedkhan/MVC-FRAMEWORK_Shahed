<?php

namespace App\Config;

class Hash
{
    public static function make(string $string): string
    {
        return password_hash($string, PASSWORD_DEFAULT);
    }

    public static function check(string $string, string $hash): bool
    {
        return password_verify($string, $hash);
    }


    /**
     * @param string $name
     * @param array  $arguments
     * @return mixed|void
     */
    public static function __callStatic(string $name, array $arguments)
    {
        if (method_exists(self::class, $name)) {
            return call_user_func_array([self::class, $name], $arguments);
        }
    }

}