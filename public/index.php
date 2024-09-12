<?php

declare(strict_types=1);

use App\Controller\AuthController;
use App\Controller\HomeController;
use Dikki\DotEnv\DotEnv;
use App\Library\Router;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once dirname(__DIR__) . '/vendor/autoload.php';

(new DotEnv(dirname(__DIR__)))->load();

if (getenv('APP_ENV') === 'dev') {
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    ini_set('error_reporting', E_ALL);
}

$router = new Router();

// app routes
$router->addRoute('GET', '/', function () {
    return (new HomeController)->index();
});

$router->addRoute('GET', '/auth/login', function () {
    return (new AuthController)->login();
});

$router->addRoute('GET', '/auth/callback', function () {
    return (new AuthController)->callback();
});

$router->addRoute('GET', '/auth/logout', function () {
    return (new AuthController)->logout();
});

$router->addRoute('GET', '/articles/([\w-]+)', function ($slug) {
    echo "Article: $slug";
});

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
