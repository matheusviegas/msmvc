<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Usuario;
use App\Core\Auth;
use App\Core\Helpers\Input;
use App\Core\Helpers\Config;

class LoginController extends Controller {

    public function __construct() {
        parent::__construct();

        if(Auth::getUsuario() != null){
        	$this->redirect('home');
        }
    }

    public function index() {
    	$this->loadView('Auth/login_form');
    }

    public function autenticar(){
    	$dados = Input::post();

    	if(Input::validate($dados, 'required')){
    		$usuario = Auth::authenticate($dados['email'], $dados['senha']);

	    	if($usuario != null){
                //var_dump($usuario);exit;
	    		$this->redirect(Config::get('redirect_after_login'));
                exit;
	    	} else {
	    		$this->redirect('login', ['flash' => ['error' => 'Usuário ou senha inválidos.']]);
	    	}
    	} else {
			$this->redirect('login', ['flash' => ['error' => 'Preencha o email e a senha.']]);
    	}    	
    }

}
