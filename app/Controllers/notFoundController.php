<?php

namespace App\Controllers;

use App\Core\Controller, App\Core\Helpers\Session;


class notFoundController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $dados = array();


        Session::put('mensagem', 'teste');
        $this->loadView('404', $dados);
    }

}
