<?php
require_once "models/UsuariosModel.php";

class AuthController {

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function inicio() {
        require_once "views/login_view.php";
    }

    public function login() {
        try {
            $model = new UsuariosModel();

            // Login normal
            if (!empty($_POST['email']) && !empty($_POST['password'])) {

                $usuario = $model->validar($_POST['email'], $_POST['password']);

                if ($usuario) {
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['rol'] = $usuario->rol_id;
                    header("Location: index.php?controller=personas&action=listado");
                    exit;
                }

                $_SESSION['error'] = "Credenciales incorrectas.";
                header("Location: index.php?controller=auth&action=inicio");
                exit;
            }

            // Login por PIN (solo si existe columna pin)
            if (!empty($_POST['pin'])) {

                $usuario = $model->validarPorPin($_POST['pin']);

                if ($usuario) {
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['rol'] = $usuario->rol_id;
                    header("Location: index.php?controller=personas&action=listado");
                    exit;
                }

                $_SESSION['error'] = "PIN no válido.";
                header("Location: index.php?controller=auth&action=inicio");
                exit;
            }

            header("Location: index.php?controller=auth&action=inicio");
            exit;

        } catch (Throwable $e) {
            $this->error_fatal($e->getMessage());
        }
    }

    public function register() {
        try {
            $model = new UsuariosModel();

            if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
                require_once "views/register_view.php";
                return;
            }

            $nombre = trim($_POST['nombre'] ?? '');
            $email  = trim($_POST['email'] ?? '');
            $pass1  = $_POST['password'] ?? '';
            $pass2  = $_POST['confirm_password'] ?? '';

            if ($nombre == '' || $email == '' || $pass1 == '' || $pass2 == '') {
                $_SESSION['error'] = "Rellena todos los campos.";
                header("Location: index.php?controller=auth&action=register");
                exit;
            }

            if ($pass1 !== $pass2) {
                $_SESSION['error'] = "Las contraseñas no coinciden.";
                header("Location: index.php?controller=auth&action=register");
                exit;
            }

            // rol 1 (cuidador)
            $ok = $model->crear($nombre, $email, $pass1, 1);

            if (!$ok) {
                $_SESSION['error'] = "No se pudo crear la cuenta (¿email ya usado?).";
                header("Location: index.php?controller=auth&action=register");
                exit;
            }

            $_SESSION['mensaje'] = "Cuenta creada. Ya puedes iniciar sesión.";
            header("Location: index.php?controller=auth&action=inicio");
            exit;

        } catch (Throwable $e) {
            $this->error_fatal($e->getMessage());
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: index.php?controller=auth&action=inicio");
        exit;
    }

    private function error_fatal($msj) {
        $_SESSION['error_fatal'] = $msj;
        require_once "views/error_fatal.php";
        exit;
    }
}

