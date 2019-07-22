<?php

define('APP_ROOT_DIR', __DIR__);

require 'app/lib/dev.php';

use app\core\Router;

/**
 * Autoload classes
 */
spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if(file_exists($path)) {
        require $path;
    }
});

session_start();

$router = new Router;
$router->run();