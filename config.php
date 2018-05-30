<?php
require 'environment.php';

global $config;
global $routes;
$routes = array();

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://localhost/mvc/");
	$config['driver'] = 'mysql';
	$config['dbname'] = 'msmvc';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';


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
}

$config['default_lang'] = 'pt-br';
$config['default_controller'] = 'home';


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
