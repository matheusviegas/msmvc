<?php

use App\Core\Core;
use App\Core\Helpers\Session;
use App\Core\Database;

require 'vendor/autoload.php';
require 'config.php';
require 'routes.php';

Session::open();

(new Database())->iniciar();
(new Core())->run();

?>
