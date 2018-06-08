<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use App\Models\Group;

class User extends Model{
	protected $table = 'users';
	protected $fillable = ['name', 'lastname', 'username', 'email', 'group_id', 'registration_date', 'status', 'picture']; 

	public function group(){
		 return $this->belongsTo(Group::class);
	}

}
