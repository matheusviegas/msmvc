<?php

namespace App\Controllers;

use App\Core\{Controller, Auth};
use App\Core\Helpers\Config;

class LogoutController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
    	Auth::logout();
        $this->redirect(Config::get('redirect_after_logout'));
    }

}
