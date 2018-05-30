erro 404 personalizado<br /><br/>

<?php
	if(\App\Core\Helpers\Session::has('mensagem')){
		echo \App\Core\Helpers\Session::flash('mensagem');
	}else{
		echo "sem sessao";
	}
?>
