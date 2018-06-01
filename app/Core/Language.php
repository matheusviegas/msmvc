<?php

namespace App\Core;

class Language {

	private $l;
	private $ini;

	public function __construct() {
		global $config;
		$this->l = $config['default_lang'];

		if(!empty($_SESSION['lang']) && file_exists('App/Lang/'.$_SESSION['lang'].'.ini')) {
			$this->l = $_SESSION['lang'];
		}

		$this->ini = parse_ini_file('App/Lang/'.$this->l.'.ini');
	}

	public function get($word, $return = false) {
		$text = $word;

		if(isset($this->ini[$word])) {
			$text = $this->ini[$word];
		}

		if($return) {
			return $text;
		} else {
			echo $text;
		}

	}

}






