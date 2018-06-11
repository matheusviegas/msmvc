<?php

if (!function_exists('format_currency')) {

    function format_currency($value, $symbol = FALSE) {
    	return $symbol ? "R$ " . number_format($value, 2, ',', '') : number_format($value, 2, ',', '');
	}

}

if(!function_exists('format_date')) {

	function format_date($date, $format = 'd/m/Y') {
        return date_format(date_create($date), $format);
    }

}

if(!function_exists('format_date_time')){

	function format_date_time($date) {
        return date_format(date_create($date), 'd/m/Y H:i:s');
    }
    
}
