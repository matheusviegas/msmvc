<?php

namespace App\Core\Http;

class Redirect {

	private $url;
	private $allowedFunctions;

	public function __construct($url) {
		$this->url = $this->checkURL($url);
		$this->allowedFunctions = ['success', 'error', 'info', 'warning'];
		header('Location: ' . $this->url);
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

	private function checkURL($url) {
		return preg_match('/http(s?)\:\/\//i', $url) ? $url : BASE_URL . $url;
	}

	public function __call($function, $args) {
		if ($function == 'with') {
            return $this->with($args[0], $args[1]);
        }

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
