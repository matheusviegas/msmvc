<?php

namespace App\Core\Helpers;

class Format {
	
	public static function currency($value, $symbol = FALSE){
		return $symbol ? "R$ " . number_format($value, 2, ',', '') : number_format($value, 2, ',', '');
	}

	public static function date($date, $format = 'd/m/Y'){
		return date_format(date_create($date), $format);
	}

	public static function date_time($date){
		return date_format(date_create($date), 'd/m/Y H:i:s');
	}

}
