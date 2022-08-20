<?php
namespace App\Config;

use App\Config\CommandFileStructure\Console;
use App\Http\Controllers\Controller;

class Application
{
    /**
     * @var mixed|string|void
     */
    public Request               $request;
    public Response              $response;
    public Route                 $route;
    public Session               $session;
    public Controller            $controller;
    public Model                 $models;
    public static string         $rootDIR = '';
    public Str                   $Str;
    public View                  $view;
    public static string|Console $console = Console::class;
    public Schema                $schema;
    public Migration             $migration;
    public Blueprint             $blueprint;
    public Database              $database;
    public static                $app;
    public Kernel                $kernel;
    public Validator             $validator;

    public function __construct()
    {
        self::$rootDIR = __DIR__ . "/../";
        self::ErrorFunction();
        self::$app        = $this;
        $this->route      = new Route();
        $this->request    = new Request();
        $this->response   = new Response();
        $this->session    = new Session();
        $this->controller = new Controller();
        $this->Str        = new Str();
        self::$console    = Console::class;
        $this->blueprint  = new Blueprint();
        $this->schema     = new Schema();
        $this->migration  = new Migration();
        $this->kernel     = new Kernel();
        $this->validator  = new Validator();
        $this->database   = new Database();
    }

    public static function ErrorFunction(): void
    {
        ini_set("log_errors", 1);
        error_reporting(E_ALL);
        ini_set("display_startup_errors", 1);
        ini_set("display_errors", 1);
        ini_set("error_reporting", E_ALL);
        set_error_handler('error_handlerView', E_ALL);
    }

    public function run(): void
    {
        try {
            if (is_string($this->route->resolve()) && $this->route->resolve() === ''):
                echo $this->route->resolve();
            else:
                echo json_encode($this->route->resolve());
            endif;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }


    }
}