<?php
session_start();

$controller = $_GET['controller'] ?? 'auth';
$action     = $_GET['action'] ?? 'inicio';

// Controladores sin login
$publicControllers = ['auth', 'pin'];


if (!isset($_SESSION['usuario']) && !in_array($controller, $publicControllers)) {
    header("Location: index.php?controller=auth&action=inicio");
    exit;
}

// Mapeo controladores asi dejo los 4 roles ordenados para el login
$map = [
    'auth'         => 'AuthController',
    'personas'     => 'PersonasController',
    'alarmas'      => 'AlarmasController',
    'medicamentos' => 'MedicamentosController',
    'pin'          => 'PinController'
];

if (!isset($map[$controller])) {
    $_SESSION['error_fatal'] = "Controlador no válido";
    require "views/error_fatal.php";
    exit;
}

$controllerName = $map[$controller];
$controllerFile = "controllers/$controllerName.php";

if (!file_exists($controllerFile)) {
    $_SESSION['error_fatal'] = "Archivo del controlador no encontrado";
    require "views/error_fatal.php";
    exit;
}

require_once $controllerFile;

$c = new $controllerName();

if (!method_exists($c, $action)) {
    $_SESSION['error_fatal'] = "Acción no válida";
    require "views/error_fatal.php";
    exit;
}

$c->$action();
