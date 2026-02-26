<?php
require_once "models/PersonasModel.php";
require_once "core/ACL.php";

class PersonasController {

   public function listado() {
       ACL::requerirLogin();

       if (!ACL::puede('usuarios.leer')) {
           $_SESSION['error_fatal'] = "No tienes permiso para ver personas";
           require "views/error_fatal.php"; 
	   exit;
       }

       try {
           $modelo = new PersonasModel();
           $personas = $modelo->getAll();
           require "views/personas_view.php"; 
	   exit;

       } catch (Exception $e) {
           $_SESSION['error_fatal'] = $e->getMessage();
           require "views/error_fatal.php"; 
	   exit;
       }
   }

   public function crear() {
       ACL::requerirLogin();

       if (!ACL::puede('usuarios.crear')) {
           $_SESSION['error_fatal'] = "No tienes permiso para crear personas";
           require "views/error_fatal.php"; 
	   exit;
       }

       if ($_SERVER['REQUEST_METHOD'] == 'POST') {

           $nombre  = $_POST['nombre'] ?? '';
           $dni     = $_POST['dni'] ?? '';
           $telefono = $_POST['telefono'] ?? '';
           $direccion = $_POST['direccion'] ?? '';

           try {
               $modelo = new PersonasModel();
               $modelo->insertar($nombre, $dni, $telefono, $direccion);
               
	       $_SESSION['mensaje'] = "Persona creada";
               header("Location: index.php?controller=personas&action=listado");
               exit;
           
	} catch (Exception $e) {
               $_SESSION['error_fatal'] = $e->getMessage();
               require "views/error_fatal.php"; 
	       exit;
           }
       }

       require "views/personas_crear_view.php"; 
       exit;
   }

   public function eliminar() {
       ACL::requerirLogin();

       if (!ACL::puede('usuarios.borrar')) {
           $_SESSION['error_fatal'] = "No tienes permiso para borrar personas";
           require "views/error_fatal.php"; 
           exit;
       }

       if (!isset($_GET['id'])) {
           $_SESSION['error_fatal'] = "Persona no especificada";
           require "views/error_fatal.php"; 
           exit;
       }

       try {
           $modelo = new PersonasModel();
           $modelo->delete($_GET['id']);

           $_SESSION['mensaje'] = "Persona eliminada";
           header("Location: index.php?controller=personas&action=listado"); 
	   exit;

       } catch (Exception $e) {
           $_SESSION['error_fatal'] = $e->getMessage();
           require "views/error_fatal.php"; 
	   exit;
       }
   }
}
