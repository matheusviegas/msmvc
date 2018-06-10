<?php

namespace App\Core;

use App\Core\Libraries\Session;
use App\Models\User;

class Auth {

    public static function user() {
        if (Session::has('authenticated_user_id')) {
            return User::find(intval(Session::get('authenticated_user_id')));
        } else {
            return null;
        }
    }

    public static function authenticate($email, $password) {
        $user = User::where('email', $email)->where('password', MD5($password))->first();

        if ($user !== null) {
            Session::put('authenticated_user_id', $user->id);
        }

        return $user;
    }

    public static function hasPermission($role) {
        return Session::has('authenticated_user_id') && Auth::user()->group->roles->where('role', $role)->count() > 0;
    }

    public static function logout() {
        Session::close();
    }

}
