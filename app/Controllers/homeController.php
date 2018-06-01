<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Helpers\Upload;
use App\Core\Helpers\Email;

use App\Core\Auth;
use App\Core\Helpers\Session;

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

        $this->template('home', ['usuario' => Auth::user()], ['titulo' => 'Inicio', 'active_menu_item' => 'home']);
    }

}
