<?php
require_once "models/PersonasModel.php";

class PersonasController {

    public function listado() {

        try {

            $modelo = new personas_model();
            $personas = $modelo->get_personas();

            require "views/personas_view.php";
            exit;

        } catch (Exception $e) {

            $_SESSION['error_fatal'] = $e->getMessage();
            require "views/error_fatal.php";
            exit;
        }
    }

    public function crear() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $nombre = $_POST['nombre'];
            $dni = $_POST['dni'];
            $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;

            try {

                $modelo = new personas_model();
                $modelo->insertar_persona($nombre, $dni, $telefono, $direccion);

                $_SESSION['mensaje'] = "Persona creada correctamente";
                header("Location: index.php?controller=personas&action=listado");
                exit;

            } catch (Exception $e) {

                $_SESSION['error_fatal'] = $e->getMessage();
                require "views/error_fatal.php";
                exit;
            }
        }

        require "views/nuevo_usuario_view.php";
        exit;
    }
}

