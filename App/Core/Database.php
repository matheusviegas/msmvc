<?php

namespace App\Core;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Container\Container;
use App\Core\Helpers\Config;
use PDO;

class Database {

	public function init(){
		$capsule = new Capsule;

		$capsule->addConnection([
		    'driver'    => getenv('DB_DRIVER'),
		    'host'      => getenv('DB_HOST'),
		    'database'  => getenv('DB_NAME'),
		    'username'  => getenv('DB_USER'),
		    'password'  => getenv('DB_PASSWORD'),
		    'charset'   => getenv('DB_CHARSET'),
		    'collation' => getenv('DB_COLLATION'),
		    'prefix'    => getenv('DB_TABLE_PREFIX'),
		    'port'      => getenv('DB_PORT')
		]);

		$capsule->bootEloquent();
	}

	public static function getPDO(){
		$db = new PDO("mysql:dbname=".getenv('DB_NAME').";host=".getenv('DB_HOST') . ";port=" . getenv('DB_PORT'), getenv('DB_USER'), getenv('DB_PASSWORD'));
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	}

}
