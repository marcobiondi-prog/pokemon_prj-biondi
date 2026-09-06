<?php

session_start();

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

require_once __DIR__ . '/../app/functions.php';
require_once __DIR__ . '/../app/Controllers/AuthHelpers.php';

use Core\Router;

$router = new Router();

// Rotte Auth
$router->add('GET', 'login', 'AuthController@showLogin');
$router->add('POST', 'login', 'AuthController@login');
$router->add('GET', 'register', 'AuthController@showRegister');
$router->add('POST', 'register', 'AuthController@register');
$router->add('GET', 'logout', 'AuthController@logout');

// Rotte Password Reset
$router->add('GET', 'forgot-password', 'ForgotPasswordController@show');
$router->add('POST', 'forgot-password', 'ForgotPasswordController@handleRequest');

// Rotte Dashboard
$router->add('GET', '', 'DashboardController@index');
$router->add('GET', 'dashboard', 'DashboardController@index');

// Rotte User/Profile
$router->add('GET', 'user/profile', 'UserController@profile');
$router->add('POST', 'user/profile', 'UserController@profile');
$router->add('GET', 'user/change-password', 'UserController@changePassword');
$router->add('POST', 'user/change-password', 'UserController@changePassword');

// Rotte Challenges
$router->add('GET', 'challenges/create', 'ChallengeController@create');
$router->add('POST', 'challenges/store', 'ChallengeController@store');
$router->add('POST', 'challenges/accept', 'ChallengeController@accept');

// Esecuzione Request
$url = $_GET['url'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];
$router->dispatch($method, $url);
