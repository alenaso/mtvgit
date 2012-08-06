<?php
	session_start();
	require_once("includes/conex.php");
	require_once("includes/config.php");
	include_once("includes/lib/facebook.php");
	include_once("classes/Usuario.class.php");
	include_once("classes/Anuario.class.php");
	
	$tipoImg = $_POST['tipoImg'];
	$ruta = explode('/',$_POST['ruta']);
	$nro = $_POST['nro'];
	
	if(isset($_SESSION["usuario"])){
		$user = unserialize($_SESSION["usuario"]);
	} else {
		die;
	}
	
	make_conexion();
	
	$anuario = new Anuario();
	$anuario->createNew($user->idUsuario);
		
	if($tipoImg == "anuario" && count($ruta) > 0){
		try {
			make_conexion();
			require_once("classes/ImagenAnuario.class.php");
			$imagenAnuario = new ImagenAnuario();
			$imagenAnuario->deleteByAnuarioIdAndRuta($anuario->idAnuario,$ruta[count($ruta)-1]);
			unlink($RUTA_FISICA_IMG_ANUARIO.$ruta);
			
			echo "ok";
			session_write_close();			
			
		} catch (Exception $e) {
			echo "error|".$e->getMessage();
		}
	} else {
		echo "error|incorrect params";
	}
		
?>