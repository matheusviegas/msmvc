<?php

namespace App\Controllers;

use App\Core\{Controller, Auth};
use App\Core\Libraries\{Upload, Email, Session, DB};
use App\Models\User;

class HomeController extends Controller {

    public function __construct() {
        parent::__construct();

        if(Auth::user() == null){
          $this->redirect('login', ['flash' => ['error' => 'Área restrita a usuários logados.']]);
        }
    }

    public function index() {

    //	$user = Auth::user();
    	//echo "<pre>";
    	//var_dump(Auth::user()->group->roles->where('role', 'users_list')->count());exit;

    	//->where('products.id', $productId)->exists()

       // $this->addJS(['datatables', 'toastr', 'sweetalert']);
      //  $this->addCSS(['teste1', 'teste2', 'teste2', 'teste2', 'teste2', 'teste2', 'teste2', 'teste2', 'teste2']);
      //  $this->addJS('https://jquery.com/jquery-wp-content/themes/jquery/js/main.js', true);
        $this->template('home', ['usuario' => Auth::user()], ['titulo' => 'Inicio', 'active_menu_item' => 'home']);
    }

    public function test(){
        echo "<form name='csrf_form' method='POST' action='" . $this->base('home/teste', TRUE) . "'>";
        $this->csrf_field('csrf_form');
        echo "<input type='text' name='cidade' value='Pelotas' /><input type='submit' value='OK' /></form>";
    }

    public function teste(){
        echo "<pre>";
        var_dump($_POST);
        echo "<br /><br />";
        var_dump($this->verifyCSRFToken());
    }

}
