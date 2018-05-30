<?php

namespace App\Core\Helpers;

class JSON {
	
	public static function decode($dados, $assoc = FALSE){
		return json_decode($dados, $assoc);
	}

	public static function encode($dados){
		return json_encode($dados, JSON_FORCE_OBJECT | JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION);
	}

}
