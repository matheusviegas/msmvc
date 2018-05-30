<?php

namespace App\Core;

class Route {

	public static function get($url, $destino){
		if ($_SERVER['REQUEST_METHOD'] === 'GET') {
			global $routes;
     		$routes[$url] = $destino;
		}
	}

	public static function post($url, $destino){
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			global $routes;
     		$routes[$url] = $destino;
		}
	}

}
