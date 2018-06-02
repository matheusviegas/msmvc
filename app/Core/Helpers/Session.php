<?php

namespace App\Core\Helpers;

class Session{

	public static function open(){
		session_start();
	}

	public static function close(){
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}

		session_destroy();
	}

	public static function put($key, $value){
		$_SESSION[$key] = $value;
	}

	public static function putAll($array = array()){
		if(is_array($array) && !empty($array)){
			foreach ($array as $key => $value) {
				if(!array_key_exists($key, $_SESSION)){
					$_SESSION[$key] = $value;
				}
			}
		}
	}

	public static function get($key){
		return $_SESSION[$key];
	}

	public static function has($key){
		return array_key_exists($key, $_SESSION);
	}

	public static function flash($key = '', $value = '', $redirect = ''){
		if(!empty($key)){
			if(empty($value)){
				$valor = $_SESSION[$key];
				unset($_SESSION[$key]);
				return $valor;
			}else{
				$_SESSION[$key] = $value;
				if(!empty($redirect)){
					$this->redirect($redirect);
				}
			}
		}
	}

	public static function getSessionID(){
	    return session_id();
	}

}
