<?php

namespace App\Config;

class Route
{
    private static mixed    $call_user_func;
    protected Request       $request;
    protected Response      $response;
    private static array    $routes = [];
    private static string   $storeRoute;
    private View            $view;
    protected static string $prefix = '';
    private array           $routeName;

    public function __construct()
    {
        $this->request  = new Request();
        $this->response = new Response();
        $this->view     = new View();
    }

    public static function get(string $url, $callback): Route
    {
        self::$routes['get'][self::$prefix . $url] = $callback;
        self::$storeRoute                          = $url;
        return new Route();
    }


    public static function post(string $url, $callback): Route
    {
        self::$routes['post'][self::$prefix . $url] = $callback;
        self::$storeRoute                           = $url;
        return new Route();
    }


    public static function prefix(string $prefix): Route
    {
        self::$prefix = $prefix;
        return new Route();
    }


    public function getRoute($route, array $params)
    {
        $path = static::$routes[$route];
        if (!$params) {
            return $path;
        }
        $SlParams = 0;
        $newPath  = "";
        foreach ($params as $key => $param) {
            $SlParams++;
            if ($SlParams === 1) {
                $newPath = $path . "?$key=$param";
            } else {
                $newPath .= $path . "&$key=$param";
            }
        }
        return $newPath;
    }


    public static function route($route, $params = []): bool|string
    {
        ob_start();
        $location = (new Route)->getRoute($route, $params);
        header("Location: $location");
        return ob_get_contents();
    }

    public function name(string $name): Route
    {
        self::$routes[$name] = self::$prefix . self::$storeRoute;
        return new Route();
    }

    /**
     * @return mixed|string|void
     */
    public function resolve()
    {
        $path     = $this->request->getPath();
        $method   = $this->request->getMethod();
        $dispatch = self::$routes[$method][$path] ?? false;
        if ($dispatch === false) {
            $this->response->setStatusCode(Response::NotFound);
            return View::ErrorRender('_404');
        }

        if (is_string($dispatch)) {
            return $dispatch;
        }
        if (is_array($dispatch)) {
            Application::$app->controller = new $dispatch[0]();
            $dispatch[0]                  = Application::$app->controller;
        }
        Session::set('preUrl', $path);
        return call_user_func($dispatch, $this->request);
    }

    public function group(callable $callable)
    {
        call_user_func($callable);
    }

    public function middleware(array ...$string): Route
    {
        return new Route();
    }
}