<?php

namespace App\Controllers;

use App\Core\{Controller, Database};
use App\Models\{User, Role, Group};

class SetupController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        echo "<a href='" . $this->base('setup/setup/1', TRUE) . "'>SETUP DATABASE</a>";
    }

    public function setup($step) {

        if ($step == 1) {
            $table = "teste";
            try {
                $db = Database::getPDO();

                $sql = "CREATE TABLE groups (
                          id int(11) NOT NULL,
                          name varchar(255) NOT NULL,
                          created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                          updated_at timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                        CREATE TABLE groups_roles (
                          id int(11) NOT NULL,
                          group_id int(11) NOT NULL,
                          role_id int(11) NOT NULL
                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                        CREATE TABLE roles (
                          id int(11) NOT NULL,
                          role varchar(255) NOT NULL,
                          description varchar(255) DEFAULT NULL,
                          created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                          updated_at timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                        CREATE TABLE users (
                          id int(11) NOT NULL,
                          name varchar(255) NOT NULL,
                          lastname varchar(255) NOT NULL,
                          username varchar(255) NOT NULL,
                          email varchar(255) NOT NULL,
                          password varchar(255) NOT NULL,
                          group_id int(11) NOT NULL,
                          registration_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                          status int(2) NOT NULL,
                          picture varchar(255) NOT NULL,
                          created_at timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
                          updated_at timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

                        ALTER TABLE groups ADD PRIMARY KEY (id);
                        ALTER TABLE groups_roles ADD PRIMARY KEY (id), ADD KEY fk_grupos_permissoes_grupos (group_id), ADD KEY fk_grupos_permissoes_permissoes (role_id);
                        ALTER TABLE roles ADD PRIMARY KEY (id);
                        ALTER TABLE users ADD PRIMARY KEY (id), ADD KEY fk_usuarios_grupos (group_id);
                        ALTER TABLE groups MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;            
                        ALTER TABLE groups_roles MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
                        ALTER TABLE roles MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
                        ALTER TABLE users MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
                        ALTER TABLE groups_roles ADD CONSTRAINT fk_grupos_permissoes_grupos FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE NO ACTION ON UPDATE NO ACTION, ADD CONSTRAINT fk_grupos_permissoes_permissoes FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE NO ACTION ON UPDATE NO ACTION;
                        ALTER TABLE users ADD CONSTRAINT fk_usuarios_grupos FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE NO ACTION ON UPDATE NO ACTION;
                ";

                $db->exec($sql);
                echo "Tabelas criadas! <a href='" . $this->base('setup/setup/2', TRUE) . "'>Popular base de dados</a>";
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        } else if ($step == 2) {
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

            redirect('setup/setup/3');
        } else {
            echo "concluido";
        }
    }

}
