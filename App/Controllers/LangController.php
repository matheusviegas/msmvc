<?php

namespace App\Controllers;

use App\Core\{Config, Controller};
use App\Core\Libraries\Session;

class LangController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        
    }

    public function set($lang) {
        Session::put('lang', $lang);
        redirect(Config::get('default_controller'))->go();
    }

}
