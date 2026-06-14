<?php

define('ROOT', dirname(__DIR__));

spl_autoload_register(function (string $class) {
    $path = ROOT . '/' . str_replace(['App\\', '\\'], ['app/', '/'], $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

use App\Core\Session;
use App\Controllers\AuthController;

Session::start();

$page   = $_GET['page'] ?? 'login';
$method = $_SERVER['REQUEST_METHOD'];
$auth   = new AuthController();

if ($page === 'register') {
    $method === 'POST' ? $auth->register() : $auth->registerForm();
} elseif ($page === 'reset-password') {
    $method === 'POST' ? $auth->resetPasswordRequest() : $auth->resetPasswordForm();
} else {
    $method === 'POST' ? $auth->login() : $auth->loginForm();
}
