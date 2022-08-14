<?php
namespace App\Config;

class Application extends Foundation
{

    /**
     * @return void
     */
    public function run(): void
    {
        if (is_string(self::Execute())) {
            echo self::Execute();
        } else {
            echo json_encode(self::Execute());
        }
    }

    private function Execute()
    {
        return $this->route->resolve();
    }

    public function app(): Application
    {
        return new Application(__DIR__);
    }


}