<?php include "views/shared/header.php"; ?>

<header>
    <h1>CAREMIND</h1>
    <p>Editar alarma</p>
</header>

<div class="contenedor">
    <div class="columna">
        <h2>Editar alarma</h2>    
		<p>
            	<a class="btn btn-secondary btn-sm" href="index.php?controller=alarmas&action=listado">
                Volver al listado
            	</a>
        	</p>

        	<?php if (isset($al) && $al) { ?>
            
            	<form method="post" action="index.php?controller=alarmas&action=editar&id=<?= $al->id ?>">
    		<div class="mb-3">
                    <label>Fecha y hora:</label>
                    <input class="form-control" type="datetime-local" name="fecha" required 
                           value="<?= str_replace(' ', 'T', substr($al->fecha, 0, 16)) ?>">
                </div>

                <div class="mb-3">
                    <label>ID de Medicación:</label>
                    <input class="form-control" type="number" name="medicacion_id" required 
                           value="<?= $al->medicacion_id ?>">
                </div>

                <button class="btn btn-caremind" type="submit">Guardar cambios</button>
                
            	</form>

		<?php } else { ?>
            	<div class="alert alert-danger">Error: No se encontró la alarma.</div>
        	<?php } ?>

    	</div>
</div>

<?php include "views/shared/footer.php"; ?>
