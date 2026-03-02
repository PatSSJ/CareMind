<?php require_once("views/shared/header.php"); ?>


<h2>Editar Alarma</h2>


<a href="index.php?controller=alarmas&action=listado">Volver</a>


<hr>


<?php if (!isset($alarma) || !$alarma) { ?>


<p>Alarma no encontrada.</p>


<?php } else { ?>


<form method="post"
action="index.php?controller=alarmas&action=editar&id=<?php echo $alarma->id; ?>">


<p>
Fecha y Hora:
<input type="datetime-local"
name="fecha"
value="<?php echo date('Y-m-d\TH:i', strtotime($alarma->fecha)); ?>"
required>
</p>


<p>
ID Medicación:
<input type="number"
name="medicacion_id"
value="<?php echo $alarma->medicacion_id; ?>"
required>
</p>


<p>
¿Está apagada?:
<input type="checkbox"
name="apagada"
<?php echo $alarma->apagada ? 'checked' : ''; ?>>
</p>


<input type="submit" value="Actualizar Alarma">


</form>


<?php } ?>


<?php require_once("views/shared/footer.php"); ?>
