<?php
require_once "models/db.php";

class PinController {

    // Genera un PIN y lo guarda 10 minutos
    public function obtener() {

        $conexion = conectar();

        $pin = rand(100000, 999999);

        $sql = "INSERT INTO pines_temporales (pin, fecha_expiracion, usado)
                VALUES (?, DATE_ADD(NOW(), INTERVAL 10 MINUTE), 0)";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([$pin]);


        echo "<h2>PIN generado</h2>";
        echo "<h1>$pin</h1>";
        echo "<p>Válido 10 minutos.</p>";
        echo '<a href="index.php?controller=auth&action=inicio">Volver</a>';
        exit;
    }

    // Login usando el PIN
    public function login()
    {

        $conexion = conectar();

        $pin = isset($_POST['pin_usuario']) ? trim($_POST['pin_usuario']) : "";

        if ($pin == "") {
            $_SESSION['error'] = "Debes introducir un PIN.";
            header("Location: index.php?controller=auth&action=inicio");
            exit;
        }
        $sql = "SELECT id FROM pines_temporales
                WHERE pin = ?
                  AND fecha_expiracion > NOW()
                  AND usado = 0
                LIMIT 1";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([$pin]);

        // OJO: tu conectar() usa FETCH_OBJ, así que esto devuelve OBJETO
        $res = $stmt->fetch();

        if ($res) {

            // Marcar como usado
            $sql2 = "UPDATE pines_temporales SET usado = 1 WHERE id = ?";
            $stmt2 = $conexion->prepare($sql2);
            $stmt2->execute([$res->id]);

            // Crear “usuario temporal” en sesión (sin id real)
            $_SESSION['usuario'] = (object)[
                'nombre' => 'Medico Temporal',
                'rol_id' => 4
            ];
            $_SESSION['rol'] = 4;

            header("Location: index.php?controller=personas&action=listado");
            exit;

        } else {
            $_SESSION['error'] = "PIN no válido o expirado.";
            header("Location: index.php?controller=auth&action=inicio");
            exit;
        }
    }
}
