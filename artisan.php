<?php

use App\Config\CommandFileStructure\Console;

require_once __DIR__ . "./vendor/autoload.php";

$commands = $argv;
$console  = new Console($commands);
$console->run();