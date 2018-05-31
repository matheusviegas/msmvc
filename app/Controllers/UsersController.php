<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Helpers\Upload;
use App\Core\Helpers\Email;

use App\Models\Usuario;
use App\Models\Grupo;
use App\Core\Auth;
use App\Core\Helpers\Session;
use App\Core\Helpers\Input;

class UsersController extends Controller {

	private $user;

    public function __construct() {
        parent::__construct();

        if(Auth::getUsuario() == null){
          $this->redirect('login', ['mensagem' => 'Área restrita a usuários logados.']);
        }
    }

    public function index() {

      $configTemplate = [
        'titulo' => 'Usuários', 
        'titulo_panel' => 'Listagem de Usuários',
        'txt_btn' => 'Cadastrar Usuário',
        'action_btn' => 'users/add'
      ];

        $this->loadTemplate('Users/users_list', ['usuarios' => Usuario::all()], $configTemplate);
    }

    public function add(){
      $configTemplate = [
        'titulo' => 'Usuários', 
        'titulo_panel' => 'Cadastrar Usuário'
      ];

        $this->loadTemplate('Users/users_add', ['grupos' => Grupo::all()], $configTemplate);
    }

    public function edit($id){
      $configTemplate = [
        'titulo' => 'Usuários', 
        'titulo_panel' => 'Editar Usuário'
      ];

        $this->loadTemplate('Users/users_add', ['grupos' => Grupo::all(), 'usuario' => Usuario::find(intval($id))], $configTemplate);
    }

    public function save(){
      $dados = Input::post();

      $usuario = !empty($dados['id']) ? Usuario::find(intval($dados['id'])) : new Usuario();
      $usuario->nome = $dados['nome'];
      $usuario->sobrenome = $dados['sobrenome'];
      $usuario->email = $dados['email'];
      $usuario->usuario = $dados['usuario'];
      $usuario->grupoid = $dados['grupo'];

      if(!empty($dados['senha']) && !empty($dados['confirmacao_senha']) && $dados['senha'] == $dados['confirmacao_senha']){
        $usuario->senha = MD5($dados['senha']);
      }

      $usuario->save();

      $this->redirect('users/add', ['flash' => ['success' => 'Alterações salvas com sucesso!']]);
    }

    public function teste(){

      $flashes = [
        'success' => 'Mensagem de sucesso!',
        'error' => 'Mensagem de erro',
        'info' => 'Mensagem de informação'
      ];

      $this->redirect('home', ['flash' => $flashes]);
    }

    public function upload(){
        $dados = array();   
        $this->loadView('teste_upload', $dados);
    }

    public function enviar(){
        var_dump(Upload::do('arquivo', 'uploads/', ['png', 'jpg', 'jpeg', 'pdf', 'docx', 'xlsx', 'zip']));
    }

    public function email(){
      $mail = new Email(true);
      $mail->from("cantinasenacpelotas@gmail.com", "Cantina Senac");
      $mail->to("matheusviegasdesouza@gmail.com", "Matheus Souza");
      $mail->subject("Assunto teste");
      $mail->message("<i>Mensagem HTML</i>", "Para conseguir essa e-mail corretamente, use um visualizador de e-mail com suporte a HTML");
      $mail->addAttachment('/var/www/html/mvc/Planilha.xlsx'); 

      if(!$mail->send()){
        echo "Erro: " . $mail->ErrorInfo;
      }else {
        echo "Mensagem enviada com sucesso!";
      }  
    }

    public function delete($id){
        if(Usuario::destroy($id)){
          $this->redirect('users', ['status' => 'success', 'mensagem' => 'Deletado com sucesso.']);
        }else {
          $this->redirect('users', ['status' => 'danger', 'mensagem' => 'Erro ao excluir.']);
        }
    }

}
