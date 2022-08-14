<?php
use App\Config\Application;
use App\Config\Request;
use App\Config\View;

const SERVE = "php -S 127.0.0.1:8080 -t public";


function dd(...$exceptions): bool|string
{
    ob_start();
    echo "<pre>";
    var_dump($exceptions);
    echo "</pre>";
    return ob_get_contents();
}

function asset($path): string
{
    return sprintf('%s/%s', Request::BaseUrl(), $path);
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
        'errorCode'    => $errorCode,
        'errorMessage' => $errorMessage,
        'errorFile'    => $errorFile,
        'errorLine'    => $errorLine,
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
    $path = Application::$app->route->getRoute($route);
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


function section($type): string
{
    return Application::$app->view->section($type);
}

function endsection(): string
{

}
