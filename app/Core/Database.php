<?php

namespace App\Core;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Container\Container;
use PDO;

class Database {

	public function iniciar(){
		global $config;

		$capsule = new Capsule;

		$capsule->addConnection([
		    'driver'    => $config['driver'],
		    'host'      => $config['host'],
		    'database'  => $config['dbname'],
		    'username'  => $config['dbuser'],
		    'password'  => $config['dbpass'],
		    'charset'   => 'utf8',
		    'collation' => 'utf8_unicode_ci',
		    'prefix'    => '',
		]);

		$capsule->bootEloquent();
	}

	public static function getPDO(){
		global $config;
		$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	}

}
