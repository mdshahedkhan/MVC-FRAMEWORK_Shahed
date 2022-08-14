<?php

require_once __DIR__ . "./vendor/autoload.php";
use App\Config\Log;
use App\Config\Model;
use App\Config\Str;


$command = $argv;
if ($command[1] === 'serve') {
    exec(SERVE);
} elseif ('model') {

    Log::success("Execute done!");
} else {
    Log::error("Command Not Found.");
}