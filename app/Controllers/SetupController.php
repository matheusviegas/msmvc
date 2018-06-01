<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Core\Helpers\Input;
use App\Core\Helpers\Config;

use App\Models\User;
use App\Models\Role;
use App\Models\Group;

class SetupController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
    	echo "<a href='" . $this->base('setup/setup', TRUE) . "'>SETUP DATABASE</a>";
    }

    public function setup(){
    	$group = new Group();
        $group->name = 'Administrators';
        $group->save();

        $user = new User();
        $user->name = 'Administrator';
        $user->lastname = 'Master';
        $user->email = 'admin@gmail.com';
        $user->username = 'administrator';
        $user->password = MD5('admin');

        $user->group()->associate($group);
        $user->save();

        $role = new Role();
        $role->role = "roles_list";
        $role->description = "Acessar lista de roles";
        $role->save();

        $role = new Role();
        $role->role = "roles_add";
        $role->description = "Adicionar nova role";
        $role->save();

        $role = new Role();
        $role->role = "roles_edit";
        $role->description = "Editar uma role";
        $role->save();

        $role = new Role();
        $role->role = "roles_save";
        $role->description = "Salvar alterações em uma role";
        $role->save();

        $role = new Role();
        $role->role = "roles_delete";
        $role->description = "Deletar uma role";
        $role->save();

        $role = new Role();
        $role->role = "users_list";
        $role->description = "Acessar lista de usuários";
        $role->save();

        $role = new Role();
        $role->role = "users_add";
        $role->description = "Cadastrar um usuário";
        $role->save();

        $role = new Role();
        $role->role = "users_edit";
        $role->description = "Editar um usuário";
        $role->save();

        $role = new Role();
        $role->role = "users_save";
        $role->description = "Salvar alterações em um usuário";
        $role->save();

        $role = new Role();
        $role->role = "users_delete";
        $role->description = "Deletar um usuário";
        $role->save();

        $role = new Role();
        $role->role = "users_open";
        $role->description = "Visualizar detalhes do usuário";
        $role->save();

        $role = new Role();
        $role->role = "groups_list";
        $role->description = "Acessar lista de grupos";
        $role->save();

        $role = new Role();
        $role->role = "groups_add";
        $role->description = "Cadastrar um grupo";
        $role->save();

        $role = new Role();
        $role->role = "groups_delete";
        $role->description = "Deletar um grupo";
        $role->save();

        $role = new Role();
        $role->role = "groups_edit";
        $role->description = "Editar um grupo";
        $role->save();

        $role = new Role();
        $role->role = "groups_save";
        $role->description = "Salvar alterações em um grupo";
        $role->save();

        $role = new Role();
        $role->role = "groups_open";
        $role->description = "Visualizar detalhes do grupo";
        $role->save();

        $group->roles()->attach(Role::all()->pluck('id')->toArray());
        
    }

}
