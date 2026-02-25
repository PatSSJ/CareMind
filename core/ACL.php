<?php
class ACL {

   private static $db;

   private static function conectarDB() {
       if (!self::$db) {
           self::$db = conectar();  // PDO de models/db.php
       }
   }


   public static function estaAutenticado() {
       return isset($_SESSION['usuario']);
   }

   // Permisos desde BD según el rol del usuario: admin, cuidador, medico
   public static function permisosUsuario($email) {

       self::conectarDB();

       $sql = "
           SELECT p.nombre
           FROM permisos p
           JOIN rol_permisos rp ON p.id = rp.permiso_id
           JOIN usuarios u ON u.rol_id = rp.rol_id
           WHERE u.email = :email
       ";
       $stmt = self::$db->prepare($sql);
       $stmt->execute([':email' => $email]);
       return $stmt->fetchAll(PDO::FETCH_COLUMN);
   }


   public static function puede($permiso) {
       if (!self::estaAutenticado()) return false;
       $email = $_SESSION['usuario'];
       $perms = self::permisosUsuario($email);
       return in_array($permiso, $perms);
   }

  
   public static function requerirLogin() {
       if (!self::estaAutenticado()) {
           header("Location: index.php?controller=auth&action=login");
           exit;
       }
   }
}

