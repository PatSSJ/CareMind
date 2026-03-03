<?php
session_start();

require_once "models/db.php";

$conexion = conectar();

$pin_teclado = "";

if (isset($_POST['pin_usuario'])) {
    $pin_tecleado = trim($_POST['pin_usuario']);
}
if ($pin_tecleado == "") {
        echo "Debes introducir un PIN.";
        exit;
}

    $sql = "SELECT id FROM pines_temporales WHERE pin = :pin LIMIT 1";
    $stmt = $conexion->prepare($sql);
    $stmt->execute(array(':pin' => $pin_tecleado));
    $resultado = $stmt->fetch();

    if ($resultado) {

        $_SESSION['rol_id'] = 4;
        $_SESSION['acceso'] = "medico_pin";

        header("Location: inicio_doctor_pin.php");
        exit;

    } else {
        echo "PIN no válido.";
        exit;
    }
?>

