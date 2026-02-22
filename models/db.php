<?php
function conectar() {

    $opciones = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];

    return new PDO(
        "mysql:host=localhost;dbname=caremind_db;charset=utf8mb4",
        "careminduser",
        "caremindpass",
        $opciones
    );
}
?>

