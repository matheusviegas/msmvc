<?php

namespace App\Core\Util;

class MiddlewareItem {
	private $name;
	private $methods;
	private $type;

	public function __construct($name, $methods = [], $type = null){
		$this->name = $name;
		$this->methods = $methods;
		$this->type = ($type == null) ? 'all' : $type;
	}

	public function getName(){
		return $this->name;
	}

	public function getMethods(){
		return $this->methods;
	}

	public function getType(){
		return $this->type;
	}
}
