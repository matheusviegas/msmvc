<?php

namespace App\Core;

use App\Core\Config;

class Router {

    private $afterRoutes = array();
    private $beforeRoutes = array();
    protected $notFoundCallback;
    private $baseRoute = '';
    private $requestedMethod = '';
    private $serverBasePath;
    private $namespace = '';

    public function setRoutesFolder($routesFolder, $router){
        foreach (glob(APP_PATH . $routesFolder . "*.php") as $routeFile) {
            require $routeFile;
        }
    }

    public function before($methods, $pattern, $fn) {
        $pattern = $this->baseRoute.'/'.trim($pattern, '/');
        $pattern = $this->baseRoute ? rtrim($pattern, '/') : $pattern;

        foreach (explode('|', $methods) as $method) {
            $this->beforeRoutes[$method][] = array(
                'pattern' => $pattern,
                'fn' => $fn,
            );
        }
    }

    public function match($methods, $pattern, $fn) {
        $pattern = $this->baseRoute.'/'.trim($pattern, '/');
        $pattern = $this->baseRoute ? rtrim($pattern, '/') : $pattern;

        foreach (explode('|', $methods) as $method) {
            $this->afterRoutes[$method][] = array(
                'pattern' => $pattern,
                'fn' => $fn,
            );
        }
    }

    public function all($pattern, $fn) {
        $this->match('GET|POST|PUT|DELETE|OPTIONS|PATCH|HEAD', $pattern, $fn);
    }

    public function get($pattern, $fn) {
        $this->match('GET', $pattern, $fn);
    }

    public function post($pattern, $fn) {
        $this->match('POST', $pattern, $fn);
    }

    public function patch($pattern, $fn) {
        $this->match('PATCH', $pattern, $fn);
    }

    public function delete($pattern, $fn) {
        $this->match('DELETE', $pattern, $fn);
    }

    public function put($pattern, $fn) {
        $this->match('PUT', $pattern, $fn);
    }

    public function options($pattern, $fn) {
        $this->match('OPTIONS', $pattern, $fn);
    }


    public function group($baseRoute, $fn) {
        $curBaseRoute = $this->baseRoute;
        $this->baseRoute .= $baseRoute;
        call_user_func($fn);
        $this->baseRoute = $curBaseRoute;
    }

    public function getRequestHeaders() {
        $headers = array();

        if (function_exists('getallheaders')) {
            $headers = getallheaders();

            if ($headers !== false) {
                return $headers;
            }
        }

        foreach ($_SERVER as $name => $value) {
            if ((substr($name, 0, 5) == 'HTTP_') || ($name == 'CONTENT_TYPE') || ($name == 'CONTENT_LENGTH')) {
                $headers[str_replace(array(' ', 'Http'), array('-', 'HTTP'), ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }

        return $headers;
    }


    public function getRequestMethod() {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($_SERVER['REQUEST_METHOD'] == 'HEAD') {
            ob_start();
            $method = 'GET';
        } else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $headers = $this->getRequestHeaders();
            if (isset($headers['X-HTTP-Method-Override']) && in_array($headers['X-HTTP-Method-Override'], array('PUT', 'DELETE', 'PATCH'))) {
                $method = $headers['X-HTTP-Method-Override'];
            }
        }

        return $method;
    }

    public function setNamespace($namespace) {
        if (is_string($namespace)) {
            $this->namespace = $namespace;
        }
    }

    public function getNamespace() {
        return $this->namespace;
    }

    public function run($callback = null) {
        $this->requestedMethod = $this->getRequestMethod();

        if (isset($this->beforeRoutes[$this->requestedMethod])) {
            $this->handle($this->beforeRoutes[$this->requestedMethod]);
        }

        $numHandled = 0;
        if (isset($this->afterRoutes[$this->requestedMethod])) {
            $numHandled = $this->handle($this->afterRoutes[$this->requestedMethod], true);
        }

        if ($numHandled === 0) {

            if(Config::get('magicRouting')){
                $this->magicRouting();            
            }

            if ($this->notFoundCallback) {
                $this->invoke($this->notFoundCallback);
            } else {
                header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
            }
        } else {
            if ($callback && is_callable($callback)) {
                $callback();
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'HEAD') {
            ob_end_clean();
        }

        return $numHandled !== 0;
    }

    public function set404($fn) {
        $this->notFoundCallback = $fn;
    }

    private function handle($routes, $quitAfterRun = false) {
        $numHandled = 0;
        
        $uri = $this->getCurrentUri();

        foreach ($routes as $route) {
            $route['pattern'] = preg_replace('/{([A-Za-z]*?)}/', '(\w+)', $route['pattern']);

            if (preg_match_all('#^'.$route['pattern'].'$#', $uri, $matches, PREG_OFFSET_CAPTURE)) {
                $matches = array_slice($matches, 1);

                $params = array_map(function ($match, $index) use ($matches) {

                    if (isset($matches[$index + 1]) && isset($matches[$index + 1][0]) && is_array($matches[$index + 1][0])) {
                        return trim(substr($match[0][0], 0, $matches[$index + 1][0][1] - $match[0][1]), '/');
                    } else {
                        return isset($match[0][0]) ? trim($match[0][0], '/') : null;
                    }
                }, $matches, array_keys($matches));

                $this->invoke($route['fn'], $params);

                ++$numHandled;

                if ($quitAfterRun) {
                    break;
                }
            } 
        }

        return $numHandled;
    }

    private function magicRouting(){

        $url = '/';
        if (isset($_GET['url'])) {
            $url .= $_GET['url'];
        }

        $params = array();

        if (!empty($url) && $url != '/') {
            $url = explode('/', $url);
            array_shift($url);

            $currentController = ucfirst($url[0]) . 'Controller';
            array_shift($url);

            if (isset($url[0]) && !empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = 'index';
            }

            if (count($url) > 0) {
                $params = $url;
            }
        } else {
            $currentController = ucfirst(Config::get('default_controller')) . 'Controller';
            $currentAction = 'index';
        }


        $controllerClassName = $this->getNamespace() . '\\' . $currentController;

        if (class_exists($controllerClassName)) {
            $controllerClass = new $controllerClassName();

            $this->handleMiddlewares($controllerClass->getMiddlewares(), $currentAction);

            if (method_exists($controllerClass, $currentAction)) {
                call_user_func_array(array($controllerClass, $currentAction), $params);
                exit;
            }
        }

        (new \App\Controllers\ErrorController())->index();
        exit;
    }

    private function handleMiddlewares($middlewares, $method){
        foreach($middlewares as $middleware){
            if((empty($middleware->getMethods()) && $middleware->getType() === 'all') || ($middleware->getType() === 'methods' && in_array($method, $middleware->getMethods())) || 
                ($middleware->getType() === 'except' && !in_array($method, $middleware->getMethods()))){
                $middlewareClass = '\\App\\Middlewares\\' . ucfirst($middleware->getName()) . 'Middleware';
                (new $middlewareClass())->handle();
            }
        }
    }

    private function invoke($fn, $params = array()) {
        if (is_callable($fn)) {
            call_user_func_array($fn, $params);
        } elseif (stripos($fn, '@') !== false) {
            list($controller, $method) = explode('@', $fn);

            if ($this->getNamespace() !== '') {
                $controller = $this->getNamespace().'\\'.$controller;
            }

            if (class_exists($controller)) {
                $controllerClass = new $controller();

                $this->handleMiddlewares($controllerClass->getMiddlewares(), $method);

                if (call_user_func_array(array($controllerClass, $method), $params) === false) {
                    if (forward_static_call_array(array($controller, $method), $params) === false);
                }
            }
        }
    }

    protected function getCurrentUri() {
        $uri = substr($_SERVER['REQUEST_URI'], strlen($this->getBasePath()));

        if (strstr($uri, '?')) {
            $uri = substr($uri, 0, strpos($uri, '?'));
        }

        return '/'.trim($uri, '/');
    }

    protected function getBasePath() {
        if ($this->serverBasePath === null) {
            $this->serverBasePath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)).'/';
        }

        return $this->serverBasePath;
    }
}
