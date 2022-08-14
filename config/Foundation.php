<?php

namespace App\Config;

use App\Http\Controller\Controller;

abstract class Foundation
{
    public static Application $app;
    private Request           $request;
    private Response          $response;
    public Route              $route;
    private Session           $session;
    public Database           $database;
    public Controller         $controller;
    public Model              $models;
    public static string      $rootDIR;
    public Str                $Str;
    public View               $view;

    public function __construct(string $rootDIR)
    {
        self::ErrorFunction();
        $this->route      = new Route();
        $this->models     = new Model();
        $this->request    = new Request();
        $this->response   = new Response();
        $this->session    = new Session();
        $this->database   = new Database();
        $this->controller = new Controller();
        $this->Str        = new Str();
        self::$rootDIR    = $rootDIR;
        self::$app        = $this;
    }

    private static function ErrorFunction(): void
    {
        ini_set("log_errors", 1);
        error_reporting(E_ALL);
        ini_set("display_startup_errors", 1);
        ini_set("display_errors", 1);
        ini_set("error_reporting", E_ALL);
        set_error_handler('error_handlerView', E_ALL);
    }
}