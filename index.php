<?php

use App\Core\{Database, Core};
use App\Core\Helpers\Session;

require 'vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_DRIVER', 'DB_TIMEZONE', 'APP_TIMEZONE', 'APP_KEY', 'DB_CHARSET', 'DB_COLLATION', 'BASE_URL'])->notEmpty();
$dotenv->required('DB_PORT')->isInteger();
$dotenv->required('ENVIRONMENT')->allowedValues(['development', 'production']);
$dotenv->required('DB_PASSWORD');

require 'config.php';
require 'routes.php';

Session::open();

(new Database())->init();
(new Core())->run();
