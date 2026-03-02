<?php
require_once "db.php";

class AlarmasModel {
    private $db;

    public function __construct() {
        $this->db = conectar();
    }

    public function getAll() {
        try {
            $sql = "SELECT * FROM alarmas ORDER BY fecha ASC";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception("Error al obtener alarmas.");
        }
    }

    public function getById($id) {
        try {
            $sql = "SELECT * FROM alarmas WHERE id = :id LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([":id" => $id]);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception("Error al buscar alarma.");
        }
    }

    public function insertar($persona_id, $fecha, $medicacion_id) {
        try {
            $sql = "INSERT INTO alarmas (persona_id, fecha, medicacion_id, apagada)
                    VALUES (:persona_id, :fecha, :medicacion_id, 0)";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ":persona_id" => $persona_id,
                ":fecha" => $fecha,
                ":medicacion_id" => $medicacion_id
            ]);
        } catch (PDOException $e) {
            throw new Exception("No se pudo crear la alarma.");
        }
    }

    public function update($id, $fecha, $medicacion_id, $apagada) {
        try {
            $sql = "UPDATE alarmas
                    SET fecha = :fecha, medicacion_id = :medicacion_id, apagada = :apagada
                    WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ":fecha" => $fecha,
                ":medicacion_id" => $medicacion_id,
                ":apagada" => $apagada,
                ":id" => $id
            ]);
        } catch (PDOException $e) {
            throw new Exception("No se pudo actualizar la alarma.");
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM alarmas WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([":id" => $id]);
        } catch (PDOException $e) {
            throw new Exception("No se pudo eliminar la alarma.");
        }
    }

    public function apagar($id) {
        try {
            $sql = "UPDATE alarmas SET apagada = 1 WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([":id" => $id]);
        } catch (PDOException $e) {
            throw new Exception("No se pudo apagar la alarma.");
        }
    }
}
