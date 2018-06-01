<h1>PAGINA DE ERRO</h1>

<?php 

if(\App\Core\Helpers\Session::has('flash')) {
	$msg = \App\Core\Helpers\Session::flash('flash');

	foreach($msg as $key => $val) {
		echo $val;
	}
}
?>
