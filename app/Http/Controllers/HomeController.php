<?php 
namespace App\Http\Controllers;
use App\Config\Request;
use App\Config\View;

class HomeController extends Controller{

    public function index(){
    
        $link = "https://www.facebook.com/nfs.shahed";
        return View::make('welcome', compact('link'));
    }
}