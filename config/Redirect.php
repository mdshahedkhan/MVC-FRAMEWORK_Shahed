<?php

namespace App\Config;

class Redirect extends Route
{

    public static function back(): bool|string
    {
        if (Session::has('preUrl')) {
            $location = Session::get('preUrl');
            header("location: $location");
        }
    }
}