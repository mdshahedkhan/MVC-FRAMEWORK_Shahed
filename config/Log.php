<?php

namespace App\Config;

class Log
{
    private const RED_COLOR = "\033[1;31m";
    private const GREEN_COLOR = "\033[1;32m";
    private const YELLOW_COLOR = "\033[1;33m";
    private const CYAN_COLOR = "\033[1;36m";
    private const NormanColor = "\e[0m";
    private const WHITE = "\033[1;37m";


    public static function success(string $string): void
    {
        echo self::GREEN_COLOR . $string . self::NormanColor . PHP_EOL;
    }

    public static function warning(string $string): void
    {
        echo self::YELLOW_COLOR . $string . self::NormanColor . PHP_EOL;
    }

    public static function info(string $string): void
    {
        echo self::CYAN_COLOR . $string . self::NormanColor . PHP_EOL;
    }

    public static function error(string $string): void
    {
        echo self::RED_COLOR . $string . self::NormanColor . PHP_EOL;
    }

    public static function white(string $string): void
    {
        echo self::WHITE . $string . self::NormanColor . PHP_EOL;
    }
}