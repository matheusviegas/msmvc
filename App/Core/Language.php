<?php

namespace App\Core;

use App\Core\Config;
use App\Core\Libraries\Session;

class Language {

    private $language;
    private $languageArray;

    public function __construct() {
        $this->language = Config::get('default_lang');

        if (Session::has('lang') && file_exists('App/Lang/' . Session::get('lang') . '.php')) {
            $this->language = Session::get('lang');
        }

        $this->languageArray = require('App/Lang/' . $this->language . '.php');
    }

    public function get($keyWord, $return = false) {
        if (isset($this->languageArray[$keyWord])) {
            if ($return) {
                return $this->languageArray[$keyWord];
            } else {
                echo $this->languageArray[$keyWord];
                return;
            }
        }

        return $keyWord;
    }

}
