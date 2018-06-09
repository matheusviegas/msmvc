<h1>PAGINA DE ERRO</h1>

<?php 

if(\App\Core\Libraries\Session::has('flash')) {
	$msg = \App\Core\Libraries\Session::flash('flash');

	foreach($msg as $key => $val) {
		echo $val;
	}
}
?>
