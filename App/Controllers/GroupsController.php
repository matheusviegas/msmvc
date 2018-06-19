<?php

namespace App\Controllers;

use App\Core\{Controller, Auth};
use App\Core\Libraries\Input;
use App\Models\{Group, Role};

class GroupsController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index() {
        $this->requirePermission('groups_list', 'home', 'Voce não tem permissão para visualizar os grupos.');
        $configTemplate = [
            'title' => $this->lang->get('title_page_groups', true),
            'panel_title' => $this->lang->get('groups_list', true),
            'txt_btn' => $this->lang->get('btn_add_group', true),
            'action_btn' => 'groups/add',
            'active_menu_item' => 'groups'
        ];

        $this->template('Groups/groups_list', ['groups' => Group::all()], $configTemplate);
    }

    public function add() {
        $this->requirePermission('groups_add', 'home', 'Voce não tem permissão para criar grupos.');
        $configTemplate = [
            'title' => $this->lang->get('title_page_groups', true),
            'panel_title' => $this->lang->get('btn_add_group', true),
            'active_menu_item' => 'groups'
        ];

        $this->template('Groups/groups_add', ['roles' => Role::all()], $configTemplate);
    }

    public function edit($id) {
        $this->requirePermission('groups_edit', 'home', 'Voce não tem permissão para alterar grupos.');
        $configTemplate = [
            'title' => $this->lang->get('title_page_groups', true),
            'panel_title' => $this->lang->get('group_edit', true),
            'active_menu_item' => 'groups'
        ];

        $this->template('Groups/groups_add', ['roles' => Role::all(), 'group' => Group::find(intval($id))], $configTemplate);
    }

    public function open($id) {
        $this->requirePermission('groups_open', 'home', 'Voce não tem permissão para visualizar os detalhes dos grupos.');
        $configTemplate = [
            'title' => $this->lang->get('title_page_groups', true),
            'panel_title' => $this->lang->get('group_detail', true),
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

        redirect('groups')->with('success', $this->lang->get('update_sucessful', TRUE));
    }

    public function delete($id) {
        $this->requirePermission('groups_delete', 'home', 'Voce não tem permissão para remover grupos.');
        $group = Group::find($id);
        $group->roles()->detach();
        if ($group->delete()) {
            redirect('groups')->with('success', 'Deletado com sucesso.');
        } else {
            redirect('groups')->with('danger', 'Erro ao excluir.');
        }
    }

}
