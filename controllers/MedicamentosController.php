<?php
require_once "models/MedicamentosModel.php";
require_once "core/ACL.php";

class MedicamentosController {

    private function error_fatal($mensaje) {
        $_SESSION['error_fatal'] = $mensaje;
        require_once "views/error_fatal.php";
        exit;
    }

    public function listado() {
        try {
            if (!ACL::puede('medicamentos.ver')) {
                $this->error_fatal("No tienes permiso para ver el inventario.");
            }

            $model = new MedicamentosModel();
            $medicamentos = $model->getAll();
            require_once "views/medicamentos_listado_view.php";

        } catch (Exception $e) {
            $this->error_fatal($e->getMessage());
        }
    }

    public function crear() {
        try {
            if (!ACL::puede('medicamentos.crear')) {
                $this->error_fatal("No puedes añadir nuevos medicamentos.");
            }

            if (isset($_POST['nombre']) && isset($_POST['dosis'])) {
                $model = new MedicamentosModel();
                $model->insertar($_POST['nombre'], $_POST['dosis']);
                $_SESSION['mensaje'] = "Medicamento guardado.";
                header("Location: index.php?controller=medicamentos&action=listado");
                exit;
            }

            require_once "views/medicamentos_crear_view.php";

        } catch (Exception $e) {
            $this->error_fatal($e->getMessage());
        }
    }

    public function eliminar() {
        try {
            if (!ACL::puede('medicamentos.eliminar')) {
                $this->error_fatal("No tienes permiso para borrar medicamentos.");
            }

            if (isset($_GET['id'])) {
                $model = new MedicamentosModel();
                $model->delete($_GET['id']);
            }

            header("Location: index.php?controller=medicamentos&action=listado");
            exit;

        } catch (Exception $e) {
            $this->error_fatal($e->getMessage());
        }
    }
}


