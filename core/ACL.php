<?php
class ACL {

    private static $db;

    private static function conectarDB() {
        if (!self::$db) {
            require_once "models/db.php";
            self::$db = conectar(); // devuelve objeto PDO
        }
    }

    public static function estaAutenticado() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['usuario']);
    }

    public static function permisosUsuario($email) {

        self::conectarDB();

        $sql = "SELECT p.nombre
                FROM permisos p
                JOIN rol_permisos rp ON p.id = rp.permiso_id
                JOIN usuarios u ON u.rol_id = rp.rol_id
                WHERE u.email = :email";

        $stmt = self::$db->prepare($sql);
        $stmt->execute([':email' => $email]);

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    public static function puede($permiso) {

        if (!self::estaAutenticado()) {
            return false;
        }

        $email = $_SESSION['usuario'];
        $permisos = self::permisosUsuario($email);

        return in_array($permiso, $permisos);
    }

    public static function requerirLogin() {
        if (!self::estaAutenticado()) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }
    }
}
