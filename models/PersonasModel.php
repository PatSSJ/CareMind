<?php
require_once "db.php";

class PersonasModel {
    private $db;

    public function __construct() {
        $this->db = conectar();
    }

    public function getAll() {
        try {
            $sql = "SELECT * FROM personas ORDER BY nombre ASC";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener personas.");
        }
    }

    public function insertar($nombre, $dni, $telefono, $direccion, $nss) {
        try {
            $sql = "INSERT INTO personas (nombre, dni, telefono, direccion, num_seguridad_social)
                    VALUES (:nombre, :dni, :telefono, :direccion, :nss)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ":nombre" => $nombre,
                ":dni" => $dni,
                ":telefono" => $telefono,
                ":direccion" => $direccion,
                ":nss" => $nss
            ]);
        } catch (PDOException $e) {
            throw new Exception("Error al insertar persona.");
        }
    }

    public function borrar($id) {
        try {
            $sql = "DELETE FROM personas WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([":id" => $id]);
        } catch (PDOException $e) {
            throw new Exception("No se pudo eliminar el registro.");
        }
    }

    public function getById($id) {
        try {
            $sql = "SELECT * FROM personas WHERE id = :id LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([":id" => $id]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception("Error al buscar la persona.");
        }
    }
}


