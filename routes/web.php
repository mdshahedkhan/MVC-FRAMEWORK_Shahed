<?php


use App\Config\Route;
use App\Config\View;
use App\Http\Controller\Controller;


Route::get('/', function () {
    $link = "https://www.facebook.com/nsf.shahed/";
    return View::render('welcome', compact('link'));
});


Route::get('/users', [Controller::class, 'index']);