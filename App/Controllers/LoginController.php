<?php

namespace App\Controllers;

use App\Core\{Auth, Controller, Config};
use App\Core\Libraries\Input;

class LoginController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view('Auth/login_form');
    }

    public function authenticate() {
        $this->verifyCSRFToken();
        $data = Input::post();

        if (Input::validate($data, 'required')) {
            $user = Auth::authenticate($data['email'], $data['password']);

            if ($user != null) {
                redirect(Config::get('redirect_after_login'));
            } else {
                redirect('login', ['flash' => ['error' => 'Usuário ou senha inválidos.']]);
            }
        } else {
            redirect('login', ['flash' => ['error' => 'Preencha o email e a senha.']]);
        }
    }

}
