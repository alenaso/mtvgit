<?php
	session_start();
	include_once("includes/conex.php");
	include_once("includes/config.php");
	include_once("classes/Usuario.class.php");
	include_once("classes/Amigo.class.php");
	include_once("includes/lib/facebook.php");
	
	make_conexion();
	
	// Create our Application instance.
    $facebook = new Facebook(array(
      	'appId'  => $application_id,
	    'secret' => $secret
    ));
	
	$fbid = $_POST["fbid"];
	$nombre_completo = $_POST["nombre_completo"];
	$nombre = $_POST["nombre"];
	$apellido = $_POST["apellido"];
	$sexo = $_POST["sexo"];
	$nacimiento = $_POST["nacimiento"];
	$email = $_POST["email"];
	$location = $_POST["location"]["name"];
	
	$user = new Usuario();
	
	try {
		if($fbid != "") {
			$nuevo = 0;
			if(! $user->findByFbId($fbid)){
				$user->save($fbid, $nombre_completo, $nombre, $apellido, $nacimiento, $sexo, $email, $location);
				$user->findByFbId($fbid);
				$nuevo = 1;
			}
			//guardo los amigos, y los guardo cada vez que entra para actualizar el listado
			$fbfriends = $facebook->api('/me/friends?fields=id,name');
			$amigo = new Amigo();
			$amigo->saveFriends($user->idUsuario, $fbfriends);

			$_SESSION["usuario"] = serialize($user);
			
			echo "ok|home.php|".$nuevo."|".$user->nombreCompleto;
			
		} else {
			echo "error";
		}
		
	} catch (Exception $e) {
		if ($e->getMessage() == "fbid") {
			echo "error|fbid";	
		} else {
			echo "error|error";
		}
	}
	
?>