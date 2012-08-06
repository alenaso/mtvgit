<?php	

	if ($_SERVER['SERVER_NAME'] == "www.posibl.com") {
		define('DB_DBUSE', "posibl"); #nombre de la base de datos.	
		define('DB_HOST', "localhost"); #nombre del host de la base de datos.
		define('DB_USERNAME', ""); #nombre del usuario para la conexion a la base de datos
		define('DB_PASSWORD', ""); #clave de conexion para el usuario DB_USERNAME		
	} else if ($_SERVER['SERVER_NAME'] == "posibl.qa.altodot.com") {
		//staging externo
		define('DB_DBUSE', "posibl"); #nombre de la base de datos.	
		define('DB_HOST', "localhost"); #nombre del host de la base de datos.
		define('DB_USERNAME', ""); #nombre del usuario para la conexion a la base de datos
		define('DB_PASSWORD', ""); #clave de conexion para el usuario DB_USERNAME
	} else {
		define('DB_DBUSE', "pdu1535_1"); #nombre de la base de datos.
		define('DB_HOST', "localhost"); #nombre del host de la base de datos.
		define('DB_USERNAME', "pdu1535"); #nombre del usuario para la conexion a la base de datos
		define('DB_PASSWORD', "56707757"); #clave de conexion para el usuario DB_USERNAME
	}
	
	function make_conexion() 
	{ 
	   if (!($link=mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD))) 
	   {
			printf ("Error en el recorriendo el Query, se produjo un error general!! (%s):%s<br>",$resource,mysql_error()); 
			exit();
	   }
	 
	   if (!mysql_select_db(DB_DBUSE,$link)) 
	   {
			echo 'Error abriendo la base de datos';
			exit(); 
	   }
		 
	  return $link; 
	}
	
	function new_fetch($resource)
	{
		return mysql_fetch_assoc($resource);
	}
	
	function new_query($query)
	{
		if (!($result=mysql_query($query))) 
		{
			printf ("Error en el Query, se produjo un error general!! (%s):%s<br>",$query, mysql_error()); 
			exit();
		} 
		return $result;
	}
	
	function inserted_id() {
		
		if (!($result = mysql_insert_id())) 
		{
			//printf ("Error en el Query, se produjo un error general!! (%s):%s<br>", 'Inserted ID', mysql_error()); 
			//exit();
		} 
		return $result;
		
	}
	
	function free_query($result)
	{
		if (!mysql_free_result($result))	
		{
			printf ("Error cerrando query!! :%s<br>",mysql_error()); 
			exit();
		} 
	}
	
	function close_conexion()
	{
		mysql_close();
	}

	function getDateNow() {
		return date('Y-m-d H:i:s',time());
	}	
?>
