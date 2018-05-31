<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Helpers\Upload;
use App\Core\Helpers\Email;

use App\Models\Usuario;
use App\Core\Auth;
use App\Core\Helpers\Session;

class HomeController extends Controller {

	private $user;

    public function __construct() {
        parent::__construct();

        if(Auth::getUsuario() == null){
          $this->redirect('login', ['flash' => ['error' => 'Área restrita a usuários logados.']]);
        }

    }

    public function index() {
        $this->loadTemplate('home', ['usuario' => Auth::getUsuario()], ['titulo' => 'Inicio', 'active_menu_item' => 'home']);
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

    public function elo(){
        echo "<pre>";

        $uuu = Auth::authenticate('matheusviegasdesouza@gmail.com', 'admin');
       
        var_dump(Auth::getUsuario()->nome);


        Session::close();
        exit;
       

        $usuarios = Usuario::all();

        foreach ($usuarios as $u) {
          echo $u->nome . "<br />";
        }
    }

}
