<?php

namespace App\Config;

class View
{
    public string    $layout = "main";
    public string    $title  = "Home page";
    public string    $head   = "head";
    public string    $body   = "body";
    protected string $outputBuffer;

    /**
     * @param string       $view
     * @param array|object $data
     * @return string
     */
    public static function make(string $view, array|object $data = []): string
    {
        return (new View())->renderOnlyView($view, $data);
    }

    /**
     * @param       $view
     * @param array $data
     * @return string
     */
    public static function render($view, array $data = []): string
    {
        return (new View())->renderOnlyView($view, $data);
    }

    /**
     * @param              $view
     * @param array|object $data
     * @return string
     */
    public static function ErrorRender($view, array|object $data = []): string
    {
        ob_start();
        if (isset($data['errors'])) {
            foreach ($data['errors'] as $key => $datum) {
                $$key = $datum;
            }
        }
        $errors = $data;
        include_once sprintf("%s/config/views/$view.php", dirname(__DIR__));
        return ob_get_contents();
    }

    /***
     * @param $view
     * @param $data
     * @return string
     */
    private
    static function errorBuffer($view, $data): string
    {
        ob_start();
        foreach ($data as $key => $value) {
            $$key = $value;
        }
        include_once sprintf("%s/config/views/$view.php", Application::$rootDIR);
        return ob_get_contents();
    }

    /**
     * @param              $view
     * @param array|object $data
     * @return string
     */
    private function renderOnlyView($view, array|object $data = []): string
    {
        $view = str_replace('.', '/', $view);
        ob_start();
        foreach ($data as $key => $item) {
            $$key = $item;
        }
        include_once sprintf("%s/views/$view.php", Application::$rootDIR);
        return ob_get_contents();
    }

    public function content($type): string
    {
        if ($type === $this->head) {
            return $this->head;
        } elseif ($type === $this->body) {
            return $this->body;
        }
    }

    /**
     * @param $type
     * @return bool
     */
    public function section($type): bool
    {
        $this->outputBuffer = $type;
        return ob_start();
    }

    /**
     * @return false|string|void
     */
    public function endsection()
    {
        if ($this->outputBuffer === 'head') {
            return $this->head = ob_get_clean();
        } elseif ($this->outputBuffer === 'body') {
            return $this->body = ob_get_clean();
        } else {
            die("You must be first run the section method");
        }
    }


}