<?php

namespace App\Middlewares;

use App\Core\{Auth, Middleware};

class AuthMiddleware implements Middleware {
	
	public function handle(){
		if (Auth::user() == null) {
            redirect('login')->with('error', 'Área restrita a usuários logados.')->go();
        }
	}

}
