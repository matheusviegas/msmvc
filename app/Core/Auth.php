<?php

namespace App\Core;
use App\Core\Helpers\Session;
use App\Models\Usuario;
use App\Core\Database;
use PDO;

class Auth {

	public static function getUsuario(){
		if(Session::has('id_usuario')){
			return Usuario::find(intval(Session::get('id_usuario')));
		} else {
			return null;
		}
	}

	public static function authenticate($email, $senha){
		$senha = MD5($senha);
		$db = Database::getPDO();

		$sql = 'SELECT u.*, g.nome as nome_grupo, GROUP_CONCAT(p.permissao SEPARATOR \',\') as permissoes FROM usuarios u INNER JOIN grupos g on u.grupo_id = g.id INNER JOIN grupos_permissoes gp on gp.grupo_id = g.id LEFT JOIN permissoes p on gp.permissao_id = p.id WHERE u.email = :email and u.senha = :senha and u.status = 1 GROUP BY u.id';
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':senha', $senha);
		$stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_OBJ);

		if($usuario !== null){
			Session::put('id_usuario', $usuario->id);
			Session::put('nome_usuario', $usuario->nome);
			Session::put('sobrenome_usuario', $usuario->sobrenome);
			Session::put('email_usuario', $usuario->email);
			Session::put('datacad_usuario', $usuario->datacadastro);
			Session::put('foto_usuario', $usuario->foto);
			Session::put('tipo_usuario', $usuario->nome_grupo);
			Session::put('idtipo_usuario', $usuario->grupo_id);
			Session::put('permissoes', explode(',', $usuario->permissoes));
		}

      	return $usuario;
	}

	public static function hasPermission($permission){
		return Session::has('id_usuario') && in_array($permissao, Session::get('permissoes_usuario'));
	}

	public static function logout(){
		Session::close();
	}

}
