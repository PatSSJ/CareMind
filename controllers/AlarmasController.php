<?php
require_once "models/AlarmasModel.php";
require_once "models/PersonasModel.php";
require_once "models/MedicamentosModel.php";
require_once "core/ACL.php";

class AlarmasController {

    private $model;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->model = new AlarmasModel();
    }

    public function listado() {
        try {
            if (!ACL::puede('alarmas.ver')) {
                $this->error_fatal("No tienes permiso para ver las alarmas.");
            }

            $ownerId = $_SESSION['usuario']->id;
            $alarmas = $this->model->getAll($ownerId);

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

            $ownerId = $_SESSION['usuario']->id;

            if (isset($_POST['persona_id']) && isset($_POST['fecha']) && isset($_POST['medicacion_id'])) {

                $persona_id = $_POST['persona_id'];
                $fecha = $_POST['fecha'];
                $medicacion_id = $_POST['medicacion_id'];

                $ok = $this->model->insertar($persona_id, $fecha, $medicacion_id, $ownerId);

                if (!$ok) {
                    $this->error_fatal("No puedes crear alarmas para perfiles o medicamentos que no son tuyos.");
                }

                $_SESSION['mensaje'] = "Alarma creada correctamente.";
                header("Location: index.php?controller=alarmas&action=listado");
                exit;
            }

            $personasModel = new PersonasModel();
            $medicamentosModel = new MedicamentosModel();
            $personas = $personasModel->getAll($ownerId);
            $medicamentos = $medicamentosModel->getAll($ownerId);

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

            $ownerId = $_SESSION['usuario']->id;
            $id = $_GET['id'];

            if (isset($_POST['fecha']) && isset($_POST['medicacion_id'])) {
                if (isset($_POST['apagada'])) {
                    $apagada = 1;
                } else {
                    $apagada = 0;
                }

                $ok = $this->model->update($id, $_POST['fecha'], $_POST['medicacion_id'], $apagada, $ownerId);

                if (!$ok) {
                    $this->error_fatal("No puedes editar alarmas o usar medicamentos que no son tuyos.");
                }

                $_SESSION['mensaje'] = "Alarma actualizada.";
                header("Location: index.php?controller=alarmas&action=listado");
                exit;
            }

            $alarma = $this->model->getById($id, $ownerId);

            if (!$alarma) {
                $this->error_fatal("No existe la alarma o no es tuya.");
            }

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

            $ownerId = $_SESSION['usuario']->id;
            $ok = $this->model->delete($_GET['id'], $ownerId);

            if (!$ok) {
                $this->error_fatal("No puedes eliminar alarmas que no son tuyas.");
            }

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

            $ownerId = $_SESSION['usuario']->id;
            $ok = $this->model->apagar($_GET['id'], $ownerId);

            if (!$ok) {
                $this->error_fatal("No puedes apagar alarmas que no son tuyas.");
            }

            $_SESSION['mensaje'] = "Alarma apagada.";
            header("Location: index.php?controller=alarmas&action=listado");
            exit;

        } catch (Exception $e) {
            $this->error_fatal($e->getMessage());
        }
    }

    private function error_fatal($mensaje) {
        $_SESSION['error_fatal'] = $mensaje;
        require_once "views/error_fatal.php";
        exit;
    }
}
