<?php

namespace App\Core;

use Illuminate\Database\Capsule\Manager as Capsule;

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

}
