<?php

namespace App\Core;

class Route {

	public static function get($url, $destination){
		self::checkRoute('GET', $url, $destination);
	}

	public static function post($url, $destination){
		self::checkRoute('POST', $url, $destination);
	}

	private static function addRoute($url, $destination){
		global $routes;
     	$routes[$url] = $destination;
	}

	private static function checkRoute($method, $url, $destination) {
		if ($_SERVER['REQUEST_METHOD'] === $method) {
			self::addRoute($url, $destination);
		}
	}

}
