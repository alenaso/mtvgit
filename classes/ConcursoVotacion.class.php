<?php

class ConcursoVotacion {
	
	private $_table_name = "concurso_votacion";
	
	var $idConcursoVotacion;
	var $concursoId;
	var $fecha;
	var $IP;
	
	public function save($idConcurso){
		$ip = $_SERVER['REMOTE_ADDR'];
		$result = new_query("INSERT INTO $this->_table_name (concursoId, fecha, IP) VALUES(".mysql_real_escape_string($idConcurso).", SYSDATE() , ".$ip.")");
	}
	
	public function findByIpAndConcurso($idConcurso){
		$ip = $_SERVER['REMOTE_ADDR'];
		$fecha = "";
		
		$query = "SELECT * FROM $this->_table_name WHERE concursoId = ".mysql_real_escape_string($idConcurso)." AND IP='".$ip."' AND fecha<'".$fecha."'";
		if ($row = new_fetch($result)) {
			return TRUE;
		}
		
		return FALSE;
	}

}
?>