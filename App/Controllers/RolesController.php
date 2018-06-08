<?php

namespace App\Controllers;

use App\Core\{Auth, Controller};
use App\Core\Helpers\{Session, Upload, Input, Email};
use App\Models\{Role, Group};

class RolesController extends Controller {

    public function __construct() {
        parent::__construct();

        if(Auth::user() == null){
          $this->redirect('login', ['mensagem' => 'Área restrita a usuários logados.']);
        }
    }

    public function index() {
      $this->requirePermission('roles_list', 'home', 'Voce não tem permissão para visualizar as roles.');
      $configTemplate = [
        'title' => 'Roles', 
        'panel_title' => 'Listagem de Roles',
        'txt_btn' => 'Adicionar Role',
        'action_btn' => 'roles/add',
        'active_menu_item' => 'roles'
      ];

        $this->template('Roles/roles_list', ['roles' => Role::all()], $configTemplate);
    }

    public function add(){
      $this->requirePermission('roles_add', 'home', 'Voce não tem permissão para criar roles.');
      $configTemplate = [
        'title' => 'Roles', 
        'panel_title' => 'Adicionar Role',
        'active_menu_item' => 'roles'
      ];

        $this->template('Roles/roles_add', [], $configTemplate);
    }

    public function edit($id){
      $this->requirePermission('roles_edit', 'home', 'Voce não tem permissão para alterar roles.');
      $configTemplate = [
        'title' => 'Roles', 
        'panel_title' => 'Editar Role',
        'active_menu_item' => 'roles'
      ];

        $this->template('Roles/roles_add', ['role' => Role::find(intval($id))], $configTemplate);
    }


    public function save(){
      $this->requirePermission('roles_save', 'home', 'Voce não tem permissão para criar ou alterar roles.');
      $data = Input::post();

      $role = !empty($data['id']) ? Role::find(intval($data['id'])) : new Role();
      $role->role = $data['role'];
      $role->description = $data['description'];
      $role->save();

      $this->redirect('roles', ['flash' => ['success' => 'Alterações salvas com sucesso!']]);
    }


    public function delete($id){
        $this->requirePermission('roles_delete', 'home', 'Voce não tem permissão para remover roles.');
        if(Role::destroy($id)){
          $this->redirect('roles', ['flash' => ['success' => 'Deletado com sucesso.']]);
        }else {
          $this->redirect('roles', ['flash' => ['danger' => 'Erro ao excluir.']]);
        }
    }

}
