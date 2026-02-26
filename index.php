<?php

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

require_once "models/db/db.php";

require_once "controllers/AuthController.php";
require_once "controllers/PersonasController.php";
require_once "controllers/AlarmasController.php";
require_once "controllers/MedicamentosController.php";

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'inicio';

if ($controller == 'auth') {

	$c = new AuthController();

	if ($action == 'inicio') { $c->inicio(); exit; }
	if ($action == 'login') { $c->login(); exit; }
	if ($action == 'logout') { $c->logout(); exit; }
	if ($action == 'register') { $c->register(); exit; }

	$_SESSION['error_fatal'] = "Acceso Incorrecto";
	require "views/error_fatal.php";
	exit;
}

if ($controller == 'personas') {

	$c = new PersonasController();

	if ($action == 'listado') { $c->listado(); exit; }
	if ($action == 'crear') { $c->crear();exit; }
	if ($action == 'eliminar') { $c->eliminar(); exit; }

	$_SESSION['error_fatal'] = "Acción no válida en personas";
	require "views/error_fatal.php";
	exit;
}

if ($controller == 'medicamentos') {

        $c = new MedicamentosController();

        if ($action == 'listado') { $c->listado(); exit; }
        if ($action == 'crear') { $c->crear();exit; }
        if ($action == 'editar') { $c->editar(); exit; }
	if ($action == 'eliminar') { $c->eliminar(); exit: }

        $_SESSION['error_fatal'] = "Acción no válida en medicamentos";
        require "views/error_fatal.php";
        exit;
}

if ($controller == 'alarmas') {

        $c = new AlarmasController();

        if ($action == 'listado') { $c->listado(); exit; }
        if ($action == 'crear') { $c->crear();exit; }
        if ($action == 'editar') { $c->editar(); exit; }
        if ($action == 'eliminar') { $c->eliminar(); exit: }
	if ($action == 'apagaralarma') { $c->apagaralarma(); exit; }
 
        $_SESSION['error_fatal'] = "Acción no válida en Alarmas"
        require "views/error_fatal.php";
        exit;
}

$_SESSION['error_fatal'] = "Controlador no válido";
require "views/error_fatal.php";
exit;


?>
