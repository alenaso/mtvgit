<?php

class Concurso {
	
	private $_table_name = "concurso";
	
	var $idConcurso;
	var $nombre;
	var $texto;
	var $fechaInicio;
	var $fechaFin;
	
	public function findById($idConcurso) {
		$query = "SELECT * FROM $this->_table_name WHERE idConcurso='" . mysql_real_escape_string($idConcurso)."'";
		return $this->find($query);
	}
	
	public function find($query) {
		$result = new_query($query);

		$resultado = FALSE;
		
		if ($row = new_fetch($result)) {
			$this->idConcurso = $row['idConcurso'];
			$this->nombre = utf8_encode($row['nombre']);
			$this->texto = utf8_encode($row['texto']);
			$this->fechaInicio = $row['fechaInicio'];
			$this->fechaFin = $row['fechaFin'];
			
			$resultado = TRUE;
		}
		
		return $resultado;
	}
	
	public function findAll($query) {
		$result = new_query($query);
		$resultado = array();
		$concurso = NULL;
		
		while ($row = new_fetch($result)) {
			$concurso = new Concurso();
			
			$concurso->idConcurso = $row['idConcurso'];
			$concurso->nombre = utf8_encode($row['nombre']);
			$concurso->texto = utf8_encode($row['texto']);
			$concurso->fechaInicio = $row['fechaInicio'];
			$concurso->fechaFin = $row['fechaFin'];

			array_push($resultado, $concurso);
		}

		return $resultado;
	}
	
	public function getAll(){
		$query = "SELECT * FROM $this->_table_name";
		return $this->findAll($query);
	}
	
	public function getActive(){
		$hoy = date("Y-m-d h:i:s");
		$query = "SELECT * FROM $this->_table_name WHERE fechaInicio <= '".$hoy."' AND fechaFin > '".$hoy."'";
		return $this->find($query);
	}
	
}
?>