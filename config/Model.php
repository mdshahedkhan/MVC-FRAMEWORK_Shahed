<?php

namespace App\Config;

class Model extends BaseModel
{
    public static function getModels()
    {
        echo Application::$rootDIR;
    }

    public static function create(array $data): string
    {

    }


    public function __get(string $name)
    {
        return property_exists(self::class, $name);
    }

    public function __set(string $name, $value): void
    {
        $this->$name = $value;
    }


}


