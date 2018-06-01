<?php

namespace App\Core;

use App\Core\Language;
use App\Core\Helpers\Session;
use App\Core\Helpers\Config;
use App\Core\Auth;

class Controller {

	protected $lang;

	public function __construct($role = null) {
		global $config;
		$this->lang = new Language();

		if($role != null && $role != 'public'){
			if(!Auth::hasPermission($role)){
				$this->redirect(Config::get('redirect_after_logout'));
			}
		}
	}
	
	public function view($viewName, $viewData = array()) {
		extract($viewData);
		include 'App/Views/'.$viewName.'.php';
	}

	public function template($viewName, $viewData = array(), $templateData = array(), $template = null) {
		extract($templateData);
		include 'App/Views/Templates/' . ($template == null ? Config::get('default_template') : $template) . '.php';
	}

	public function loadViewInTemplate($viewName, $viewData) {
		extract($viewData);
		include 'App/Views/'.$viewName.'.php';
	}

	public function redirect($destination, $msg = array()){
		foreach ($msg as $key => $value) {
			Session::put($key, $value);
		}
		header('Location: ' . BASE_URL . $destination);
		exit;
	}

	public function base($destination, $return = FALSE){
		if($return){
			return BASE_URL . $destination;
		}else {
			echo BASE_URL . $destination;
		}
	}

	public function accept($method, $role = null, $redirect = null, $message = null){
		if(in_array($method, Config::get('accepted_methods')) && $_SERVER['REQUEST_METHOD'] != $method){
			$this->redirect(Config::get('redirect_if_invalid_request_method'), ['flash' => ['error' => $this->lang->get('ROUTE_METHOD_UNACCEPTED', TRUE) . ' ' . $method . '.']]);
			exit;
		} 

		$this->requirePermission($role, $redirect, $message);
	}

	public function requirePermission($role, $redirect = null, $message = null){
		$redirect = $redirect == null ? Config::get('redirect_if_insuficient_permission') : $redirect;
		$message = ($message == null ? $this->lang->get('INSUFICIENT_PERMISSION', TRUE) : $message);

		if($role != null && !Auth::hasPermission($role)){
			$this->redirect($redirect, ['flash' => ['error' => $message]]);
			exit;
		}
	}

}
