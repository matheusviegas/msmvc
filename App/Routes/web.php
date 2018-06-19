<?php

$router->get('/', 'HomeController@index');
$router->get('/error', 'ErrorController@index');
$router->get('/logout', 'LogoutController@index');

$router->group('/users', function() use ($router) {
    $router->get('/', 'UsersController@index');
    $router->get('/add', 'UsersController@add');
    $router->get('/edit/(\d+)', 'UsersController@edit');
    $router->get('/open/(\d+)', 'UsersController@open');
    $router->post('/save', 'UsersController@save');
    $router->get('/delete/(\d+)', 'UsersController@delete');
});

$router->group('/groups', function() use ($router) {
    $router->get('/', 'GroupsController@index');
    $router->get('/add', 'GroupsController@add');
    $router->get('/edit/(\d+)', 'GroupsController@edit');
    $router->get('/open/(\d+)', 'GroupsController@open');
    $router->post('/save', 'GroupsController@save');
    $router->get('/delete/(\d+)', 'GroupsController@delete');
});

$router->group('/roles', function() use ($router) {
    $router->get('/', 'RolesController@index');
    $router->get('/add', 'RolesController@add');
    $router->get('/edit/(\d+)', 'RolesController@edit');
    $router->post('/save', 'RolesController@save');
    $router->get('/delete/(\d+)', 'RolesController@delete');
});


$router->get('/tst', function(){
	redirect('login')->error('Errrrrrrrrrrou');
});
