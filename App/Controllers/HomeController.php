<?php

namespace App\Controllers;

use App\Core\{Controller, Auth};
use App\Models\Parameter;

class HomeController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('auth');

        $this->middleware('csrf', 'methods', ['teste']);
    }

    public function index() {

        //	$user = Auth::user();
        //echo "<pre>";
        //var_dump(Auth::user()->group->roles->where('role', 'users_list')->count());exit;
        //->where('products.id', $productId)->exists()
        // $this->addJS(['datatables', 'toastr', 'sweetalert']);
        //  $this->addCSS(['teste1', 'teste2', 'teste2', 'teste2', 'teste2', 'teste2', 'teste2', 'teste2', 'teste2']);
        //  $this->addJS('https://jquery.com/jquery-wp-content/themes/jquery/js/main.js', true);
        $this->template('home', ['usuario' => Auth::user(), 'param' => Parameter::key('DEFAULT_LANGUAGE')], ['titulo' => 'Inicio', 'active_menu_item' => 'home']);
    }

    public function test() {
        echo "<form name='csrf_form' method='POST' action='" . base('home/teste', TRUE) . "'>";
        csrf_field();
        echo "<input type='text' name='cidade' value='Pelotas' /><input type='submit' value='OK' /></form>";
    }

    public function teste() {
       echo "chegou!";
    }

}
