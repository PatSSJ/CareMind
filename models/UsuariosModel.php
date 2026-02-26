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

   public function insertar($nombre, $email, $password_hash, $rol_id) {
       $sql = "INSERT INTO usuarios (nombre, email, password, rol_id) VALUES (:nombre, :email, :password, :rol_id)";

       $stmt = $this->db->prepare($sql);
       $stmt->execute([
           ':nombre' => $nombre,
           ':email'  => $email,
           ':password' => $password_hash,
           ':rol_id'   => $rol_id
       ]);
       return true;
   }
}

