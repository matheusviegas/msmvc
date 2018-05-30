<?php

namespace App\Core\Helpers;

class Upload {
	
	public static function do($name, $dir = 'uploads/', $format, $tamanho = 500000){
		$arquivo = $dir . basename($_FILES[$name]["name"]);
		$ext = pathinfo($arquivo, PATHINFO_EXTENSION);
		$arquivo = $dir . strtotime("now") . "." . $ext;

		$uploadOk = TRUE;
		$ext = pathinfo($arquivo, PATHINFO_EXTENSION);
		$msg = "";
		
		if ($_FILES[$name]["size"] > $tamanho) {
		    $msg = "Tamanho do arquivo excede o limite permitido.";
		    $uploadOk = FALSE;
		}

		if(!in_array($ext, $format)){
			$uploadOk = FALSE;
			$msg = "Formato de arquivo inválido.";
		}

		if ($uploadOk) {
			if (move_uploaded_file($_FILES[$name]["tmp_name"], $arquivo)) {
			    $msg = "Arquivo enviado com sucesso.";
			} else {
			    $uploadOk = FALSE;
			    $msg = "Erro ao enviar arquivo.";
			}
		}

		return array('status' => $uploadOk, 'msg' => $msg);
	}
}
