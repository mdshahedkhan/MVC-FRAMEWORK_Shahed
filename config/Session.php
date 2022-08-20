<?php

namespace App\Config;

class Session
{
    private const FLASH_KEY = 'flash_messages';

    public function __construct()
    {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            $flashMessages['remove'] = true;
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }

    /**
     * @param string $key
     * @param mixed  $data
     * @return array
     */
    public static function set(string $key, mixed $data): array
    {
        return $_SESSION[self::FLASH_KEY] = [$key => $data];
    }

    /**
     * @param string $key
     * @param mixed  $data
     * @return void
     */
    public static function flash(string $key, mixed $data)
    {
        dd($_SESSION[self::FLASH_KEY] = [$key => $data, 'remove' => 'false']);

    }

    /**
     * @param string $key
     * @return mixed
     */
    public static function get(string $key): mixed
    {
        return $_SESSION[self::FLASH_KEY][$key];
    }

    /**
     * @param string $key
     * @return void
     */
    public static function has(string $key)
    {
        dd(isset($_SESSION[self::FLASH_KEY][$key]) ?? false);
    }


    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ($flashMessages as $key => &$flashMessage) {
            if ($flashMessage === true) {
                unset($flashMessages[$key]);
            }
        }
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }


}