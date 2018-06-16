<?php

namespace App\Middlewares;

use App\Core\{Middleware};
use App\Core\Libraries\{Input, Session};

class CsrfMiddleware implements Middleware {
	
	public function handle(){
		if(!validateCSRFToken()){
			redirect('login', ['flash' => ['error' => 'CSRF validation failed.']]);			
		}
	}

}
