<?php

    define('ROOT', dirname(__DIR__));

    spl_autoload_register(function (string $class){
        $path = ROOT . '/'. str_replace(['App\\', '\\'], ['app/', '/'], $class) . '.php';
        if  (file_exists($path)){
            require_once $path;
        }
    });
?>

<?php

define('ROOT', dirname(__DIR__));

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

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

?>