<?php
require_once "models/PersonasModel.php";
require_once "core/ACL.php";

class PersonasController {

    private function error_fatal($mensaje) {
        $_SESSION['error_fatal'] = $mensaje;
        require_once "views/error_fatal.php";
        exit;
    }

    public function listado() {
        try {
            if (!ACL::puede('usuarios.ver')) {
                $this->error_fatal("Acceso denegado al listado.");
            }

            $model = new PersonasModel();
            $personas = $model->getAll();
            require_once "views/personas_view.php";

        } catch (Exception $e) {
            $this->error_fatal($e->getMessage());
        }
    }

    public function crear() {
        try {
            if (!ACL::puede('usuarios.crear')) {
                $this->error_fatal("No tienes autorización para dar de alta.");
            }

            if (isset($_POST['nombre'], $_POST['dni'], $_POST['num_seguridad_social'])) {
                $model = new PersonasModel();
                $model->insertar(
                    $_POST['nombre'],
                    $_POST['dni'],
                    $_POST['telefono'] ?? '',
                    $_POST['direccion'] ?? '',
                    $_POST['num_seguridad_social']
                );

                $_SESSION['mensaje'] = "Persona guardada con éxito.";
                header("Location: index.php?controller=personas&action=listado");
                exit;
            }

            require_once "views/personas_crear_view.php";

        } catch (Exception $e) {
            $this->error_fatal("Error al guardar: " . $e->getMessage());
        }
    }

    public function eliminar() {
        try {
            if (!ACL::puede('usuarios.eliminar')) {
                $this->error_fatal("No tienes permisos para eliminar usuarios.");
            }

            if (!isset($_GET['id'])) {
                throw new Exception("Falta el ID.");
            }

            $model = new PersonasModel();
            $model->borrar($_GET['id']);

            $_SESSION['mensaje'] = "Registro eliminado correctamente.";
            header("Location: index.php?controller=personas&action=listado");
            exit;

        } catch (Exception $e) {
            $this->error_fatal($e->getMessage());
        }
    }
}






