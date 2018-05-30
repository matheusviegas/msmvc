<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model;

class User extends Model{
	protected $table = 'usuarios';
	protected $fillable = ['nome', 'sobrenome', 'email']; 

}
