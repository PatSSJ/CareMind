<?php
require_once "models/db.php";

class personas_model {

	private $db;

	public function __construct() { 
		 $this->db = conectar();
	}

	public function get_personas() {
		$sql = "SELECT * FROM personas";
		$consulta = $this->db->query($sql);
		return $consulta->fetchAll();
	}

	public function insertar_persona($nombre, $dni, $telefono, $direccion) {

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
}

?>
