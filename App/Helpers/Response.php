<?php

use App\Core\Http\Response;

if(!function_exists('response')){

	function response() {
		return new Response();
	}

}
