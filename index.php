<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once "models/db.php";
require_once "controllers/AuthController.php";
require_once "controllers/PersonasController.php";

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

$_SESSION['error_fatal'] = "Controlador no válido";
require "views/error_fatal.php";
exit;



?>
