
<?php
require_once "db.php";

class UsuariosModel {
    private $db;

    public function __construct() {
        $this->db = conectar();
    }

    public function validar($email, $password) {
        try {
            $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([":email" => $email]);
            $u = $stmt->fetch();

            if ($u && password_verify($password, $u->password)) {
                return $u;
            }
            return false;

        } catch (PDOException $e) {
            throw new Exception("Error al validar usuario.");
        }
    }

    public function crear($nombre, $email, $password, $rol_id) {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, email, password, rol_id)
                    VALUES (:nombre, :email, :password, :rol_id)";
            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ":nombre" => $nombre,
                ":email" => $email,
                ":password" => $hash,
                ":rol_id" => $rol_id
            ]);

        } catch (PDOException $e) {
            return false;
        }
    }

    public function validarPorPin($pin) {
        try {
            $sql = "SELECT * FROM usuarios WHERE pin = :pin AND rol_id = 4 LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([":pin" => $pin]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            return false;
        }
    }
}
