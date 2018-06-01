<?php

namespace App\Core;

use App\Core\Language;
use App\Core\Helpers\Session;
use App\Core\Helpers\Config;
use App\Core\Auth;

class Controller {

	protected $lang;

	public function __construct($permission = null) {
		global $config;
		$this->lang = new Language();

		if($permission != null && $permission != 'public'){
			if(!Auth::hasPermission($permission)){
				$this->redirect('unauthorized');
			}
		}
	}
	
	public function loadView($viewName, $viewData = array()) {
		extract($viewData);
		include 'App/Views/'.$viewName.'.php';
	}

	public function loadTemplate($viewName, $viewData = array(), $templateData = array(), $template = null) {
		extract($templateData);
		include 'App/Views/Templates/' . ($template == null ? Config::get('default_template') : $template) . '.php';
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
		exit;
	}

	public function base($destino, $return = FALSE){
		if($return){
			return BASE_URL . $destino;
		}else {
			echo BASE_URL . $destino;
		}
	}

	public function accept($method, $permission = null, $redirect = null, $mensagem = null){
		if(in_array($method, Config::get('accepted_methods')) && $_SERVER['REQUEST_METHOD'] != $method){
			$this->redirect(Config::get('redirect_if_invalid_request_method'), ['flash' => ['error' => $this->lang->get('ROUTE_METHOD_UNACCEPTED', TRUE) . ' ' . $method . '.']]);
			exit;
		} 

		$this->requirePermission($permission, $redirect, $mensagem);
	}

	public function requirePermission($permission, $redirect = null, $mensagem = null){
		$redirect = $redirect == null ? Config::get('redirect_if_insuficient_permission') : $redirect;
		$mensagem = ($mensagem == null ? $this->lang->get('INSUFICIENT_PERMISSION', TRUE) : $mensagem);

		if($permission != null && !Auth::hasPermission($permission)){
			$this->redirect($redirect, ['flash' => ['error' => $mensagem]]);
			exit;
		}
	}

}
