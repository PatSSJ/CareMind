<?php require_once("views/shared/header.php"); ?>

<div class="contenedor">
  <div class="columna">

    <h2>Error</h2>

    <p>
      <?php
        if (isset($_SESSION['error_fatal'])) {
            echo $_SESSION['error_fatal'];
            unset($_SESSION['error_fatal']);
        } else {
            echo "Se ha producido un error.";
        }
      ?>
    </p>

    <p>
      <a href="index.php">Volver al inicio</a>
    </p>

  </div>
</div>

<?php require_once("views/shared/footer.php"); ?>
