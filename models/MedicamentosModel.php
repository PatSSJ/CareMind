<?php
require_once "models/db.php";

class MedicamentosModel {

    private $db;

    public function __construct() {
        $this->db = conectar();
    }

    public function getAll() {
        try {
            $sql = "SELECT * FROM medicamentos";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Error al obtener medicamentos: " . $e->getMessage());
        }
    }

    public function getById($id) {
        try {
            $sql = "SELECT * FROM medicamentos WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Error al obtener medicamento: " . $e->getMessage());
        }
    }

    public function insertar($nombre, $dosis) {
        try {
            $sql = "INSERT INTO medicamentos (nombre, dosis) VALUES (:nombre, :dosis)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':dosis'  => $dosis
            ]);

            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al crear medicamento: " . $e->getMessage());
        }
    }

    public function update($med) {
        try {
            $sql = "UPDATE medicamentos SET nombre = :nombre, dosis  = :dosis WHERE id = :id";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':nombre' => $med->nombre,
                ':dosis'  => $med->dosis,
                ':id'     => $med->id
            ]);

            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al editar medicamento: " . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM medicamentos WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al borrar medicamento: " . $e->getMessage());
        }
    }
}

