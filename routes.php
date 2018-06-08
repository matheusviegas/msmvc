<?php

use App\Core\Route;

//$routes['/teste/{nome}/{sobrenome}'] = '/teste/testar/:nome/:sobrenome';
//$routes['/galeria/{id}/{titulo}'] = '/galeria/abrir/:id/:titulo';
//$routes['/news/{id}'] = '/noticia/abrir/:id';
//$routes['/n/{titulo}'] = '/noticia/abrirtitulo/:titulo';

Route::get('/teste/{nome}/{sobrenome}', '/teste/testar/:nome/:sobrenome');
