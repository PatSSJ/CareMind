<?php require_once("views/shared/header.php"); ?>

<h2>Editar medicamento</h2>
<a href="index.php?controller=medicamentos&action=listado">Volver al listado</a>

<hr>

<?php if (!isset($med) || !$med) { ?>

<p>No se ha cargado el medicamento.</p>
<?php } else { ?>

<form method="post"
action="index.php?controller=medicamentos&action=editar&id=<?php echo $med->id; ?>">

<p>
Nombre Completo:
<input type="text"
name="nombre"
value="<?php echo htmlspecialchars($med->nombre); ?>"
required>
</p>

<p>
Dosis:
<input type="text"
name="dosis"
value="<?php echo htmlspecialchars($med->dosis); ?>">
</p>

<p>
<input type="submit" value="Guardar cambios">
</p>

</form>
<?php } ?>


<?php require_once("views/shared/footer.php"); ?>
