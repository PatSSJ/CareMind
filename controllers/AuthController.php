<?php
require_once "models/UsuariosModel.php";

class AuthController {

    public function inicio() {
        require "views/inicio_view.php";
        exit;
    }

    public function login() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($email == '' || $password == '') {
                $_SESSION['error'] = "Email y contraseña obligatorios";
                require "views/login_view.php";
                exit;
            }

            try {

                $modelo = new UsuariosModel();
                $usuario = $modelo->getByEmail($email);

                if (!$usuario) {
                    $_SESSION['error'] = "Usuario no existe";
                    require "views/login_view.php";
                    exit;
                }

                if (!password_verify($password, $usuario->password)) {
                    $_SESSION['error'] = "Contraseña incorrecta";
                    require "views/login_view.php";
                    exit;
                }

                $_SESSION['usuario'] = $usuario->email;
                header("Location: index.php?controller=personas&action=listado");
                exit;

            } catch (Exception $e) {
                $_SESSION['error_fatal'] = $e->getMessage();
                require "views/error_fatal.php";
                exit;
            }
        }

        require "views/login_view.php";
        exit;
    }

    public function register() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm_password'];

            if ($nombre == '' || $email == '' || $password == '') {
                $_SESSION['error'] = "Todos los campos son obligatorios";
                require "views/register_view.php";
                exit;
            }

            if ($password != $confirm) {
                $_SESSION['error'] = "Las contraseñas no coinciden";
                require "views/register_view.php";
                exit;
            }

            try {

                $modelo = new UsuariosModel();

                if ($modelo->getByEmail($email)) {
                    $_SESSION['error'] = "Ese email ya está registrado";
                    require "views/register_view.php";
                    exit;
                }

                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $modelo->insertar($nombre, $email, $password_hash);

                $_SESSION['mensaje'] = "Usuario registrado correctamente";
                header("Location: index.php?controller=auth&action=login");
                exit;

            } catch (Exception $e) {
                $_SESSION['error_fatal'] = $e->getMessage();
                require "views/error_fatal.php";
                exit;
            }
        }

        require "views/register_view.php";
        exit;
    }

    public function logout() {
        session_destroy();
        header("Location: index.php?controller=auth&action=login");
        exit;
    }
}

