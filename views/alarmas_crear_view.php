<?php require_once("views/shared/header.php"); ?>

<header>
  <h1>CAREMIND</h1>
  <p>Nueva alarma</p>
</header>

<div class="contenedor">
  <div class="columna">

    <h2>Crear alarma</h2>

    <p>
      <a class="btn btn-secondary btn-sm"
         href="index.php?controller=alarmas&action=listado">
        Volver al listado
      </a>
    </p>

    <form method="post" action="index.php?controller=alarmas&action=crear">

      <div class="mb-3">
        <label class="form-label">Fecha y hora:</label>
        <input class="form-control" type="datetime-local" name="fecha" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Medicación ID:</label>
        <input class="form-control" type="number" name="medicacion_id" required min="1">
        <div class="form-text">Introduce el Nombre.</div>
      </div>

      <button class="btn btn-caremind" type="submit">Guardar</button>
    </form>


  </div>
</div>

<?php require_once("views/shared/footer.php"); ?>


