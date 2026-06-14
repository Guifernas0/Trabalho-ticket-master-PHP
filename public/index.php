<?php

define('ROOT', dirname(__DIR__));

// Base URL para assets e links (funciona em / ou em /ticketmaster/public/)
$scriptDir = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
define('BASE_URL', $scriptDir);

function url(string $path = ''): string {
    return BASE_URL . $path;
}

// Serve arquivos estáticos diretamente no servidor embutido do PHP
if (php_sapi_name() === 'cli-server') {
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}

spl_autoload_register(function (string $class) {
    $path = ROOT . '/' . str_replace(['App\\', '\\'], ['app/', '/'], $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

use App\Core\Session;
use App\Core\Router;

Session::start();

$router = new Router();


$router->get('/',                         'HomeController@index');
$router->get('/about',                    'HomeController@about');
$router->get('/contact',                  'HomeController@contact');
$router->post('/contact',                 'HomeController@contactSubmit');


$router->get('/login',                    'AuthController@loginForm');
$router->post('/login',                   'AuthController@login');
$router->get('/register',                 'AuthController@registerForm');
$router->post('/register',               'AuthController@register');
$router->get('/logout',                   'AuthController@logout');
$router->get('/reset-password',           'AuthController@resetPasswordForm');
$router->post('/reset-password',          'AuthController@resetPasswordRequest');


$router->get('/movies',                   'MovieController@index');
$router->get('/movies/{id}',              'MovieController@show');


$router->get('/sessions',                 'SessionController@index');
$router->get('/sessions/{id}',            'SessionController@show');


$router->get('/tickets/buy/{sessionId}',  'TicketController@buyForm');
$router->post('/tickets/buy',             'TicketController@buy');
$router->get('/tickets',                  'TicketController@myTickets');
$router->post('/tickets/cancel/{id}',     'TicketController@cancel');


$router->get('/reviews/form/{movieId}',   'ReviewController@form');
$router->post('/reviews',                 'ReviewController@store');
$router->post('/reviews/delete/{id}',     'ReviewController@delete');

// Remove o prefixo do subdiretório da URI (ex: /ticketmaster/public → /)
$uri = $_SERVER['REQUEST_URI'];
$base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');
if ($base !== '' && strpos($uri, $base) === 0) {
    $uri = substr($uri, strlen($base));
}
$uri = $uri ?: '/';

$router->dispatch($_SERVER['REQUEST_METHOD'], $uri);

?>