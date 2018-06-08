<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Helpers\{Config, Session};

class LangController extends Controller {

	public function __construct(){
		parent::__construct();
	}

	public function index(){

	}

	public function set($lang){
		Session::put('lang', $lang);
		$this->redirect(Config::get('default_controller'));
	}
}
