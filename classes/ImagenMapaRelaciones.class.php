<?php

class ImagenMapaRelaciones {
	
	private $_table_name = "imagenes_mapa_relaciones";
	
	var $idImagenMapaRelaciones;
	var $mapa_relacionId;
	var $caracteristicaId;
	var $amigoFbId;
	var $nombreAmigo;
	var $ruta;
	
	public function setValues($mapa_relacionId, $ruta, $caracteristicaId, $amigoFbId, $nombreAmigo) {
		$this->mapa_relacionId = $mapa_relacionId;
		$this->ruta = $ruta;
		$this->caracteristicaId = $caracteristicaId;
		$this->amigoFbId = $amigoFbId;
		$this->nombreAmigo = $nombreAmigo;
	}
	
	public function save() {
		new_query("INSERT INTO $this->_table_name (mapa_relacionId, ruta, caracteristicaId, amigoFbId, nombreAmigo)
					VALUES (" . mysql_real_escape_string($this->mapa_relacionId) . ", '" . mysql_real_escape_string($this->ruta) . "', ".mysql_real_escape_string($this->caracteristicaId).", '".mysql_real_escape_string($this->amigoFbId)."', '".mysql_real_escape_string($this->nombreAmigo)."')");
	}
	
	private function find($query){
		$result = new_query($query);

		$resultado = FALSE;
		
		if ($row = new_fetch($result)) {
			$this->idImagenMapaRelaciones = $row['idImagenMapaRelaciones'];
			$this->mapa_relacionId = $row['mapa_relacionId'];
			$this->ruta = $row['ruta'];
			$this->caracteristicaId = $row['caracteristicaId'];
			$this->amigoFbId = $row['amigoFbId'];
			$this->nombreAmigo = $row['nombreAmigo'];
		
			$resultado = TRUE;
		}
		
		return $resultado;
	}
	
	private function findAll($query){
		$result = new_query($query);
		$resultado = array();
		$imagenMapa = NULL;
		
		while($row = new_fetch($result)) {
			$imagenMapa = new ImagenMapaRelaciones();
			$imagenMapa->idImagenMapaRelaciones = $row['idImagenMapaRelaciones'];
			$imagenMapa->mapa_relacionId = $row['mapa_relacionId'];
			$imagenMapa->ruta = $row['ruta'];
			$imagenMapa->caracteristicaId = $row['caracteristicaId'];
			$imagenMapa->amigoFbId = $row['amigoFbId'];
			$imagenMapa->nombreAmigo = $row['nombreAmigo'];
		
			array_push($resultado,$imagenMapa);
		}
		
		return $resultado;
	}
	
	public function findById($idImagenMapaRelaciones) {
		$query = "SELECT i.* FROM $this->_table_name AS i WHERE i.idImagenMapaRelaciones=" . $idImagenMapaRelaciones;
		return $this->find($query);
	}
	
	public function findAllByMapaId($mapa_relacionId) {
		$query = "SELECT i.* FROM $this->_table_name AS i WHERE i.mapa_relacionId=" . $mapa_relacionId;
		return $this->findAll($query);
	}
	
	public function getRutaImagen() {
		return "./uploadMapa/" . $this->ruta;	
	}
	
}

?>