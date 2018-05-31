<?php

namespace App\Models;
use \Illuminate\Database\Eloquent\Model;
use App\Models\Grupo;

class Usuario extends Model{
	protected $table = 'usuarios';
	protected $fillable = ['nome', 'sobrenome', 'usuario', 'email', 'grupo_id', 'datacadastro', 'status', 'foto']; 

	public function grupo(){
		 return $this->belongsTo(Grupo::class);
	}

}
