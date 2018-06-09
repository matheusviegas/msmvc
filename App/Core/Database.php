<?php

namespace App\Core;

use Illuminate\Database\Capsule\Manager as Capsule;
use PDO;

class Database {

	public function init(){
		$capsule = new Capsule;

		$capsule->addConnection([
		    'driver'    => env('DB_DRIVER'),
		    'host'      => env('DB_HOST'),
		    'database'  => env('DB_NAME'),
		    'username'  => env('DB_USER'),
		    'password'  => env('DB_PASSWORD'),
		    'charset'   => env('DB_CHARSET'),
		    'collation' => env('DB_COLLATION'),
		    'prefix'    => env('DB_TABLE_PREFIX'),
		    'port'      => env('DB_PORT')
		]);

		$capsule->bootEloquent();
	}

	public static function getPDO(){
		$db = new PDO("mysql:dbname=".env('DB_NAME').";host=".env('DB_HOST') . ";port=" . env('DB_PORT'), env('DB_USER'), env('DB_PASSWORD'));
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	}

}
