<?php
require_once "models/UsuariosModel.php";

class LoginController {

    public function index() {
        require_once "views/login_view.php";
    }

    public function acceder() {
        try {
            $model = new UsuariosModel();
            $usuario = null;

            //Login Roles 1, 2, 3
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $usuario = $model->validar($_POST['email'], $_POST['password']);

                if ($usuario) {
                    $_SESSION['usuario'] = $usuario;
                    header('Location: index.php?controller=personas&action=listado');
                    exit;
                } else {
                    $error = "Datos incorrectos.";
                    require_once "views/login_view.php";
                    return;
                }
            }
            //Médico con PIN
            else if (isset($_POST['pin'])) {
                $usuario = $model->validarPorPin($_POST['pin']);

                if ($usuario) {
                    $_SESSION['usuario'] = $usuario;
                    header('Location: index.php?controller=personas&action=listado');
                    exit;
                } else {
                    $error = "PIN no válido o expirado.";
                    require_once "views/login_view.php";
                    return;
                }
            }

        } catch (Exception $e) {
            $_SESSION['error_mensaje'] = $e->getMessage();
            require_once "views/shared/error_critico.php";
        }
    }

    public function salir() {
        session_destroy();
        header("Location: index.php?controller=login&action=index");
        exit;
    }
}
