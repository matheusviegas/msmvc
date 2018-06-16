<?php

use App\Core\Libraries\{Session, Input};

if(!function_exists('csrf_token')) {
	function csrf_token(){
		$token = sha1(strtotime('now') . Session::getSessionID() . env('APP_KEY'));
		Session::put('csrf_token', $token);
		return $token;
	}
}


if(!function_exists('csrf_field')) {
	function csrf_field(){
		echo "<input type='hidden' name='csrf_token' value='" . csrf_token() . "' />";
	}
}


if(!function_exists('validateCSRFToken')){
	function validateCSRFToken(){
		return Session::has('csrf_token') && Session::get('csrf_token') === Input::post('csrf_token');
	}
}
