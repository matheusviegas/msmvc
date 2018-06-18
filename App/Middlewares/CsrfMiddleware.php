<?php

namespace App\Middlewares;

use App\Core\{Middleware};
use App\Core\Libraries\{Input, Session};

class CsrfMiddleware implements Middleware {
	
	public function handle(){
		if(!validateCSRFToken()){
			redirect('login')->with('error', 'CSRF validation failed.')->go();			
		}
	}

}
