<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Helpers\Upload;
use App\Core\Helpers\Email;

use App\Models\User;

class homeController extends Controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
    	//Session::flash('mensagem', 'Mensagem flash!', 'notFound');
    	//Url::redirect('notFound');
    	// global $db;
        // $u = new Usuarios();

        // $u = DB::select('usuarios', '*', ['id' => 1]);
        // $dados['usuarios'] = $u;
        

       //  $this->loadView('home', $dados);
    	//$u = DB::select('usuarios', '*', ['id' => 1]);
        //$u = DB::query('select * from usuarios');
       // $u = new Usuarios();
    	//var_dump($u->l());
       // DB::delete('usuarios', ['id' => 2]);

        //$u = DB::find('usuarios', 1);
       // echo $u->nome;exit;

        //var_dump($u);

       /* $user = [
            'nome' => 'Test 2',
            'sobrenome' => 'Testador'
        ];*/

       // DB::insert('usuarios', $user);

        //var_dump(DB::select('usuarios'));

       // $user = new User();
       // $user->login('matheusviegasdesouza@gmail.com', 'admin');

       /* if(Session::has('id')){
            echo "ID: " . Session::get('nome');
        }else{
            echo "Vazio";
        }

        var_dump($user->isLogged());*/
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

        $usuarios = User::all();

        foreach ($usuarios as $u) {
          echo $u->nome . "<br />";
        }
    }

}
