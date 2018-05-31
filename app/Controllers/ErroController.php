<?php

namespace App\Controllers;

use App\Core\Controller;

class ErroController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {      
        $this->loadView('erro');
    }

}
