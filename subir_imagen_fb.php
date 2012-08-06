<?php
	session_start();
	include_once("includes/conex.php");
	include_once("includes/config.php");
	include_once("includes/lib/Upload.class.php");
	include_once("classes/Usuario.class.php");
	
	function obtenerImagen($url, $tipoFoto, $user, $urlBaseImg, $dirUpload) {
		if($result = GetImageFromUrl($url)){
			$url_parts = explode("/",$url);
			$savefile = fopen($dirUpload.'/'.$url_parts[count($url_parts)-1], 'w');
			fwrite($savefile, $result);
			fclose($savefile);
			
			$tam = getimagesize($dirUpload.'/'.$url_parts[count($url_parts)-1]);
			
			if($tipoFoto == "anuario") {
				include_once("classes/Anuario.class.php");
				include_once("classes/ImagenAnuario.class.php");
				
				$anuario = new Anuario();
				$anuario->createNew($user->idUsuario);
				$imagenAnuario = new ImagenAnuario();
				
				$cant = $imagenAnuario->getCantByAnuarioId($anuario->idAnuario);
				if($cant < 5) {
					$imagenAnuario = new ImagenAnuario();
					$imagenAnuario->setValues($anuario->idAnuario,$url_parts[count($url_parts)-1],$tam[0],$tam[1]);
					$imagenAnuario->save();
					$cant++;

					$mensaje = "ok|" . $urlBaseImg . $url_parts[count($url_parts)-1] . "|" . $cant . "|" . $tam[0] . "|" . $tam[1];
				} else {
					$mensaje = "error|No se permiten subir mas de 5 imagenes";
				}
				
			} elseif($tipoFoto == "mapa") {
				
			}
								
			return $mensaje;
		} else {
			return "error|Error guardando la imagen.";
		}
	}


	$tipoFoto = $_POST["tipoFoto"];
	$url = $_POST["url"];
	if(isset($_SESSION["usuario"])) {
		if($url != ""){
			$user = unserialize($_SESSION["usuario"]);
			$url_parts = explode("/",$url);
			make_conexion();
			
			$mensaje = obtenerImagen($url, $tipoFoto, $user, $URL_SITE . $RUTA_IMG_ANUARIO, $RUTA_FISICA_IMG_ANUARIO);
			session_write_close();
		} else {
			$mensaje = "error|Invalid url.";
		}
	} else {
		$mensaje = "error|redirect";
	}
	
	echo $mensaje."|".$tipoFoto;
?>