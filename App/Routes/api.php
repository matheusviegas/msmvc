<?php

$router->group('/api', function() use ($router) {
    $router->get('/users', function () {
    	return response()->json(\App\Models\User::all());
	});
});
