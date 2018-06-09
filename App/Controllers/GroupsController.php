<?php

namespace App\Controllers;

use App\Core\{Controller, Auth};
use App\Core\Libraries\Input;
use App\Models\{Group, Role};

class GroupsController extends Controller {

    public function __construct() {
        parent::__construct();

        if (Auth::user() == null) {
            $this->redirect('login', ['mensagem' => 'Área restrita a usuários logados.']);
        }
    }

    public function index() {
        $this->requirePermission('groups_list', 'home', 'Voce não tem permissão para visualizar os grupos.');
        $configTemplate = [
            'title' => 'Grupos',
            'panel_title' => 'Listagem de Grupos',
            'txt_btn' => 'Adicionar Grupo',
            'action_btn' => 'groups/add',
            'active_menu_item' => 'groups'
        ];

        $this->template('Groups/groups_list', ['groups' => Group::all()], $configTemplate);
    }

    public function add() {
        $this->requirePermission('groups_add', 'home', 'Voce não tem permissão para criar grupos.');
        $configTemplate = [
            'title' => 'Grupos',
            'panel_title' => 'Adicionar Grupo',
            'active_menu_item' => 'groups'
        ];

        $this->template('Groups/groups_add', ['roles' => Role::all()], $configTemplate);
    }

    public function edit($id) {
        $this->requirePermission('groups_edit', 'home', 'Voce não tem permissão para alterar grupos.');
        $configTemplate = [
            'title' => 'Grupos',
            'panel_title' => 'Editar Grupo',
            'active_menu_item' => 'groups'
        ];

        $this->template('Groups/groups_add', ['roles' => Role::all(), 'group' => Group::find(intval($id))], $configTemplate);
    }

    public function open($id) {
        $this->requirePermission('groups_open', 'home', 'Voce não tem permissão para visualizar os detalhes dos grupos.');
        $configTemplate = [
            'title' => 'Grupos',
            'panel_title' => 'Detalhes do Grupo',
            'active_menu_item' => 'groups'
        ];

        $this->template('Groups/groups_open', ['group' => Group::find(intval($id))], $configTemplate);
    }

    public function save() {
        $this->requirePermission('groups_save', 'home', 'Voce não tem permissão para criar ou alterar grupos.');
        $data = Input::post();

        $group = !empty($data['id']) ? Group::find(intval($data['id'])) : new Group();
        $group->name = $data['name'];
        $group->save();

        if (!empty($data['roles'])) {
            $group->roles()->sync($data['roles']);
        } else {
            $group->roles()->detach();
        }

        $this->redirect('groups', ['flash' => ['success' => 'Alterações salvas com sucesso!']]);
    }

    public function delete($id) {
        $this->requirePermission('groups_delete', 'home', 'Voce não tem permissão para remover grupos.');
        $group = Group::find($id);
        $group->roles()->detach();
        if ($group->delete()) {
            $this->redirect('groups', ['flash' => ['success' => 'Deletado com sucesso.']]);
        } else {
            $this->redirect('groups', ['flash' => ['danger' => 'Erro ao excluir.']]);
        }
    }

}
