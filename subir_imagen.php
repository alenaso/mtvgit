<?php
	session_start();
	
	include_once("includes/conex.php");
	include_once("includes/config.php");
	include_once("includes/lib/Upload.class.php");
	include_once("classes/Usuario.class.php");
	
	$tipoFoto = $_POST["tipoFoto"];
	
	if(isset($_SESSION["usuario"])){
		$user = unserialize($_SESSION["usuario"]);
	} else {
		die;
	}
	
	make_conexion();

	if($tipoFoto == "anuario" && isset($_FILES['imgAnuario']) && $_FILES['imgAnuario'] != NULL){
		$imagen = $_FILES['imgAnuario'];
		$dirUpload = $RUTA_FISICA_IMG_ANUARIO;
	} elseif($tipoFoto == "mapa" && isset($_FILES['imgMapa']) && $_FILES['imgMapa'] != NULL){ 
		$imagen = $_FILES['imgMapa'];
		$dirUpload = $RUTA_FISICA_IMG_MAPA;
	} 
	
	if(!isset($mensaje)){
		if (isset($imagen) && $imagen != NULL) {
			$imagen['name'] = str_replace("/", "", $imagen['name']);
			$imagen['name'] = str_replace("..", "", $imagen['name']);
			$imagen['name'] = str_replace("php", "", $imagen['name']);
			$upload = $imagen;
			
			list( $source_width, $source_height, $source_type ) = getimagesize( $upload['tmp_name'] );
			
			$tipo_valido = FALSE;
			
			switch ( $source_type ) {
				case IMAGETYPE_GIF:
				case IMAGETYPE_JPEG:
				case IMAGETYPE_PNG:
				  $tipo_valido = TRUE;
				  break;
			}
			
			if (Kohana_Upload::not_empty($upload) && Kohana_Upload::valid($upload)) {
	
				if (Kohana_Upload::type($upload, array('jpg', 'gif', 'jpeg', 'png')) && $tipo_valido) {
	
					if (Kohana_Upload::size($upload, '1M')) {
	
						try {
							$filename = Kohana_Upload::save($upload, NULL, $dirUpload);
							if ($filename != FALSE) {
	
								$file_parts = pathinfo($filename);
								$basename = basename($filename, '.' . $file_parts['extension']);
	
								//$bigger_file = str_replace($basename, $basename . "_original", $filename);
								//$imagen->resizeProportionalImage(159, 178, $filename, $bigger_file);
								//$imagen->resizeProportionalImage(68, 75, $filename, $filename);
								
								if($tipoFoto == "anuario"){
									include_once("classes/Anuario.class.php");
									include_once("classes/ImagenAnuario.class.php");
									$anuario = new Anuario();
									$anuario->createNew($user->idUsuario);
									$imagenAnuario = new ImagenAnuario();

									$cant = $imagenAnuario->getCantByAnuarioId($anuario->idAnuario);
									if($cant < 5) {
										$imagenAnuario = new ImagenAnuario();
										$imagenAnuario->setValues($anuario->idAnuario,$basename . '.' . $file_parts['extension'],$source_width, $source_height);
										$imagenAnuario->save();
										$cant++;
		
										$mensaje = "ok|" . $URL_SITE . $RUTA_IMG_ANUARIO . $basename . '.' . $file_parts['extension'] . "|" . $cant . "|" . $source_width . "|" . $source_height;
									} else {
										$mensaje = "error|No se permiten subir mas de 5 imagenes";
									}
								} elseif($tipoFoto == "mapa"){
									include_once("classes/MapaRelaciones.class.php");
									include_once("classes/ImagenMapaRelaciones.class.php");
									
									
									
								}
							} else {
								$mensaje = "error|Error guardando la imagen";	
							}
							
						} catch (Exception $e) {
							$mensaje = "error|".$e->getMessage();
						}
						
					} else {
						$mensaje = "error|Max filesize 1 MB";	
					}
					
				} else {
					$mensaje = "error|Solo se permiten extensiones gif, png, jpg";	
				}
			
			} else {
				$mensaje = "error|Error guardando la imagen.";
			}
		} else {
			$mensaje = "error|No hay imagen para guardar.";
		}
	}
	
	session_write_close();
	
?>
<script type="text/javascript">
	window.parent.imageUploadResult('<?php echo $mensaje."|".$tipoFoto ?>');
</script>

