<?php

namespace App\Core\Http;

class Redirect {

	private $url;
	private $allowedFunctions;

	public function __construct($url = null) {
		if($url != null){
			$this->url = $this->checkURL($url);
		}
		$this->allowedFunctions = ['success', 'error', 'info', 'warning'];
	}

	public function with($key, $val = 'Invalid') {
		if(is_array($key)) {
			foreach ($key as $k => $v) {
				$_SESSION['flash'][$k][] = $v;
			}
		} else {
			$_SESSION['flash'][$key][] = $val;
		}
		
		return $this;
	}

	public function to($url) {
		$this->url = $this->checkURL($url);
		return $this;
	}

	public function go() {
		header('Location: ' . $this->url);
		exit;
	}

	private function checkURL($url) {
		return preg_match('/http(s?)\:\/\//i', $url) ? $url : BASE_URL . $url;
	}

	public function __call($function, $args) {
		if(in_array($function, $this->allowedFunctions)){
			foreach($args as $msg) {
				$this->with($function, $msg);
			}
		} else {
			throw new \Exception("{$function} não é um método permitido.");
		}

		return $this;
    }

}
