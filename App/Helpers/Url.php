<?php

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

    function redirect($destination, $msg = array()) {
        foreach ($msg as $key => $value) {
            Session::put($key, $value);
        }
        header('Location: ' . BASE_URL . $destination);
        exit;
    }

}