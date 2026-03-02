<?php
require_once "models/AlarmasModel.php";
require_once "core/ACL.php";

class AlarmasController {

    private $model;

    public function __construct() {
        $this->model = new AlarmasModel();
    }

    public function listado() {
        try {
            if (!ACL::puede('alarmas.ver')) {
                $this->error_fatal("No tienes permiso para ver las alarmas.");
            }

            $alarmas = $this->model->getAll();
            require_once "views/alarmas_listado_view.php";

        } catch (Exception $e) {
            $this->error_fatal($e->getMessage());
        }
    }

    public function crear() {
        try {
            if (!ACL::puede('alarmas.crear')) {
                $this->error_fatal("No tienes permiso para crear alarmas.");
            }

            if (isset($_POST['persona_id'], $_POST['fecha'], $_POST['medicacion_id'])) {
                $this->model->insertar(
                    (int)$_POST['persona_id'],
                    $_POST['fecha'],
                    (int)$_POST['medicacion_id']
                );

                $_SESSION['mensaje'] = "Alarma creada.";
                header("Location: index.php?controller=alarmas&action=listado");
                exit;
            }

            require_once "views/alarmas_crear_view.php";

        } catch (Exception $e) {
            $this->error_fatal($e->getMessage());
        }
    }

    public function editar() {
        try {
            if (!ACL::puede('alarmas.editar')) {
                $this->error_fatal("No tienes permiso para editar alarmas.");
            }

            if (!isset($_GET['id'])) {
                throw new Exception("Falta el ID.");
            }

            $id = (int)$_GET['id'];

            if (isset($_POST['fecha'], $_POST['medicacion_id'])) {
                $apagada = isset($_POST['apagada']) ? 1 : 0;

                $this->model->update(
                    $id,
                    $_POST['fecha'],
                    (int)$_POST['medicacion_id'],
                    $apagada
                );

                $_SESSION['mensaje'] = "Alarma actualizada.";
                header("Location: index.php?controller=alarmas&action=listado");
                exit;
            }

            $alarma = $this->model->getById($id);
            require_once "views/alarmas_editar_view.php";

        } catch (Exception $e) {
            $this->error_fatal($e->getMessage());
        }
    }

    public function eliminar() {
        try {
            if (!ACL::puede('alarmas.eliminar')) {
                $this->error_fatal("No tienes permiso para eliminar alarmas.");
            }

            if (!isset($_GET['id'])) {
                throw new Exception("Falta el ID.");
            }

            $this->model->delete((int)$_GET['id']);

            $_SESSION['mensaje'] = "Alarma eliminada.";
            header("Location: index.php?controller=alarmas&action=listado");
            exit;

        } catch (Exception $e) {
            $this->error_fatal($e->getMessage());
        }
    }

    public function apagar() {
        try {
            if (!isset($_GET['id'])) {
                throw new Exception("Falta el ID.");
            }

            $this->model->apagar((int)$_GET['id']);

            $_SESSION['mensaje'] = "Alarma apagada.";
            header("Location: index.php?controller=alarmas&action=listado");
            exit;

        } catch (Exception $e) {
            $this->error_fatal($e->getMessage());
        }
    }

    private function error_fatal($msj) {
        $_SESSION['error_fatal'] = $msj;
        require_once "views/error_fatal.php";
        exit;
    }
}


