<?php

namespace App\Core\Helpers;

class Format {
	
	public static function valor($valor, $simbolo = FALSE){
		return $simbolo ? "R$ " . number_format($valor, 2, ',', '') : number_format($valor, 2, ',', '');
	}

	public static function data($data, $formato = 'd/m/Y'){
		return date_format(date_create($data), $formato);
	}

	public static function data_hora($data){
		return date_format(date_create($pedido->datapedido), 'd/m/Y H:i:s');
	}

}
