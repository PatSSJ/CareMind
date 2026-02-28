<?php
require_once "models/db.php";

class PersonasModel
{

	private $db;

	public function __construct()
	{
		try {
			$this->db = conectar();
		} catch (PDOException $e) {
			$this->error_fatal("Error al conectar con la base de datos:" . $e->getMessage());
		}
	}

	public function getAll()
	{
		try {
			$sql = "SELECT * FROM personas";
			$consuta = $this->db->query($sql);
			return $consuta->fetchAll();
		} catch (PDOException $e) {
			error_fatal("Error al obtener el listado:" . $e->getMessage());
		}
	}

	public function insertar($nombre, $dni, $telefono, $direccion)
	{
		try {
			$sql = "INSERT INTO personas (nombre, dni, telefono, direccion) VALUES (:nombre, :dni, :telefono, :direccion)";

			$stmt = $this->db->prepare($sql);
			$stmt->execute([
				'nombre' => $nombre,
				'dni' => $dni,
				'telefono' => $telefono,
				'direccion' => $direccion
			]);

			return true;
		} catch (PDOException $e) {
			error_fatal("Error al insertar el registro:" . $e->getMessage());
		}
	}

	public function delete($id)
	{
		try {
			$sql = "DELETE FROM personas WHERE id = :id";
			$stmt = $this->db->prepare($sql);
			$stmt->execute([':id' => $id]);

			return true;
		} catch (PDOException $e) {
			error_fatal("Error al eliminar el registro:" . $e->getMessage());
		}
	}
}

