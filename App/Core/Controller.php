<?php

namespace App\Core;

use App\Core\{Auth, Language, Config};
use App\Core\Libraries\{Input, Session};

class Controller {

    protected $lang;
    protected $additionalJS;
    protected $additionalCSS;

    public function __construct($role = null) {
        $this->lang = new Language();
        $this->additionalJS = [];
        $this->additionalCSS = [];

        if ($role != null && $role != 'public') {
            if (!Auth::hasPermission($role)) {
                $this->redirect(Config::get('redirect_after_logout'));
            }
        }
    }

    public function view($viewName, $viewData = array()) {
        extract($viewData);
        include 'App/Views/' . $viewName . '.php';
    }

    public function template($viewName, $viewData = array(), $templateData = array(), $template = null) {
        extract($templateData);
        include 'App/Views/Templates/' . ($template == null ? Config::get('default_template') : $template) . '.php';
    }

    public function loadViewInTemplate($viewName, $viewData) {
        extract($viewData);
        include 'App/Views/' . $viewName . '.php';
    }

    public function redirect($destination, $msg = array()) {
        foreach ($msg as $key => $value) {
            Session::put($key, $value);
        }
        header('Location: ' . BASE_URL . $destination);
        exit;
    }

    public function base($destination, $return = FALSE) {
        if ($return) {
            return BASE_URL . $destination;
        } else {
            echo BASE_URL . $destination;
        }
    }

    public function acceptWithPermission($method, $role, $redirect = null, $message = null) {
        $this->accept($method);
        $this->requirePermission($role, $redirect, $message);
    }

    public function accept($method) {
        if (in_array($method, Config::get('accepted_methods')) && $_SERVER['REQUEST_METHOD'] != $method) {
            $this->redirect(Config::get('redirect_if_invalid_request_method'), ['flash' => ['error' => $this->lang->get('ROUTE_METHOD_UNACCEPTED', TRUE) . ' ' . $method . '.']]);
            exit;
        }
    }

    public function requirePermission($role, $redirect = null, $message = null) {
        $redirect = $redirect == null ? Config::get('redirect_if_insuficient_permission') : $redirect;
        $message = ($message == null ? $this->lang->get('INSUFICIENT_PERMISSION', TRUE) : $message);

        if ($role != null && !Auth::hasPermission($role)) {
            $this->redirect($redirect, ['flash' => ['error' => $message]]);
            exit;
        }
    }

    public function addJS($name, $external = false) {
        $this->addAdditionalAssetItem($this->additionalJS, $name, 'JS', $external);
    }

    public function addCSS($name, $external = false) {
        $this->addAdditionalAssetItem($this->additionalCSS, $name, 'CSS', $external);
    }

    private function addAdditionalAssetItem(&$array, $item, $type, $external) {
        if (is_array($item)) {
            foreach ($item as $file) {
                $this->addItemInArray($array, $file, $type, $external);
            }
        } else {
            $this->addItemInArray($array, $item, $type, $external);
        }
    }

    private function addItemInArray(&$array, $item, $type, $external) {
        if (!$external) {
            $item = $this->mountAssetURL($item, $type);
        }
        $array[] = $item;
    }

    private function mountAssetURL($file, $type) {
        if (in_array($type, ['JS', 'CSS'])) {
            return BASE_URL . 'assets/' . strtolower($type) . '/' . $file . '.' . strtolower($type);
        }
    }

    public function getJS() {
        return $this->additionalJS;
    }

    public function getCSS() {
        return $this->additionalCSS;
    }

    // CSRF PROTECTION
    public function generateToken($formName, $validate = false) {
        if (!$validate) {
            $formName = md5($formName);
        }
        return sha1($formName . Session::getSessionID() . env('APP_KEY'));
    }

    public function csrf_field($formName) {
        echo "<input type='hidden' name='form_name' value='" . md5($formName) . "' />";
        echo "<input type='hidden' name='csrf_token' value='" . $this->generateToken($formName) . "' />";
    }

    public function verifyCSRFToken() {
        if (Input::has('csrf_token') && Input::has('form_name')) {
            if (Input::post('csrf_token') !== $this->generateToken(Input::post('form_name'), true)) {
                $this->redirect('login', ['flash' => ['error' => $this->lang->get('csrf_invalid_token', TRUE)]]);
            }
        } else {
            $this->redirect('login', ['flash' => ['error' => $this->lang->get('csrf_validation_failed', TRUE)]]);
        }
    }

}
