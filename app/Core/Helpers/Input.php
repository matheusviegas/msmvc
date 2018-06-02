<?php

namespace App\Core\Helpers;

class Input {
	
   public static function get($key = null){
   		return $key == null ? $_GET : $_GET[$key];
   }

   public static function post($key = null){
   		return $key == null ? $_POST : $_POST[$key];
   }

   public static function has($key, $type = 'POST'){
      if($type === 'POST'){
         return isset($_POST[$key]);
      } else {
         return isset($_GET[$key]);
      }
   }

   public static function validate($data, $filters){
   		$array = explode("|", $filters);

   		foreach($data as $dat){
   			foreach($array as $filter){
   				if($filter === 'required' && empty($dat)){
   					return false;
   				}
   			}
   		}

   		return true;
   }
}
