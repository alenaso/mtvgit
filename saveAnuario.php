<?php
	session_start();
	
	include_once("includes/conex.php");
	include_once("includes/config.php");
	include_once("includes/lib/facebook.php");
	include_once("includes/lib/Upload.class.php");
	include_once("classes/Usuario.class.php");
	
	$categoria = $_POST["categoria"];
	$tags = str_replace(" , ",",",$_POST["tags"]);
	$tags = str_replace(", ",",",$tags);
	$tags = str_replace(" ,",",",$tags);
	
	if(isset($_SESSION["usuario"])){
		if($categoria!=0 && $categoria!=""){
			
			include_once("classes/Amigo.class.php");
			include_once("classes/Anuario.class.php");
			
			make_conexion();
			$user = unserialize($_SESSION["usuario"]);
			
			$anuario = new Anuario();
			$anuario->createNew($user->idUsuario);
			
			$tagsAmigos = explode(",",trim($tags));
		
			$amigo = new Amigo();
			$amigosUsuario = $amigo->findAllByUserId($user->idUsuario);
			$tagueoDb = array();
			$tagueoNombres = array();
			foreach($amigosUsuario as $am){
				if(in_array($am->nombre,$tagsAmigos)){
					array_push($tagueoDb,$am->amigoFacebookID);
					array_push($tagueoNombres, $am->nombre);
				}
			}

			$tagueoResultado = implode(",",$tagueoDb);
			$tagueoNombresString = implode(",",$tagueoNombres);
			$anuario->save($categoria,$tagueoResultado,1);
			
			//CREO ALBUM Y SUBO IMAGEN DEL ANUARIO A FACEBOOK
			// Create our Application instance.
			$facebook = new Facebook(array(
			  'appId'  => $application_id,
			  'secret' => $secret
			));
			//At the time of writing it is necessary to enable upload support in the Facebook SDK, you do this with the line:
			$facebook->setFileUploadSupport(true);
			$photo_details = array(
				'message'=> 'Nuevo anuario en MTV'
			);
			$file = 'images/imgGenerica.anuario.jpg';
			$photo_details['image'] = '@' . realpath($file);
			$upload_photo = $facebook->api('/'.$user->facebookId.'/photos', 'post', $photo_details);
		
			echo "ok|".$tagueoResultado."|".$tagueoNombresString."|anuario.php?pid=last";
			
		} else {
			echo "error|Faltan parámetros obligatorios";
		}
		
	} else {
		echo "error|redirect";
	}

	session_write_close();
?>