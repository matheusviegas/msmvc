<?php

namespace App\Controllers;

use App\Core\{Auth, Controller};
use App\Core\Helpers\{Config, Input};

class LoginController extends Controller {

    public function __construct() {
        parent::__construct();

        if(Auth::user() != null){
        	$this->redirect('home');
        }
    }

    public function index() {
       
    	$this->view('Auth/login_form');
    }

    public function authenticate(){
        $this->verifyCSRFToken();
    	$data = Input::post();

    	if(Input::validate($data, 'required')){
    		$user = Auth::authenticate($data['email'], $data['password']);

	    	if($user != null){
	    		$this->redirect(Config::get('redirect_after_login'));
	    	} else {
	    		$this->redirect('login', ['flash' => ['error' => 'Usuário ou senha inválidos.']]);
	    	}
    	} else {
			$this->redirect('login', ['flash' => ['error' => 'Preencha o email e a senha.']]);
    	}    	
    }

}
