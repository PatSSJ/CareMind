<?php

require_once "models/MedicamentosModel.php";
require_once "core/ACL.php";

class MedicamentosController {

    public function listado() {
        ACL::requerirLogin();

        if (!ACL::puede('medicamentos.leer')) {
            $_SESSION['error_fatal'] = "No tienes permiso para ver medicamentos";
            require "views/error_fatal.php";
            exit;
        }

        try {
            $modelo = new MedicamentosModel();
            $medicamentos = $modelo->getAll();

            require "views/medicamentos_listado_view.php";
            exit;

        } catch (Exception $e) {
            $_SESSION['error_fatal'] = $e->getMessage();
            require "views/error_fatal.php";
            exit;
        }
    }

    public function crear() {
        ACL::requerirLogin();

        if (!ACL::puede('medicamentos.crear')) {
            $_SESSION['error_fatal'] = "No tienes permiso para crear medicamentos";
            require "views/error_fatal.php";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $nombre = $_POST['nombre'];
            $dosis = $_POST['dosis'] ?? '';

            try {
                $modelo = new MedicamentosModel();
                $modelo->insertar($nombre, $dosis);

                $_SESSION['mensaje'] = "Medicamento creado";
                header("Location: index.php?controller=medicamentos&action=listado");
                exit;

            } catch (Exception $e) {
                $_SESSION['error_fatal'] = $e->getMessage();
                require "views/error_fatal.php";
                exit;
            }
        }

        require "views/medicamentos_crear_view.php";
        exit;
    }

    public function editar() {
        ACL::requerirLogin();

        if (!ACL::puede('medicamentos.editar')) {
            $_SESSION['error_fatal'] = "No tienes permiso para editar medicamentos";
            require "views/error_fatal.php";
            exit;
        }

        if (!isset($_GET['id'])) {
            $_SESSION['error_fatal'] = "No se especificó medicamento";
            require "views/error_fatal.php";
            exit;
        }

        try {
            $modelo = new MedicamentosModel();
            $med = $modelo->getById($_GET['id']);

            if (!$med) {
                $_SESSION['error_fatal'] = "Medicamento no existe";
                require "views/error_fatal.php";
                exit;
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $med->nombre = $_POST['nombre'];
                $med->dosis = $_POST['dosis'] ?? '';

                $modelo->update($med);

                $_SESSION['mensaje'] = "Medicamento actualizado";
                header("Location: index.php?controller=medicamentos&action=listado");
                exit;
            }

            require "views/medicamentos_editar_view.php";
            exit;

        } catch (Exception $e) {
            $_SESSION['error_fatal'] = $e->getMessage();
            require "views/error_fatal.php";
            exit;
        }
    }

    public function eliminar() {
        ACL::requerirLogin();

        if (!ACL::puede('medicamentos.borrar')) {
            $_SESSION['error_fatal'] = "No tienes permiso para borrar medicamentos";
            require "views/error_fatal.php";
            exit;
        }

        if (!isset($_GET['id'])) {
            $_SESSION['error_fatal'] = "No se especificó medicamento";
            require "views/error_fatal.php";
            exit;
        }

        try {
            $modelo = new MedicamentosModel();
            $modelo->delete($_GET['id']);

            $_SESSION['mensaje'] = "Medicamento eliminado";
            header("Location: index.php?controller=medicamentos&action=listado");
            exit;

        } catch (Exception $e) {
            $_SESSION['error_fatal'] = $e->getMessage();
            require "views/error_fatal.php";
            exit;
        }
    }
}
