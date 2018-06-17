<?php

namespace App\Core;

use App\Core\{Auth, Language, Config};
use App\Core\Libraries\{Input, Session};
use App\Core\Util\MiddlewareItem;

class Controller {

    protected $lang;
    protected $additionalJS;
    protected $additionalCSS;
    private $middleware;

    public function __construct($role = null) {
        $this->lang = new Language();
        $this->additionalJS = [];
        $this->additionalCSS = [];
        $this->middleware = [];

        if ($role != null && $role != 'public') {
            if (!Auth::hasPermission($role)) {
                redirect(Config::get('redirect_after_logout'));
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

    public function acceptWithPermission($method, $role, $redirect = null, $message = null) {
        $this->accept($method);
        $this->requirePermission($role, $redirect, $message);
    }

    public function accept($method) {
        if (in_array($method, Config::get('accepted_methods')) && $_SERVER['REQUEST_METHOD'] != $method) {
            redirect(Config::get('redirect_if_invalid_request_method'), ['flash' => ['error' => $this->lang->get('ROUTE_METHOD_UNACCEPTED', TRUE) . ' ' . $method . '.']]);
            exit;
        }
    }

    public function requirePermission($role, $redirect = null, $message = null) {
        $redirect = $redirect == null ? Config::get('redirect_if_insuficient_permission') : $redirect;
        $message = ($message == null ? $this->lang->get('INSUFICIENT_PERMISSION', TRUE) : $message);

        if ($role != null && !Auth::hasPermission($role)) {
            redirect($redirect, ['flash' => ['error' => $message]]);
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

    protected function middleware($middleware, $type = 'all', $methods = []){
        $this->middleware[] = new MiddlewareItem($middleware, $methods, $type);
    }

    public function getMiddlewares(){
        return $this->middleware;
    }

}
