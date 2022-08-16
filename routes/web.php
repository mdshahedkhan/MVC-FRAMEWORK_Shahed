<?php


use App\Config\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('/admin')->group(function () {
    Route::get('/index', [TestController::class, 'store'])->name('store');
    Route::get('/manage', [AuthController::class, 'index']);
});


