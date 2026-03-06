<?php
require_once "db.php";

class PersonasModel {

    private $db;

    public function __construct() {
        $this->db = conectar();
    }

    public function getAll($ownerId) {
        try {

            $sql = "SELECT * FROM personas WHERE owner_usuario_id = :owner ORDER BY nombre ASC";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([":owner" => $ownerId]);

            return $stmt->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            throw new Exception("Error al obtener personas.");
        }
    }

    public function insertar($nombre, $dni, $telefono, $direccion, $nss, $ownerUsuarioId) {
        try {

            $sql = "INSERT INTO personas (nombre, dni, telefono, direccion, num_seguridad_social, owner_usuario_id)
                    VALUES (:nombre, :dni, :telefono, :direccion, :nss, :owner)";
            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ":nombre" => $nombre,
                ":dni" => $dni,
                ":telefono" => $telefono,
                ":direccion" => $direccion,
                ":nss" => $nss,
                ":owner" => $ownerUsuarioId
            ]);

        } catch (PDOException $e) {
            throw new Exception("Error al insertar persona.");
        }
    }

    public function borrar($id, $ownerId) {
        try {

            $sql = "DELETE FROM personas WHERE id = :id AND owner_usuario_id = :owner";
            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ":id" => $id, ":owner" => $ownerId]);

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
