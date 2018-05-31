<?php

namespace App\Core\Helpers;

class Input {
	
   public static function get($key = null){
   		return $key == null ? $_GET : $_GET[$key];
   }

   public static function post($key = null){
   		return $key == null ? $_POST : $_POST[$key];
   }

   public static function validate($dados, $filtros){
   		$array = explode("|", $filtros);

   		foreach($dados as $dado){
   			foreach($array as $filtro){
   				if($filtro === 'required' && empty($dado)){
   					return false;
   				}
   			}
   		}

   		return true;
   }
}
