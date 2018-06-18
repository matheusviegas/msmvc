<?php

namespace App\Middlewares;

use App\Core\{Auth, Middleware};

class AuthWSMiddleware implements Middleware {
	
	public function handle(){
		if (!isset($_REQUEST['token']) || !Auth::validateToken($_REQUEST['token'])) {
            header($_SERVER['SERVER_PROTOCOL'].' 401 Unauthorized');
			exit;
        }
	}

}
