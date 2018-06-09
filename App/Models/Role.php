<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model {

    protected $table = 'roles';
    protected $fillable = ['role', 'description'];

    public function groups() {
        return $this->belongsToMany(User::class, 'groups_roles');
    }

}
