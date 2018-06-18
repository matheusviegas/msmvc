<?php

use App\Core\Libraries\Session;
use App\Core\Http\Redirect;

if (!function_exists('base')) {

    function base($destination, $return = FALSE) {
        if ($return) {
            return BASE_URL . $destination;
        } else {
            echo BASE_URL . $destination;
        }
    }

}


if (!function_exists('redirect')) {

    function redirect($destination = null) {
        return new Redirect($destination);
    }

}
