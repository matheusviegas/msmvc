<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Helpers\Upload;
use App\Core\Helpers\Email;

use App\Models\Usuario;
use App\Core\Auth;
use App\Core\Helpers\Session;

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
