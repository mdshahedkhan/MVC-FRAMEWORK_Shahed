<?php

namespace App\Config;

use App\Http\Middleware\AuthMiddleware;

class Kernel extends HttpKernel
{
    protected array $middlewares = [
        'auth' => AuthMiddleware::class
    ];
}