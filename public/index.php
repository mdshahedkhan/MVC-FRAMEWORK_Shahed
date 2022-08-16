<?php

use App\Config\Application;
require_once sprintf("%s/../vendor/autoload.php", __DIR__ );
$app = new Application(dirname(__DIR__));
include_once sprintf("%s/routes/web.php", Application::$rootDIR);
$app->run();