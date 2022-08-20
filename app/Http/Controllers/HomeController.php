<?php

namespace App\Http\Controllers;

use App\Config\Redirect;
use App\Config\Request;
use App\Config\Session;
use App\Config\View;
use App\Http\Controllers\Controller;
use App\Models\Categories;

class HomeController extends Controller
{
    public function index(): string
    {
        $users = Categories::orderBy('name', "ASC")->orWhere(['status' => 'active'])->get();
        return view('welcome', compact('users'));
    }

    public function back(): string
    {
        return Redirect::route('index');
    }
}