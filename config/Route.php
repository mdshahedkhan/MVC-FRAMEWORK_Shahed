<?php

namespace App\Config;

class Route
{
    protected Request       $request;
    protected Response      $response;
    private static array    $routes = [];
    private static string   $storeRoute;
    private View            $view;
    protected static string $prefix = '';

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
        self::$routes['post'][$url] = $callback;
        self::$storeRoute           = $url;
        return new Route();
    }

    public static function prefix(string $prefix): Route
    {
        self::$prefix = $prefix;
        return new Route();
    }


    public function getRoute($route)
    {
        return static::$routes[$route];
    }

    public function name(string $name): string
    {
        return self::$routes[$name] = self::$prefix . self::$storeRoute;
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
        return call_user_func($dispatch, $this->request, $this->view);
    }

    public function group(callable $callable)
    {
        return call_user_func($callable);
    }
}