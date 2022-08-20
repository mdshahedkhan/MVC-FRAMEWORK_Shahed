<?php


use App\Config\Route;
use App\Http\Controllers\HomeController;
use App\Models\Categories;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/test', [HomeController::class, 'back']);

Route::get('/categories', function () {
    return Categories::where('create_by', '5')->first();
});