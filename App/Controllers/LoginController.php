<?php

namespace App\Controllers;

use App\Core\{Auth, Controller, Config};
use App\Core\Libraries\Input;

class LoginController extends Controller {

    public function __construct() {
        parent::__construct();

        $this->middleware('csrf', 'methods', ['authenticate']);
    }

    public function index() {
        $this->view('Auth/login_form');
    }

    public function authenticate() {
        $data = Input::post();

        if (Input::validate($data, 'required')) {
            $user = Auth::authenticate($data['email'], $data['password']);

            if ($user != null) {
                redirect(Config::get('redirect_after_login'))->go();
            } else {
                redirect('login')->with('error', 'Usuário ou senha inválidos.')->go();
            }
        } else {
            redirect('login')->with('error', 'Preencha o email e a senha.')->go();
        }
    }

}
