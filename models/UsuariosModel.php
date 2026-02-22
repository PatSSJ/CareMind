<?php
require_once "models/db.php";

class UsuariosModel {

    private $db;

    public function __construct() {
        $this->db = conectar();
    }

    public function getByEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }

    public function insertar($nombre, $email, $password_hash) {
        $sql = "INSERT INTO usuarios (nombre, email, password)
                VALUES (:nombre, :email, :password)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nombre' => $nombre,
            ':email' => $email,
            ':password' => $password_hash
        ]);
        return true;
    }
}

