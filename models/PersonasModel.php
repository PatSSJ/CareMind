<?php
require_once "models/db.php";

class PersonasModel {

	private $db;

	public function __construct() { 
		 $this->db = conectar();
	}

	public function getAll() {
		$sql = "SELECT * FROM personas";
		$consulta = $this->db->query($sql);
		return $consulta->fetchAll();
	}

	public function insertar($nombre, $dni, $telefono, $direccion) {

        $sql = "INSERT INTO personas (nombre, dni, telefono, direccion) VALUES (:nombre, :dni, :telefono, :direccion)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            'nombre' => $nombre,
            'dni' => $dni,
            'telefono' => $telefono,
            'direccion' => $direccion
        ]);

	return true;
	}
	
	public function delete($id) {

		$sql = "DELETE FROM personas WHERE id = :id";
		$stmt = $this->db->prepare($sql);
		$stmt->execute([':id' => $id]);

		return true;
	}
}

?>
