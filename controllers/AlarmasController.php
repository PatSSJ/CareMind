<?php
require_once "models/AlarmasModel.php";
require_once "core/ACL.php";

class AlarmasController {

    public function listado() {
        ACL::requerirLogin();

        if (!ACL::puede('alarmas.leer')) {
            $_SESSION['error_fatal'] = "No tienes permiso para ver alarmas";
            require "views/error_fatal.php";
            exit;
        }

        try {
            $modelo = new AlarmasModel();
            $alarmas = $modelo->getAll();

            require "views/alarmas_listado_view.php";
            exit;

        } catch (Exception $e) {
            $_SESSION['error_fatal'] = $e->getMessage();
            require "views/error_fatal.php";
            exit;
        }
    }

    public function crear() {
        ACL::requerirLogin();

        if (!ACL::puede('alarmas.crear')) {
            $_SESSION['error_fatal'] = "No tienes permiso para crear alarmas";
            require "views/error_fatal.php";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $fecha = $_POST['fecha'];
            $medicacion_id = $_POST['medicacion_id'];

            try {
                $modelo = new AlarmasModel();
                $modelo->insertar($fecha, $medicacion_id);

                $_SESSION['mensaje'] = "Alarma creada";
                header("Location: index.php?controller=alarmas&action=listado");
                exit;

            } catch (Exception $e) {
                $_SESSION['error_fatal'] = $e->getMessage();
                require "views/error_fatal.php";
                exit;
            }
        }

        require "views/alarmas_crear_view.php";
        exit;
    }

    public function editar() {
        ACL::requerirLogin();

        if (!ACL::puede('alarmas.editar')) {
            $_SESSION['error_fatal'] = "No tienes permiso para editar alarmas";
            require "views/error_fatal.php";
            exit;
        }

        if (!isset($_GET['id'])) {
            $_SESSION['error_fatal'] = "No se especificó alarma";
            require "views/error_fatal.php";
            exit;
        }

        try {
            $modelo = new AlarmasModel();
            $al = $modelo->getById($_GET['id']);

            if (!$al) {
                $_SESSION['error_fatal'] = "Alarma no existe";
                require "views/error_fatal.php";
                exit;
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $al->fecha = $_POST['fecha'];
                $al->medicacion_id = $_POST['medicacion_id'];

                $modelo->update($al);

                $_SESSION['mensaje'] = "Alarma actualizada";
                header("Location: index.php?controller=alarmas&action=listado");
                exit;
            }

            require "views/alarmas_editar_view.php";
            exit;

        } catch (Exception $e) {
            $_SESSION['error_fatal'] = $e->getMessage();
            require "views/error_fatal.php";
            exit;
        }
    }

    public function eliminar() {
        ACL::requerirLogin();

        if (!ACL::puede('alarmas.borrar')) {
            $_SESSION['error_fatal'] = "No tienes permiso para borrar alarmas";
            require "views/error_fatal.php";
            exit;
        }

        if (!isset($_GET['id'])) {
            $_SESSION['error_fatal'] = "No se especificó alarma";
            require "views/error_fatal.php";
            exit;
        }

        try {
            $modelo = new AlarmasModel();
            $modelo->delete($_GET['id']);

            $_SESSION['mensaje'] = "Alarma eliminada";
            header("Location: index.php?controller=alarmas&action=listado");
            exit;

        } catch (Exception $e) {
            $_SESSION['error_fatal'] = $e->getMessage();
            require "views/error_fatal.php";
            exit;
        }
    }

    public function apagarAlarma() {
        ACL::requerirLogin();

        if (!ACL::puede('medicamentos.apagarAlarma')) {
            $_SESSION['error_fatal'] = "No tienes permiso para apagar alarmas";
            require "views/error_fatal.php";
            exit;
        }

        if (!isset($_GET['id'])) {
            $_SESSION['error_fatal'] = "No se especificó alarma";
            require "views/error_fatal.php";
            exit;
        }

        try {
            $modelo = new AlarmasModel();
            $modelo->apagar($_GET['id']);

            $_SESSION['mensaje'] = "Alarma apagada";
            header("Location: index.php?controller=alarmas&action=listado");
            exit;

        } catch (Exception $e) {
            $_SESSION['error_fatal'] = $e->getMessage();
            require "views/error_fatal.php";
            exit;
        }
    }
}
