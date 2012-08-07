<?php

class ConcursoOpcion {
	
	private $_table_name = "concurso_opcion";
	
	var $idConcursoOpcion;
	var $concursoId;
	var $imagen;
	var $votos;
	
	public function find($query) {
		$result = new_query($query);

		$resultado = FALSE;
		
		if ($row = new_fetch($result)) {
			$this->idConcursoOpcion = $row['idConcursoOpcion'];
			$this->concursoId = utf8_encode($row['concursoId']);
			$this->imagen = utf8_encode($row['imagen']);
			$this->votos = $row['votos'];
			
			$resultado = TRUE;
		}
		
		return $resultado;
	}
	
	public function findAll($query) {
		$result = new_query($query);
		$resultado = array();
		$opcion = NULL;
		
		while ($row = new_fetch($result)) {
			$opcion = new ConcursoOpcion();
			
			$opcion->idConcursoOpcion = $row['idConcursoOpcion'];
			$opcion->concursoId = utf8_encode($row['concursoId']);
			$opcion->imagen = utf8_encode($row['imagen']);
			$opcion->votos = $row['votos'];

			array_push($resultado, $opcion);
		}

		return $resultado;
	}
	
	public function getOpciones($idConcurso){
		$query = "SELECT * FROM $this->_table_name WHERE concursoId = ".mysql_real_escape_string($idConcurso);
		return $this->findAll($query);
	}

	public function getOpcionGanadora($idConcurso){
		$query = "SELECT * FROM $this->_table_name WHERE concursoId = ".mysql_real_escape_string($idConcurso) ." ORDER BY votos DESC LIMIT 0,1";
		return $this->find($query);
	}
	
}
?>