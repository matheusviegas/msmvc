<?php

namespace App\Core\Libraries;

use App\Core\{Config, Language};

class Upload {
	
	public static function doUpload($name, $uploadOptions = []){
		$lang = new Language;

		$dir = !empty($uploadOptions['dir']) ? $uploadOptions['dir'] : Config::get('default_upload_dir');
		$max_size = !empty($uploadOptions['max_size']) ? $uploadOptions['max_size'] : Config::get('max_file_size');
		$extensions = !empty($uploadOptions['extensions']) && is_array($uploadOptions['extensions']) ? $uploadOptions['extensions'] : Config::get('whitelist_extensions');

		$file_path = $dir . basename($_FILES[$name]["name"]);
		$ext = pathinfo($file_path, PATHINFO_EXTENSION);
		$filename = strtotime("now") . "." . $ext;
		$file_path = $dir . $filename;

		$uploadOk = TRUE;
		$msg = "";
		
		if ($_FILES[$name]["size"] > $max_size) {
		    $msg = $lang->get('max_file_size_overreached', true);
		    $uploadOk = FALSE;
		}

		if(!in_array(strtolower($ext), $extensions)){
			$uploadOk = FALSE;
			$msg = $lang->get('file_format_not_allowed', true);
		}

		if ($uploadOk) {
			if (move_uploaded_file($_FILES[$name]["tmp_name"], $file_path)) {
			    $msg = $lang->get('upload_success', true);
			} else {
			    $uploadOk = FALSE;
			    $msg = $lang->get('upload_error', true);
			}
		}

		return array('status' => $uploadOk, 'msg' => $msg, 'filename' => $filename);
	}

}
