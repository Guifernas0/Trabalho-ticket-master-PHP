<?php

define('ROOT', dirname(__DIR__));

spl_autoload_register(function (string $class){
    $path = ROOT . '/'. str_replace(['App\\', '\\'], ['app/', '/'], $class) . '.php';
    if (file_exists($path)){
        require_once $path;
    }
});

use App\Controllers\AuthController;

$page = $_GET['page'] ?? 'login';

$auth = new AuthController();

if ($page === 'register') {
    $auth->register();
} elseif ($page === 'reset-password') {
    $auth->resetPassword();
} else {
    $auth->login();
}