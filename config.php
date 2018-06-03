<?php
require 'environment.php';

global $config;
global $routes;
$routes = array();

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/msmvc/");
	$config['driver'] = 'mysql';
	$config['dbname'] = 'msmvc2';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
	$config['charset'] = 'utf8';
	$config['collation'] = 'utf8_unicode_ci';
	$config['table_prefix'] = '';


	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
} else {
	// Configurações de produção
	define("BASE_URL", "");
	$config['driver'] = '';
	$config['dbname'] = '';
	$config['host'] = '';
	$config['dbuser'] = '';
	$config['dbpass'] = '';
	$config['charset'] = 'utf8';
	$config['collation'] = 'utf8_unicode_ci';
	$config['table_prefix'] = '';
}

$config['default_lang'] = 'en';
$config['default_timezone'] = 'America/Sao_Paulo';
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

// APPLICATION KEY
$config['app_key'] = '28a19bdec9d377befe';

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

// Configurações de Email
$config['mail_debug'] = 3;
$config['mail_smtp'] = TRUE;
$config['mail_smtp_host'] = 'ssl://smtp.googlemail.com';
$config['mail_smtp_user'] = 'teste@gmail.com';
$config['mail_smtp_pass'] = 'teste123'; 
$config['mail_smtp_port'] = '465';
$config['mail_smtp_type'] = 'html';
$config['mail_smtp_auth'] = TRUE;
$config['mail_smtp_secure']	= 'ssl';

?>
