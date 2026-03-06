<?php
require_once "db.php";

class AlarmasModel {

    private $db;

    public function __construct() {
        $this->db = conectar();
    }

    public function getAll($ownerId) {

        $sql = "SELECT alarmas.*,
                       (SELECT nombre FROM medicamentos WHERE medicamentos.id = alarmas.medicacion_id) AS medicamento_nombre FROM alarmas, personas WHERE alarmas.persona_id = personas.id AND personas.owner_usuario_id = :owner ORDER BY alarmas.fecha ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(":owner" => $ownerId));

        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getById($id, $ownerId) {

        $sql = "SELECT * FROM alarmas, personas
                WHERE alarmas.id = :id AND alarmas.persona_id = personas.id AND personas.owner_usuario_id = :owner";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
            ":id" => $id,
            ":owner" => $ownerId
        ));

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function insertar($persona_id, $fecha, $medicacion_id, $ownerId) {

        $sql = "INSERT INTO alarmas (persona_id, fecha, medicacion_id, apagada)
                SELECT :persona_id, :fecha, :medicacion_id, 0 FROM personas, medicamentos WHERE personas.id = :persona_id AND medicamentos.id = :medicacion_id AND personas.owner_usuario_id = :owner AND medicamentos.owner_usuario_id = :owner";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
            ":persona_id" => $persona_id,
            ":fecha" => $fecha,
            ":medicacion_id" => $medicacion_id,
            ":owner" => $ownerId
        ));

        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function update($id, $fecha, $medicacion_id, $apagada, $ownerId) {

        $sql = "UPDATE alarmas, personas, medicamentos SET alarmas.fecha = :fecha, alarmas.medicacion_id = :medicacion_id, alarmas.apagada = :apagada WHERE alarmas.id = :id AND alarmas.persona_id = personas.id AND medicamentos.id = :medicacion_id AND personas.owner_usuario_id = :owner AND medicamentos.owner_usuario_id = :owner";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
            ":fecha" => $fecha,
            ":medicacion_id" => $medicacion_id,
            ":apagada" => $apagada,
            ":id" => $id,
            ":owner" => $ownerId
        ));

        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function delete($id, $ownerId) {

        $sql = "DELETE alarmas FROM alarmas, personas WHERE alarmas.id = :id AND alarmas.persona_id = personas.id AND personas.owner_usuario_id = :owner";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
            ":id" => $id,
            ":owner" => $ownerId
        ));

        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }

    public function apagar($id, $ownerId) {

        $sql = "UPDATE alarmas, personas SET alarmas.apagada = 1 WHERE alarmas.id = :id AND alarmas.persona_id = personas.id AND personas.owner_usuario_id = :owner";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(array(
            ":id" => $id,
            ":owner" => $ownerId
        ));

        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }
}

