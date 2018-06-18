<?php

global $config;
global $routes;
$routes = array();

define('BASE_URL', 'http://localhost/msmvc/');

$config = array();
if (env('ENVIRONMENT') == 'development') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

$config['magicRouting'] = TRUE;

$config['default_lang'] = 'pt-br';
$config['default_controller'] = 'home';
$config['default_template'] = 'main_template';

// MENUS DO TEMPLATE

$config['menu_items'] = [
    'home' => [
        'link' => 'home',
        'icon' => 'home',
        'lang_ref' => 'home'
    ],
    'users' => [
        'link' => 'users',
        'icon' => 'user',
        'lang_ref' => 'users'
    ],
    'groups' => [
        'link' => 'groups',
        'icon' => 'users',
        'lang_ref' => 'groups'
    ],
    'roles' => [
        'link' => 'roles',
        'icon' => 'lock',
        'lang_ref' => 'roles'
    ],
    'settings' => [
        'link' => 'settings',
        'icon' => 'cog',
        'lang_ref' => 'settings'
    ],
    'exit' => [
        'link' => 'logout',
        'icon' => 'exit',
        'lang_ref' => 'logout'
    ]
];


// PDO
$config['default_pdo_fetch_mode'] = PDO::FETCH_OBJ;

// Titulos
$config['title_prefix'] = 'MS | ';
$config['title_sufix'] = '';

// Redirecionamento
$config['redirect_after_login'] = 'home';
$config['redirect_after_logout'] = 'login';
$config['redirect_if_insuficient_permission'] = 'erro';
$config['redirect_if_invalid_request_method'] = 'erro';

// CONTROLE DE REQUISIÇÕES
$config['accepted_methods'] = ['POST', 'GET', 'PUT', 'DELETE'];


// UPLOAD HELPER CONFIGURATION
$config['default_upload_dir'] = 'uploads/';
$config['max_file_size'] = 500000;
$config['whitelist_extensions'] = ['png', 'jpg', 'jpeg', 'gif', 'zip', 'tar.gz', 'tar.bz', 'rar'];


// Autoload helpers
$config['autoload'] = [
    'helpers' => ['url', 'format', 'csrf', 'response']
];
