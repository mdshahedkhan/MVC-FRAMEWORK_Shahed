<?php

namespace App\Config;

abstract class Middleware
{
    public abstract function redirectTo($request);

}