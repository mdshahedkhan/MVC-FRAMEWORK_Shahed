<?php

namespace App\Config\Exceptions;

use Exception;
use PDOException;

class DatabaseConnectionException extends Exception{
    protected $message = "database connection faild.";
}