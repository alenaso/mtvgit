<?php

class Anuario {
	
	private $_table_name = "anuarios";
	
	var $idAnuario;
	var $categoriaId;
	var $usuarioId;
	var $publicado;
	
	public function save($categoriaId, $tags, $publicado) {

		$result = new_query("UPDATE $this->_table_name SET ".
							"categoriaId=".mysql_real_escape_string($categoriaId).", ".
							"amigos='".mysql_real_escape_string($tags)."', ".
							"publicado=".$publicado.", ".
							"fechaAlta=SYSDATE() ".
							"WHERE idAnuario=".$this->idAnuario);
	}
	
	public function createNew($idUsuario){
		$result = new_query("SELECT * FROM $this->_table_name WHERE usuarioId='".mysql_real_escape_string($idUsuario)."' AND publicado=0");
		if ($row = new_fetch($result)) {
			$this->findById($row["idAnuario"]);
		} else {
			$result = new_query("INSERT INTO $this->_table_name (categoriaId,usuarioId,fechaAlta,publicado) VALUES (0,".mysql_real_escape_string($idUsuario).",SYSDATE(),0)");
			$this->findById(mysql_insert_id());
		}
	}
	
	public function update(){
		$result = new_query("UPDATE $this->_table_name 
							SET categoriaId=".mysql_real_escape_string($this->categoriaId).", publicado=1, fechaAlta=SYSDATE() 
							WHERE usuarioId=".$this->usuarioId);
	}
	
	public function findById($idAnuario) {
		$query = "SELECT * FROM $this->_table_name WHERE idAnuario='" . mysql_real_escape_string($idAnuario)."'";
		return $this->find($query);
	}
	
	public function findAllByUsuario($idUsuario) {
		$query = "SELECT * FROM $this->_table_name WHERE publicado=1 AND usuarioId='" . mysql_real_escape_string($idUsuario)."' AND publicado=1";
		return $this->findAll($query);
	}
	

	public function find($query) {
		$result = new_query($query);

		$resultado = FALSE;
		
		if ($row = new_fetch($result)) {
			$this->idAnuario = $row['idAnuario'];
			$this->categoriaId = $row['categoriaId'];
			$this->usuarioId = utf8_encode($row['usuarioId']);
			$this->publicado = $row['publicado'];
			
			$resultado = TRUE;
		}
		
		return $resultado;
	}
	
	public function findAll($query) {
		$result = new_query($query);
		$resultado = array();
		$anuario = NULL;
		
		while ($row = new_fetch($result)) {
			$anuario = new Anuario();
			
			$anuario->idAnuario = $row['idAnuario'];
			$anuario->categoriaId = $row['categoriaId'];
			$anuario->usuarioId = utf8_encode($row['usuarioId']);
			$anuario->publicado = $row['publicado'];

			array_push($resultado, $anuario);
		}

		return $resultado;
	}
	
	public function getAll($limite){
		$query = "SELECT * FROM $this->_table_name WHERE publicado=1";
		if($limite != -1){
			$query .= " LIMIT 0,".$limite;
		}
		
		$listado = $this->findAll($query);
		//shuffle($listado);
		
		return $listado;
	}
	
	public function getRandom(){
		$result = new_query("SELECT count(*) FROM $this->_table_name");
		$row = new_fetch($result);
		
		$randomNumber = rand(0,$row[0]-1);
		$resultRand = new_query("SELECT * FROM $this->_table_name WHERE publicado=1 LIMIT 1 OFFSET ".$randomNumber);
		$row2 = new_fetch($result);
		
		return $this->findById($row2["idAnuario"]);
	}
	
}

?>
