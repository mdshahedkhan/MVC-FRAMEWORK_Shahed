<?php
use App\Config\Application;
use App\Config\Request;
use App\Config\Validator;
use App\Config\View;

$errors = Validator::$errors;
global $errors;


function dd(...$exceptions): bool|string
{
    ob_start();
    echo "<pre>";
    print_r($exceptions);
    echo "</pre>";
    return ob_get_contents();
}

/*function asset($path): string
{
    return $_SERVER['HTTP_HOST'] . "/$path";
}*/

function asserts(string $assets): string
{
    $root = (string) (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
    return $root . $assets;
}

function view(string $view, array|object $data = []): string
{
    return (new View())::render($view, $data);
}


/**
 * @param int         $errorCode
 * @param string|null $errorMessage
 * @param string|null $errorFile
 * @param string|null $errorLine
 * @return string
 */
function error_handlerView(int $errorCode, ?string $errorMessage, ?string $errorFile, ?string $errorLine): string
{
    $errors   = [
        'errorCode'    => $errorCode ?? "",
        'errorMessage' => $errorMessage ?? "",
        'errorFile'    => $errorFile ?? "",
        'errorLine'    => $errorLine ?? "",
    ];
    $errorLog = "date: " . date("Y-m-d h:i:s") . " error Code: $errorCode message: $errorMessage file Name: $errorFile fine: $errorLine" . PHP_EOL;
    file_put_contents(sprintf("%s/config/errorLog.log", Application::$rootDIR), $errorLog, FILE_APPEND);
    return View::ErrorRender('errorView', compact('errors'));
}


function redirect($path): void
{
    header("location: $path");
}

function route($route, $params = [])
{
    return Application::$app->route->getRoute($route, $params);

}


function section($type): string
{
    return Application::$app->view->section($type);
}

function endsection(): string
{

}
