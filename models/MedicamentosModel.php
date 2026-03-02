<?php
require_once "db.php";

class MedicamentosModel {
    private $db;

    public function __construct() {
        $this->db = conectar();
    }

    public function getAll() {
        try {
            $sql = "SELECT * FROM medicamentos";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener medicamentos.");
        }
    }

    public function getById($id) {
        try {
            $sql = "SELECT * FROM medicamentos WHERE id = :id LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([":id" => $id]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception("Error al buscar medicamento.");
        }
    }

    public function insertar($nombre, $dosis) {
        try {
            $sql = "INSERT INTO medicamentos (nombre, dosis) VALUES (:nombre, :dosis)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ":nombre" => $nombre,
                ":dosis" => $dosis
            ]);
        } catch (PDOException $e) {
            throw new Exception("Error al insertar medicamento.");
        }
    }

    public function update($med) {
        try {
            $sql = "UPDATE medicamentos SET nombre = :nombre, dosis = :dosis WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ":nombre" => $med->nombre,
                ":dosis" => $med->dosis,
                ":id" => $med->id
            ]);
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar medicamento.");
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM medicamentos WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([":id" => $id]);
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar medicamento.");
        }
    }

    public function borrar($id) {
        return $this->delete($id);
    }
}

