<?php
use App\Config\Application;

require_once __DIR__ . "/../vendor/autoload.php";

$app = new Application(dirname(__DIR__));


include_once sprintf("%s/routes/web.php", Application::$rootDIR);
$app->run();
