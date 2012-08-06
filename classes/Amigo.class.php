<?php

class Amigo {
	
	private $_table_name = "amigos";
	
	var $idAmigo;
	var $usuarioId;
	var $amigoFacebookID;
	var $nombre;
	
	private function findAll($query) {
		$result = new_query($query);

		$resultado = array();
		$amigo = NULL;
		
		while ($row = new_fetch($result)) {
			$amigo = new Amigo();
			
			$amigo->idAmigo = $row['idAmigo'];
			$amigo->usuarioId = $row['usuarioId'];
			$amigo->amigoFacebookID = $row['amigoFacebookID'];
			$amigo->nombre = $row['nombre'];
			
			array_push($resultado, $amigo);
		}
		
		return $resultado;
	}
	
	private function find($query) {
		$result = new_query($query);
		
		if ($row = new_fetch($result)) {
			$amigo = new Amigo();
			
			$this->idAmigo = $row['idAmigo'];
			$this->usuarioId = $row['usuarioId'];
			$this->amigoFacebookID = $row['amigoFacebookID'];
			$this->nombre = $row['nombre'];
			
			return true;
		}
		
		return false;
	}
	
	public function findAllByUserId($usuarioId) {
		$query = "SELECT * FROM $this->_table_name WHERE usuarioId=" . $usuarioId;
		
		return $this->findAll($query);
	}
	
	public function findAllByFBId($fbid, $search = NULL) {
		$query = "SELECT a.* FROM $this->_table_name AS a, registrados AS r WHERE a.usuarioId = r.idUsuario AND r.facebookId=" . $fbid;
		
		if ($search != NULL) {
			$query .= " AND a.nombre LIKE '%" . mysql_real_escape_string(utf8_decode($search)) . "%'";	
		}
		
		return $this->findAll($query);
	}
	
	public function findByNombre($nombre,$usuarioId) {
		$query = "SELECT * FROM $this->_table_name WHERE nombre = '".$nombre."' AND usuarioId=" . $usuarioId;
		return $this->find($query);
	}
	
	public function saveFriends($usuarioId, $amigos) {
		
		new_query("START TRANSACTION");
		new_query("DELETE FROM $this->_table_name WHERE usuarioId = " . $usuarioId);
		foreach ($amigos['data'] as $friend) {
			new_query("INSERT INTO $this->_table_name (usuarioId, amigoFacebookID, nombre) VALUES ('" . 
														$usuarioId . "', '" . 
														$friend['id'] . "', '" . 
														mysql_real_escape_string(utf8_decode($friend['name'])) . "')");
		}
		new_query("COMMIT");
	}
	
	public function isAmigo($usuarioId, $amigoFbId){
		$result = new_query("SELECT * FROM $this->_table_name WHERE usuarioId=".$usuarioId." AND amigoFacebookID=".$amigoFbId);
		if($row = new_fetch($result)){
			return true;
		} 
		return false;
	}
	
	public function findByBusqueda($usuarioId, $busqueda){
		$query = "SELECT * FROM $this->_table_name WHERE usuarioId=" . $usuarioId . " AND nombre LIKE '%" . $busqueda . "%'";
		
		return $this->findAll($query);
	}
	
}
?>