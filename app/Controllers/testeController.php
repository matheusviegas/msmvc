<?php

namespace App\Controllers;

use App\Core\Controller;

class testeController extends Controller{

	public function __construct(){
		parent::__construct();
	}

	public function index(){

	}

	public function testar($nome, $sobrenome){
		echo "Nome: " . $nome . "<br />";
		echo "Sobrenome: " . $sobrenome;
	}
}
