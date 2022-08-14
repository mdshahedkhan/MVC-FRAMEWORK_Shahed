<?php

namespace App\Config;

class Request
{
    /**
     * @return string
     */
    public function getPath(): string
    {
        $path     = $_SERVER['REQUEST_URI'] ?? "/";
        $position = strpos($path, "?") ?? false;
        if ($position === false) {
            return $path;
        }
        return substr($path, 0, $position);
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


    /**
     * @return string
     */
    public function getMethod(): string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    /**
     * @return string
     */
    public static function BaseUrl(): string
    {
        return $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'];
    }

    /**
     * @return bool
     */
    public static function isPost(): bool
    {
        return (new Request)->getMethod() === 'post';
    }

    /**
     * @return bool
     */
    public static function isGet(): bool
    {
        return (new Request)->getMethod() === 'get';
    }

    /**
     * @return array
     */
    public static function all(): array
    {
        $body = [];
        if (Request::isGet()) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if (Request::isPost()) {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function __get(string $name)
    {
        return self::all()[$name];
    }

    /**
     * @param string $path
     * @return bool
     */
    public static function is(string $path): bool
    {
        return (new Request())->getPath() === $path ?? false;
    }

    /**
     * @param ...$inputs
     * @return array
     */
    public function input(...$inputs): array
    {
        $InputsVal = [];
        foreach ($inputs as $key) {
            $InputsVal[$key] = $this->all()[$key] ?? false;
        }
        return $InputsVal;
    }

    /**
     * @param ...$only
     * @return array
     */
    public function only(...$only): array
    {
        $InputsVal = [];
        foreach ($only as $key) {
            $InputsVal[$key] = $this->all()[$key] ?? false;
        }
        return $InputsVal;
    }

    /**
     * @param string $name
     * @param        $value
     * @return void
     */
    public function __set(string $name, $value): void
    {
        $this->$name = $value;
    }
}