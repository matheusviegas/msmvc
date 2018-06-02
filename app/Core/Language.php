<?php

namespace App\Core;

class Language {

	private $language;
	private $languageArray;

	public function __construct() {
		global $config;
		$this->language = $config['default_lang'];

		if(!empty($_SESSION['lang']) && file_exists('App/Lang/'.$_SESSION['lang'].'.php')) {
			$this->language = $_SESSION['lang'];
		}

		require_once('App/Lang/'.$this->language . '.php');
		$this->languageArray = $lang;
	}

	public function get($keyWord, $return = false) {
		if(isset($this->languageArray[$keyWord])) {
			if($return) {
				return $this->languageArray[$keyWord];
			} else {
				echo $this->languageArray[$keyWord];
				return;
			}
		}

		return $keyWord;
	}

}






