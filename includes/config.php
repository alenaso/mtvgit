<?php
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	
	if ($_SERVER['SERVER_NAME'] == "www.posibl.com") {
		// Datos de la apps de Facebook.
		$application_id = "";
		$secret = "";
		
		$URL_SITE = "";
		
	} else if ($_SERVER['SERVER_NAME'] == "mtvqa.dev.altodot.com") {
		// Datos de la apps de Facebook.
		$application_id = "";
		$secret = "";
		
		$URL_SITE = "http://mtvqa.dev.altodot.com/";
		$RUTA_IMG_ANUARIO = "uploadAnuario/";
		$RUTA_FISICA_IMG_ANUARIO = "uploadAnuario/";
		
		$RUTA_IMG_MAPA = "uploadMapa/";
		$RUTA_FISICA_IMG_MAPA = "uploadMapa/";

	} else {
		// Datos de la apps de Facebook.
		$application_id = "221364841318920";
		$secret = "2abfe567de705d0d56a44587c5b73c06";
		
		$URL_SITE = "http://www.nidodigital.com.ar/proyectos/mtv/";
		$RUTA_IMG_ANUARIO = "uploadAnuario/";
		$RUTA_FISICA_IMG_ANUARIO = "uploadAnuario/";
		
		$RUTA_IMG_MAPA = "uploadMapa/";
		$RUTA_FISICA_IMG_MAPA = "uploadMapa/";
	}
	
	//GLOBALES
	$g_categorias_anuario = array(0 => "Seleccione",
									1 => "Mis mejores amigos",
									2 => "Viajes inolvidables",
									3 => "Días de escuela",
									4 => "En el trabajo",
									5 => "Conciertos",
									6 => "De fiesta",
									7 => "Álbum familiar",
									8 => "Mascotas",
									9 => "Random"
								);
	
	$g_categorias_mapa = array(0 => "Seleccione",
								1 => "Aburrido/a",
								2 => "Alma de la fiesta",
								3 => "Amable",
								4 => "Antipático/a",
								5 => "Antisocial",
								6 => "Apasionado/a",
								7 => "Artista",
								8 => "Atractivo/a",
								9 => "Avasallante",
								10 => "Brillante",
								11 => "Buen alumno/a",
								12 => "Calculador/a",
								13 => "Cariñoso/a",
								14 => "Comprensivo/a",
								15 => "Cool",
								16 => "Creativo/a",
								17 => "Crítico/a",
								18 => "Culto/a",
								19 => "Detallista",
								20 => "Divertido/a",
								21 => "Egoísta",
								22 => "Enamoradizo/a",
								23 => "Entusiasta",
								24 => "Estrella deportiva",
								25 => "Exitoso/a",
								26 => "Extravagante",
								27 => "Extrovertido/a",
								28 => "Fiel",
								29 => "Frontal",
								30 => "Generoso/a",
								31 => "Gracioso/a",
								32 => "Hacker",
								33 => "Hipócrita",
								34 => "Hippie",
								35 => "Honesto/a",
								36 => "Humilde",
								37 => "Impaciente",
								38 => "Inadaptado/a",
								39 => "Infiel",
								40 => "Ingenioso/a",
								41 => "Inmaduro/a",
								42 => "Inseguro/a",
								43 => "Inteligente",
								44 => "Intenso/a",
								45 => "Intrépido/a",
								46 => "Introvertido/a",
								47 => "Irresponsable",
								48 => "Leal",
								49 => "Líder",
								50 => "Maduro/a",
								51 => "Mal/a alumno/a",
								52 => "Manipulador/a",
								53 => "Mentiroso/a",
								54 => "Místico/a",
								55 => "Modesto/a",
								56 => "Nerd",
								57 => "Obsesivo/a",
								58 => "Optimista",
								59 => "Paciente",
								60 => "Pacional",
								61 => "Perfil bajo",
								62 => "Pervertido/a",
								63 => "Pesimista",
								64 => "Popular",
								65 => "Protector/a",
								66 => "Querido/a",
								67 => "Racional",
								68 => "Realista",
								69 => "Rebelde",
								70 => "Respetado/a",
								71 => "Ridículo/a",
								72 => "Rudo/a",
								73 => "Seductor/a",
								74 => "Sensible",
								75 => "Simpático/a",
								76 => "Sincero/a",
								77 => "Soberbio/a",
								78 => "Sociable",
								79 => "Solidario/a",
								80 => "Stalker",
								81 => "Tímido/a",
								82 => "Valiente");


	//akamai
	/*$countryCode = 'ar';
	$headers = getallheaders();
	$akamaiHeader = $headers["X-Akamai-Edgescape"];
	if ($akamaiHeader != NULL) {
		$posStart = strpos($akamaiHeader,"country_code=") + 13;
		$len = 2;
		$countryCode = strtolower(substr($akamaiHeader, $posStart,$len));
	}
	
	$countryCode = strtoupper($countryCode);*/




//FUNCIONES	 *******************************************************************************************************************************************************************************
	function logError($message) {
		$myFile = "error_log.txt";
		$fh = fopen($myFile, 'a') or die("can't open file");
		fwrite($fh, $message . "\n");
		fclose($fh);
	}
	
	function GetImageFromUrl($link) {
 		$ch = curl_init();
 		curl_setopt($ch, CURLOPT_POST, 0);
 		curl_setopt($ch,CURLOPT_URL,$link);
 		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result=curl_exec($ch);
 		curl_close($ch);
 		return $result;
 	}
	function curPageURL() {
		 $pageURL = 'http';
		 if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		 $pageURL .= "://";
		 if ($_SERVER["SERVER_PORT"] != "80") {
		  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		 } else {
		  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		 }
		 return $pageURL;
	}
	
?>