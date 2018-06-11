<?php

namespace App\Controllers;

use App\Core\{Auth, Controller};
use App\Core\Libraries\{Input, Upload};
use App\Models\{Group, User};

class UsersController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->middleware('auth');
    }

    public function index() {
        $this->requirePermission('users_list', 'home', 'Você não tem permissão para acessar a lista de usuários.');
        $configTemplate = [
            'title' => 'Usuários',
            'panel_title' => 'Listagem de Usuários',
            'txt_btn' => 'Cadastrar Usuário',
            'action_btn' => 'users/add',
            'active_menu_item' => 'users'
        ];

        $this->template('Users/users_list', ['users' => User::all()], $configTemplate);
    }

    public function add() {
        $this->requirePermission('users_add', 'users', 'Voce não tem permissão para criar usuarios.');
        $configTemplate = [
            'title' => 'Usuários',
            'panel_title' => 'Cadastrar Usuário',
            'active_menu_item' => 'users'
        ];

        $this->template('Users/users_add', ['groups' => Group::all()], $configTemplate);
    }

    public function edit($id) {
        $this->requirePermission('users_edit', 'users', 'Voce não tem permissão para alterar usuarios.');
        $configTemplate = [
            'title' => 'Usuários',
            'panel_title' => 'Editar Usuário',
            'active_menu_item' => 'users'
        ];

        $this->template('Users/users_add', ['groups' => Group::all(), 'user' => User::find(intval($id))], $configTemplate);
    }

    public function open($id) {
        $this->requirePermission('users_open', 'users', 'Voce não tem permissão para visualizar os detalhes dos usuarios.');
        $configTemplate = [
            'title' => 'Usuários',
            'panel_title' => 'Detalhes do Usuário',
            'active_menu_item' => 'users'
        ];

        $this->template('Users/users_open', ['user' => User::find(intval($id))], $configTemplate);
    }

    public function save() {
        $this->requirePermission('users_save', 'users', 'Voce não tem permissão para criar ou alterar usuarios.');
        $data = Input::post();

        $user = !empty($data['id']) ? User::find(intval($data['id'])) : new User();
        $user->name = $data['name'];
        $user->lastname = $data['lastname'];
        $user->email = $data['email'];
        $user->username = $data['username'];

        if (!empty($data['password']) && !empty($data['password_confirmation']) && $data['password'] == $data['password_confirmation']) {
            $user->password = MD5($data['password']);
        }

        if (!empty($data['group'])) {
            $group = Group::find(intval($data['group']));
            $user->group()->associate($group);
        }

        $flashMSG = [
            'success' => $this->lang->get('update_sucessful', TRUE)
        ];

        if (Input::has('picture', 'FILE')) {
            $uploadOptions = [
                'extensions' => ['png', 'jpg', 'jpeg', 'gif'],
                'dir' => 'uploads/profile_pictures/'
            ];

            $upload = Upload::doUpload('picture', $uploadOptions);

            if ($upload['status']) {
                $user->picture = $upload['filename'];
            } else {
                $flashMSG['error'] = $upload['msg'];
            }
        }
        $user->save();

        redirect('users', ['flash' => $flashMSG]);
    }

    public function delete($id) {
        $this->requirePermission('users_delete', 'users', 'Voce não tem permissão para remover usuarios.');
        if (User::destroy($id)) {
            redirect('users', ['status' => 'success', 'mensagem' => 'Deletado com sucesso.']);
        } else {
            redirect('users', ['status' => 'danger', 'mensagem' => 'Erro ao excluir.']);
        }
    }

}
