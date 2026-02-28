<?php require_once("views/shared/header.php"); ?>

<header>
	<h1>CAREMIND</h1>
	<p>Nuevo medicamento</p>
</header>

<div class="contenedor">
	<div class="columna">

	<h2>Crear medicamento</h2>

	<p>
        <a class="btn btn-secondary btn-sm"
         href="index.php?controller=medicamentos&action=listado">
         Volver al listado
         </a>
         </p>

	<form method="post" action="index.php?controller=medicamentos&action=crear">
	<div class="mb-3">
        <label class="form-label">Nombre:</label>
        <input class="form-control" type="text" name="nombre" required>
      	</div>

      	<div class="mb-3">
        <label class="form-label">Dosis:</label>
        <input class="form-control" type="text" name="dosis">
      	</div>

      <button class="btn btn-caremind" type="submit">Guardar</button>
      </form>

  </div>
</div>

<?php require_once("views/shared/footer.php"); ?>

