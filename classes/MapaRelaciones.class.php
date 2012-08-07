<?php

class MapaRelaciones {
	
	private $_table_name = "mapas_relaciones";
	
	var $idMapaRelacion;
	var $usuarioId;
	
	public function save($usuarioId) {

		$result = new_query("INSERT INTO $this->_table_name (usuarioId, fechaAlta) VALUES('" .
							$usuarioId . "', " . 
							" SYSDATE() )");
		
		if (!$result) {
			throw new Exception("sql");
		} else {
			//por defecto dejo los valores cargados en el objeto actual
			$this->findById(inserted_id());
		}
	}
	
	public function findById($idMapaRelacion) {
		$query = "SELECT * FROM $this->_table_name WHERE idMapaRelacion='" . mysql_real_escape_string($idMapaRelacion)."'";
		return $this->find($query);
	}
	
	public function findAllByUsuario($idUsuario) {
		$query = "SELECT * FROM $this->_table_name WHERE usuarioId='" . mysql_real_escape_string($idUsuario)."'";
		return $this->findAll($query);
	}
	

	public function find($query) {
		$result = new_query($query);

		$resultado = FALSE;
		
		if ($row = new_fetch($result)) {
			$this->idMapaRelacion = $row['idMapaRelacion'];
			$this->usuarioId = utf8_encode($row['usuarioId']);
			
			$resultado = TRUE;
		}
		
		return $resultado;
	}
	
	public function findAll($query) {
		$result = new_query($query);
		$resultado = array();
		$usuario = NULL;
		
		while ($row = new_fetch($result)) {
			$mapa = new MapaRelaciones();
			$mapa->idMapaRelacion = $row['idMapaRelacion'];
			$mapa->usuarioId = utf8_encode($row['usuarioId']);

			array_push($resultado, $mapa);
		}

		return $resultado;
	}
	
	public function getAll($limite){
		$query = "SELECT * FROM $this->_table_name";
		if($limite != -1){
			$query .= " LIMIT 0,".$limite;
		}
		return $this->findAll($query);
	}
	
}

?>
