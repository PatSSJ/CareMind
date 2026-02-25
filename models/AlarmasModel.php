<?php
require_once "models/db.php";

class AlarmasModel {

    private $db;

    public function __construct() {
        $this->db = conectar();
    }

    public function getAll() {
        try {
            $sql = "SELECT * FROM alarmas";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            throw new Exception("Error al obtener alarmas: " . $e->getMessage());
        }
    }

    public function getById($id) {
        try {
            $sql = "SELECT * FROM alarmas WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            throw new Exception("Error al obtener la alarma: " . $e->getMessage());
        }
    }

    public function insertar($fecha, $medicacion_id) {
        try {
            $sql = "INSERT INTO alarmas (fecha, medicacion_id, apagada) VALUES (:fecha, :medicacion_id, 0)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':fecha'         => $fecha,
                ':medicacion_id' => $medicacion_id
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al crear alarma: " . $e->getMessage());
        }
    }

    public function update($al) {
        try {
            $sql = "UPDATE alarmas SET fecha = :fecha, medicacion_id = :medicacion_id WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':fecha'         => $al->fecha,
                ':medicacion_id' => $al->medicacion_id,
                ':id'            => $al->id
            ]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al editar alarma: " . $e->getMessage());
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM alarmas WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al borrar alarma: " . $e->getMessage());
        }
    }

    public function apagar($id) {
        try {
            $sql = "UPDATE alarmas SET apagada = 1 WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (PDOException $e) {
            throw new Exception("Error al apagar la alarma: " . $e->getMessage());
        }
    }
}
