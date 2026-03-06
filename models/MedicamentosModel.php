<?php
require_once "db.php";

class MedicamentosModel {
    private $db;

    public function __construct() {
        $this->db = conectar();
    }

    public function getAll($ownerId) {
        try {
            $sql = "SELECT * FROM medicamentos WHERE owner_usuario_id = :owner ORDER BY nombre ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([":owner" => $ownerId]);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener medicamentos.");
        }
    }

    public function getById($id, $ownerId) {
        try {
            $sql = "SELECT * FROM medicamentos WHERE id = :id AND owner_usuario_id = :owner LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([":id" => $id, ":owner" => $ownerId]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception("Error al buscar medicamento.");
        }
    }

    public function insertar($nombre, $dosis, $ownerUsuarioId) {
        try {
            $sql = "INSERT INTO medicamentos (nombre, dosis, owner_usuario_id)
                    VALUES (:nombre, :dosis, :owner)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ":nombre" => $nombre,
                ":dosis" => $dosis,
                ":owner" => $ownerUsuarioId
            ]);
        } catch (PDOException $e) {
            throw new Exception("Error al insertar medicamento.");
        }
    }

    public function update($id, $nombre, $dosis, $ownerId) {
        try {
            $sql = "UPDATE medicamentos
                    SET nombre = :nombre, dosis = :dosis
                    WHERE id = :id AND owner_usuario_id = :owner";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ":nombre" => $nombre,
                ":dosis" => $dosis,
                ":id" => $id,
                ":owner" => $ownerId
            ]);
        } catch (PDOException $e) {
            throw new Exception("Error al actualizar medicamento.");
        }
    }

    public function delete($id, $ownerId) {
        try {
            $sql = "DELETE FROM medicamentos WHERE id = :id AND owner_usuario_id = :owner";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([":id" => $id, ":owner" => $ownerId]);
        } catch (PDOException $e) {
            throw new Exception("Error al eliminar medicamento.");
        }
    }
}
