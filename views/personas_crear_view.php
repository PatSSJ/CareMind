
<?php require_once("views/shared/header.php"); ?>

<header>
  <h1>CAREMIND</h1>
  <p>Nueva persona</p>
</header>

<div class="contenedor">
  <div class="columna">

    <h2>Crear persona</h2>

    <p>
      <a class="btn btn-secondary btn-sm"
         href="index.php?controller=personas&action=listado">
        Volver al listado
      </a>
    </p>
    <form method="post" action="index.php?controller=personas&action=crear">
      <div class="mb-3">
        <label class="form-label">Nombre Completo:</label>
        <input class="form-control" type="text" name="nombre" required>
      </div>

      <div class="mb-3">
        <label class="form-label">DNI:</label>
        <input class="form-control" type="text" name="dni" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Teléfono:</label>
        <input class="form-control" type="text" name="telefono">
      </div>

      <div class="mb-3">
        <label class="form-label">Dirección:</label>
        <input class="form-control" type="text" name="direccion">
      </div>

      <button class="btn btn-caremind" type="submit">Guardar</button>
    </form>

  </div>
</div>

<?php require_once("views/shared/footer.php"); ?>
