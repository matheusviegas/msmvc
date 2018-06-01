<?php

namespace App\Core;
use App\Core\Helpers\Session;
use App\Models\User;
use App\Core\Database;
use PDO;

class Auth {

	public static function user(){
		if(Session::has('id_user')){
			return User::find(intval(Session::get('id_user')));
		} else {
			return null;
		}
	}

	public static function authenticate($email, $password){
        $user = User::where('email', $email)->where('password', MD5($password))->first();

		if($user !== null){
			Session::put('id_user', $user->id);
			Session::put('name_user', $user->name);
			Session::put('lastname_user', $user->lastname);
			Session::put('email_user', $user->email);
			Session::put('registration_date_user', $user->registration_date);
			Session::put('picture_user', $user->picture);
		}

      	return $user;
	}

	public static function hasPermission($role){
		return Session::has('id_user') && Auth::user()->group->roles->where('role', $role)->count() > 0;
	}

	public static function logout(){
		Session::close();
	}

}
