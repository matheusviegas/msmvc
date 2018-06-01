<?php

namespace App\Core\Helpers;

class JSON {
	
	public static function decode($data, $assoc = FALSE){
		return json_decode($data, $assoc);
	}

	public static function encode($data){
		header("Content-type:application/json");
		return json_encode($data, JSON_FORCE_OBJECT | JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION);
	}

}
