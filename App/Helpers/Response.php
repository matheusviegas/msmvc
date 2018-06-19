<?php

use App\Core\Http\Response;

if(!function_exists('response')){

	function response($statusCode = 200, $text = null) {
		return new Response($statusCode, $text);
	}

}
