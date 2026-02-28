<?php require_once("views/shared/header.php"); ?>

<h2>Listado de alarmas</h2>

	<a href="index.php?controller=personas&action=listado">
	Volver
	</a>

	<a href="index.php?controller=alarmas&action=crear">
	Fijar Nueva alarma
	</a>

	<hr>

	<?php
	if (isset($_SESSION['mensaje'])) {
	echo "<p>" . htmlspecialchars($_SESSION['mensaje']) . "</p>";
	unset($_SESSION['mensaje']);
	}

	if (!isset($alarmas) || empty($alarmas)) {

		echo "<p>No hay alarmas registradas.</p>";

		} else {
	?>
			<table border="1">
			<tr>
				<th>Fecha</th>
				<th>Nombre de Medicación</th>
				<th>Apagada</th>
				<th>Acciones</th>
			</tr>

	<?php foreach ($alarmas as $a) { ?>
			<tr>
			
			<td><?php echo htmlspecialchars($a->fecha); ?></td>
			<td><?php echo htmlspecialchars($a->medicacion_id); ?></td>
			<td><?php echo $a->apagada ? "Sí" : "No"; ?></td>
			<td>
			<a href="index.php?controller=alarmas&action=editar&id=<?php echo $a->id; ?>">
			Editar
			</a>

	<a href="index.php?controller=alarmas&action=eliminar&id=<?php echo $a->id; ?>">
	Eliminar
	</a>

	<?php
	if (!$a->apagada) {
	?>
	<a href="index.php?controller=alarmas&action=apagaralarma&id=<?php echo $a->id; ?>">
	Apagar
	</a>
	<?php
	}
	?>
	</td>
	</tr>
	<?php } ?>
	</table>

	<?php
	}
	?>

<?php require_once("views/shared/footer.php"); ?>


