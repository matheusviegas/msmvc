<?php

use App\Core\{Database, Core, Router, Config};
use App\Core\Libraries\Session;

define("APP_PATH", __DIR__);

require 'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_DRIVER', 'DB_TIMEZONE', 'APP_TIMEZONE', 'APP_KEY', 'DB_CHARSET', 'DB_COLLATION'])->notEmpty();
$dotenv->required('DB_PORT')->isInteger();
$dotenv->required('ENVIRONMENT')->allowedValues(['development', 'production']);
$dotenv->required('DB_PASSWORD');

require 'config.php';
Session::open();
(new Database())->init();

date_default_timezone_set(env('APP_TIMEZONE'));

foreach (Config::get('autoload') as $key => $val) {
    foreach ($val as $helper) {
        require "App/" . ucfirst($key) . "/" . ucfirst($helper) . ".php";
    }
}

$router = new Router();
$router->setNamespace('\App\Controllers');
$router->set404('ErrorController@index');

$router->before('GET|POST', '/api/.*', function() {
    (new \App\Middlewares\AuthWSMiddleware())->handle();
});

$router->setRoutesFolder('/App/Routes/', $router);
$router->run();
