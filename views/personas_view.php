<?php require_once("views/shared/header.php"); ?>

<header>
  <h1>CAREMIND</h1>
  <p>Listado de personas</p>
</header>

<div class="contenedor">
  <div class="columna">

    <h2>Personas</h2>

    <p>
      <a class="btn btn-secondary btn-sm"
         href="index.php?controller=auth&action=logout">
         Cerrar sesión
      </a>

      <a class="btn btn-caremind btn-sm"
         href="index.php?controller=personas&action=crear">
         Nueva persona
      </a>
    </p>

	<?php 
	if (isset($_SESSION['mensaje'])): {
	echo "<div class='alert alert-success'>" .
        	htmlspecialchars($_SESSION['mensaje']);
        	"</div>";
	unset($_SESSION['mensaje']);
	}

	if (!empty($personas)) {

		echo "<p>No hay personas registradas.</p>";
	} else {

		echo "<table class='table table-striped'>";
        	echo "<tr>
	                <th>Nombre</th>
            		<th>DNI</th>
	                <th>Teléfono</th>
            		<th>Dirección</th>
          	                                                           </tr>";

          foreach ($personas as $p): {

		echo "<tr>";
   		echo "<td>" . htmlspecialchars($p->nombre) . "</td>";
                echo "<td>" . htmlspecialchars($p->dni) . "</td>";
                echo "<td>" . htmlspecialchars($p->telefono) . "</td>";
		echo "<td>" . htmlspecialchars($p->direcccion) . "</td>";
		echo "<td>"

		<a class='btn btn-danger btn-sm'
			href='index.php?controller=personas&action=eliminar&id=" . $p->id . "'
			onclick=\"return confirm('¿Eliminar esta persona?');\">
			Eliminar
		</a>
	</td>";
	echo "</tr>";
	}

	echo "</table>";
}
?>

<?php require_once("views/shared/footer.php"); ?>

