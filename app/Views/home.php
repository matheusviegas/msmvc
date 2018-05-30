Sou a view home.php

<br /><br />

<?php base('home/salvar'); ?>

<br /><br />

<?php foreach($usuarios as $u){
	echo "Nome: " . $u['nome'] . ' ' . $u['sobrenome'] . '<br />';
}?>
