<?php require_once("views/shared/header.php"); ?>

<div class="contenedor">
    <div class="columna text-center">
        <h2 class="text-danger">Error Crítico</h2>

        <p class="alert alert-warning">
            <?php
            if (isset($_SESSION['error_fatal'])) {
                echo htmlspecialchars($_SESSION['error_fatal']);
                unset($_SESSION['error_fatal']);
            } else {
                echo "Se ha producido un error inesperado en el sistema.";
            }
            ?>
        </p>

        <a href="index.php" class="btn btn-primary">Volver al Inicio</a>
    </div>
</div>

<?php require_once("views/shared/footer.php"); ?>
