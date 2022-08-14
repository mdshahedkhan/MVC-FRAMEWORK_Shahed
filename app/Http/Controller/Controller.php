<?php

namespace App\Http\Controller;

use App\Config\DB;
use App\Config\Model;
use App\Config\Request;
use App\Config\View;

class Controller
{
    public function index(Request $request): bool|string
    {
        $user = DB::table('categories')->orderBy('name', 'ASC')->get();
        return View::make('index', compact('users'));
    }

    public function store(Request $model)
    {
        return $model->all();
    }
}