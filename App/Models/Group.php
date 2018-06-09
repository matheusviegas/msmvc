<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use App\Models\Role;

class Group extends Model {

    protected $table = 'groups';
    protected $fillable = ['name'];

    public function roles() {
        return $this->belongsToMany(Role::class, 'groups_roles');
    }

}
