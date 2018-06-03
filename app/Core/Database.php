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
		    'driver'    => Config::get('driver'),
		    'host'      => Config::get('dbhost'),
		    'database'  => Config::get('dbname'),
		    'username'  => Config::get('dbuser'),
		    'password'  => Config::get('dbpass'),
		    'charset'   => Config::get('dbcharset'),
		    'collation' => Config::get('dbcollation'),
		    'prefix'    => Config::get('dbtable_prefix'),
		]);

		$capsule->bootEloquent();
	}

	public static function getPDO(){
		$db = new PDO("mysql:dbname=".Config::get('dbname').";host=".Config::get('dbhost'), Config::get('dbuser'), Config::get('dbpass'));
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	}

}
