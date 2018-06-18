<?php

namespace App\Core\Http;

class Response {
	
	public function json($data, $jsonParams = JSON_FORCE_OBJECT | JSON_NUMERIC_CHECK | JSON_UNESCAPED_SLASHES | JSON_PARTIAL_OUTPUT_ON_ERROR | JSON_PRESERVE_ZERO_FRACTION) {
		header("Content-type:application/json");
		echo json_encode($data, $jsonParams);
	}

}
