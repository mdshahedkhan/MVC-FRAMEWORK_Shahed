<?php

namespace App\Config;

class Session
{
    private const KEY = "session";

    public function __construct()
    {
        session_start();
        session_regenerate_id(true);
    }
}