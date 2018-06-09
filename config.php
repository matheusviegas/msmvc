<?php

global $config;
global $routes;
$routes = array();

define('BASE_URL', 'http://localhost/msmvc/');

$config = array();
if(env('ENVIRONMENT') == 'development') {
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
} 

$config['default_lang'] = 'en';
$config['default_controller'] = 'home';
$config['default_template'] = 'main_template';

// MENUS DO TEMPLATE

$config['menu_items'] = [
	'home' => [
		'link' => 'home',
		'icon' => 'home',
		'title' => 'Painel'
	],
	'users' => [
		'link' => 'users',
		'icon' => 'user',
		'title' => 'Usuários'
	],
	'groups' => [
		'link' => 'groups',
		'icon' => 'users',
		'title' => 'Grupos'
	],
	'roles' => [
		'link' => 'roles',
		'icon' => 'lock',
		'title' => 'Roles'
	],
	'settings' => [
		'link' => 'settings',
		'icon' => 'cog',
		'title' => 'Configurações'
	],
	'exit' => [
		'link' => 'logout',
		'icon' => 'exit',
		'title' => 'Sair'
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
