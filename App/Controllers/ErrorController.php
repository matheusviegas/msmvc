<?php

namespace App\Controllers;

use App\Core\Controller;

class ErrorController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view('error');
    }

}
