<?php

namespace App\Core;

use App\Core\Language;
use App\Core\Helpers\Session;

class Controller {

	protected $db;
	protected $lang;

	public function __construct() {
		global $config;
		$this->lang = new Language();
	}
	
	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		include 'App/Views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array()) {
		include 'App/Views/template.php';
	}

	public function loadViewInTemplate($viewName, $viewData) {
		extract($viewData);
		include 'App/Views/'.$viewName.'.php';
	}

	public function redirect($destino, $msg = array()){
		foreach ($msg as $key => $value) {
			Session::put($key, $value);
		}
		header('Location: ' . BASE_URL . $destino);
	}

	public function base($destino, $return = FALSE){
		if($return){
			return BASE_URL . $destino;
		}else {
			echo BASE_URL . $destino;
		}
	}



}
