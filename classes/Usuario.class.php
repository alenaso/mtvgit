<?php

class Usuario {
	
	private $_table_name = "usuarios";
	
	var $idUsuario;
	var $nombre;
	var $apellido;
	var $nombreCompleto;
	var $nacimiento;
	var $lugar;
	var $facebookId;
	var $imagen;
	var $sexo;
	var $email;
	
	public function save($fbid, $name, $first_name, $last_name, $nacimiento, $gender, $email, $location) {
		
		$fbpicture = "http://graph.facebook.com/" . $fbid . "/picture?type=normal";
		
		$fdn = strtotime($nacimiento);
		$birthday = date("Y", $fdn) . "-" . date("m", $fdn) . "-" . date("d", $fdn);
		
		$result = new_query("INSERT INTO $this->_table_name (facebookId, nombreCompleto, nombre, apellido, imagen, nacimiento, sexo, email, fechaAlta, IP, lugar) VALUES('" .
							$fbid . "','" . 
							mysql_real_escape_string(utf8_decode($name)) . "','" . 
							mysql_real_escape_string(utf8_decode($first_name)) . "','" . 
							mysql_real_escape_string(utf8_decode($last_name)) . "','" . 
							$fbpicture . "','" . 
							$birthday . "','" . 
							$gender . "','" . 
							$email . "',SYSDATE(), '" . 
							$_SERVER['REMOTE_ADDR'] . "','" .
							mysql_real_escape_string(utf8_decode($location)). "')");
		
		if (!$result) {
			if (mysql_errno() == 1586 || mysql_errno() == 1062) {
				throw new Exception("fbid");
			} else {
				throw new Exception("sql");
			}	
		} else {
			//por defecto dejo los valores cargados en el objeto actual
			$this->findById(inserted_id());
		}
	}
	
	public function findByFbId($facebookId) {
		$query = "SELECT * FROM $this->_table_name WHERE facebookId='" . mysql_real_escape_string($facebookId)."'";
		return $this->find($query);
	}
	
	public function findById($idUsuario) {
		$query = "SELECT * FROM $this->_table_name WHERE idUsuario='" . mysql_real_escape_string($idUsuario)."'";
		return $this->find($query);
	}
	
	public function findByName($name) {
		$query = "SELECT * FROM $this->_table_name WHERE nombreCompleto LIKE '%".$name."%'";
		return $this->findAll($query);
	}
		
	public function find($query) {
		$result = new_query($query);

		$resultado = FALSE;
		
		if ($row = new_fetch($result)) {
			$this->idUsuario = $row['idUsuario'];
			$this->facebookId = $row['facebookId'];
			$this->nombre = utf8_encode($row['nombre']);
			$this->apellido = utf8_encode($row['apellido']);
			$this->nombreCompleto = utf8_encode($row['nombreCompleto']);
			$this->nacimiento = utf8_encode($row['nacimiento']);
			$this->email = $row['email'];
			$this->imagen = $row['imagen'];
			$this->lugar = $row['lugar'];
			
			$resultado = TRUE;
		}
		
		return $resultado;
	}
	
	public function findAll($query) {
		$result = new_query($query);
		$resultado = array();
		$usuario = NULL;
		
		while ($row = new_fetch($result)) {
			$usuario = new Usuario();
			
			$usuario->idUsuario = $row['idUsuario'];
			$usuario->facebookId = $row['facebookId'];
			$usuario->nombre = utf8_encode($row['nombre']);
			$usuario->apellido = utf8_encode($row['apellido']);
			$usuario->nombreCompleto = utf8_encode($row['nombreCompleto']);
			$usuario->nacimiento = utf8_encode($row['nacimiento']);
			$usuario->email = $row['email'];
			$usuario->imagen = $row['imagen'];
			$usuario->lugar = $row['lugar'];

			array_push($resultado, $usuario);
		}

		return $resultado;
	}
	
	public function getAll(){
		$query = "SELECT * FROM $this->_table_name AS r";
		return $this->findAll($query);
	}
	
	public function findByBusqueda($name) {
		$this->findByName($name);
		return $this->findAll($query);
	}
	
}

?>
