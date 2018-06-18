<?php

namespace App\Controllers;

use App\Core\{Controller, Auth, Config};

class LogoutController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        Auth::logout();
        redirect(Config::get('redirect_after_logout'))->go();
    }

}
