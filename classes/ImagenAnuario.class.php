<?php

class ImagenAnuario {
	
	private $_table_name = "imagenes_anuario";
	
	var $idImagenAnuario;
	var $anuarioId;
	var $ruta;
	var $width;
	var $height;
	
	public function setValues($anuarioId, $ruta, $width, $height) {
		$this->anuarioId = $anuarioId;
		$this->ruta = $ruta;
		$this->width = $width;
		$this->height = $height;
	}
	
	public function save() {
		new_query("INSERT INTO $this->_table_name (anuarioId, ruta, width, height)
					VALUES (" . mysql_real_escape_string($this->anuarioId) . ", '" . mysql_real_escape_string($this->ruta) . "', '".$this->width."', '".$this->height."')");
	}
	
	public function deleteByAnuarioIdAndRuta($anuarioId, $ruta){
		new_query("DELETE FROM $this->_table_name WHERE anuarioId=" . $anuarioId . " AND ruta='" . $ruta . "'");
	}
	
	public function deleteByAnuarioId($anuarioId){
		new_query("DELETE FROM $this->_table_name WHERE anuarioId=" . $anuarioId);
	}
	
	private function find($query){
		$result = new_query($query);

		$resultado = FALSE;
		
		if ($row = new_fetch($result)) {
			$this->idImagenAnuario = $row['idImagenAnuario'];
			$this->anuarioId = $row['anuarioId'];
			$this->ruta = $row['ruta'];
			$this->width = $row['width'];
			$this->height = $row['height'];
		
			$resultado = TRUE;
		}
		
		return $resultado;
	}
	
	private function findAll($query){
		$result = new_query($query);
		$resultado = array();
		$imagenAnuario = NULL;
		
		while($row = new_fetch($result)) {
			$imagenAnuario = new ImagenAnuario();
			$imagenAnuario->idImagenAnuario = $row['idImagenAnuario'];
			$imagenAnuario->anuarioId = $row['anuarioId'];
			$imagenAnuario->ruta = $row['ruta'];
			$imagenAnuario->width = $row['width'];
			$imagenAnuario->height = $row['height'];
		
			array_push($resultado,$imagenAnuario);
		}
		
		return $resultado;
	}
	
	public function findById($idImagenAnuario) {
		$query = "SELECT i.* FROM $this->_table_name AS i WHERE i.idImagenAnuario=" . $idImagenAnuario;
		return $this->find($query);
	}
	
	public function findAllByAnuarioId($anuarioId) {
		$query = "SELECT i.* FROM $this->_table_name AS i WHERE i.anuarioId=" . $anuarioId;
		return $this->findAll($query);
	}
	
	public function getCantByAnuarioId($anuarioId) {
		$result = new_query("SELECT count(*) as cant FROM $this->_table_name AS i WHERE i.anuarioId=" . $anuarioId);
		$row = new_fetch($result);
		return $row["cant"];
	}
	
	public function getRutaImagen() {
		return "./uploadAnuario/" . $this->ruta;	
	}
	
}

?>