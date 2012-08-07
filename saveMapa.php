<?php
	session_start();
	
	include_once("includes/conex.php");
	include_once("includes/config.php");
	include_once("includes/lib/facebook.php");
	include_once("includes/lib/Upload.class.php");
	include_once("classes/Usuario.class.php");
	include_once("classes/Amigo.class.php");
	include_once("classes/MapaRelaciones.class.php");
	include_once("classes/ImagenMapaRelaciones.class.php");
	
	if(isset($_SESSION["usuario"])){
		$caracs = array();
		$amigos = array();
		$idsAmigos = array();
		
		$validos = 0;
		$error = false;
		
		make_conexion();
		$user = unserialize($_SESSION["usuario"]);
			
		for($i=1; $i<=6; $i++){
			$amigo = new Amigo();
			
			if($_POST["caracteristica".$i] != 0 && $_POST["tagsAmigo".$i] != "" && $amigo->findByNombre($_POST["tagsAmigo".$i],$user->idUsuario)){
				$validos++;
				$caracs[] = $_POST["caracteristica".$i];
				$amigos[] = $_POST["tagsAmigo".$i];
				$idsAmigos[] = $amigo->amigoFacebookID;
			}
			if($_POST["tagsAmigo".$i] != "" && !$amigo->findByNombre($_POST["tagsAmigo".$i],$user->idUsuario)){
				$error = true;
			}
		}
		
		if($validos > 0 && !$error){
			$mapa = new MapaRelaciones();
			$mapa->save($user->idUsuario);
			
			for($i=0; $i<count($caracs); $i++){
				if($caracs[$i] != 0 && $amigos[$i] != ''){
					$imgMapa = new ImagenMapaRelaciones();
					$imageData = get_headers("https://graph.facebook.com/".$idsAmigos[$i]."/picture?type=square",1);
					$url = $imageData["Location"];
					
					$result = GetImageFromUrl($url);
					$url_parts = explode("/",$url);
					$savefile = fopen($RUTA_FISICA_IMG_MAPA.'/'.$url_parts[count($url_parts)-1], 'w');
					fwrite($savefile, $result);
					fclose($savefile);
					
					$imgMapa->setValues($mapa->idMapaRelacion,$url_parts[count($url_parts)-1],$caracs[$i],$idsAmigos[$i],$amigos[$i]);
					$imgMapa->save();
				}
			}
				
			//CREO ALBUM Y SUBO IMAGEN DEL ANUARIO A FACEBOOK
			// Create our Application instance.
			$facebook = new Facebook(array(
			  'appId'  => $application_id,
			  'secret' => $secret
			));
			//At the time of writing it is necessary to enable upload support in the Facebook SDK, you do this with the line:
			$facebook->setFileUploadSupport(true);
			$photo_details = array(
				'message'=> 'Nuevo mapa de relaciones en MTV Ultimo Año'
			);
			$file = 'images/imgGenerica.mapa.jpg';
			$photo_details['image'] = '@' . realpath($file);
			  
			$upload_photo = $facebook->api('/'.$user->facebookId.'/photos', 'post', $photo_details);
			$idsString = implode(",",$idsAmigos);
			$nombresString = implode(",",$amigos);
			echo "ok|".$idsString."|".$nombresString."|mapa_relaciones.php?pid=last";
		
		} else {
			echo "error|Parámetros incorrectos";
		}
	}else {
		echo "error|redirect";
	}
	session_write_close();
?>