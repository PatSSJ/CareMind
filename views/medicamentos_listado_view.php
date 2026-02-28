<?php require_once("views/shared/header.php"); ?>

<header>

 <h1>CAREMIND</h1>
 <p>Listado de medicamentos</p>

</header>

<div class="contenedor">
 <div class="columna">


   <h2>Medicamentos</h2>


   <p>

     <a class="btn btn-secondary btn-sm"
        href="index.php?controller=personas&action=listado">
        Volver 
     </a>


     <a class="btn btn-caremind btn-sm"
        href="index.php?controller=medicamentos&action=crear">
        Nuevo medicamento
     </a>

	<?php
	if (isset($_SESSION['mensaje'])) {
	echo "<p>" . htmlspecialchars($_SESSION['mensaje']) . "</p>";
	unset($_SESSION['mensaje']);
	}
	?>

	<?php
	if (isset($_SESSION['mensaje'])) {
	echo "<p>" . htmlspecialchars($_SESSION['mensaje']) . "</p>";
	unset($_SESSION['mensaje']);
	}
	
	?>

	<table border="1">
	<tr>
		<th>Nombre</th>
		<th>Dosis</th>
		<th>Acciones</th>
	</tr>

	<table border="1">
	<tr>
		<th>Nombre</th>
		<th>Dosis</th>
		<th>Acciones</th>
	</tr>
</table>

<?php
}
?>

<?php require_once("views/shared/footer.php"); ?>


