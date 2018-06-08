<?php

namespace App\Core\Helpers;

class Config {
	
	public static function get($key = null){
		global $config;

		if($key == null){
			return $config;
		} else {
			return !empty($config[$key]) ? $config[$key] : null;
		}
	}

}
