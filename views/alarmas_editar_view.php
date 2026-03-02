<?php require_once("views/shared/header.php"); ?>

<header>
    <h1>CAREMIND</h1>
    <p>Editar alarma</p>
</header>

<div class="contenedor">
    <div class="columna">

        <p>
            <a class="btn btn-secondary btn-sm" href="index.php?controller=alarmas&action=listado">
                Volver al listado
            </a>
        </p>

        <?php if (!isset($alarma) || !$alarma) { ?>
            <div class="alert alert-danger">Alarma no encontrada.</div>
        <?php } else { ?>

            <form method="post" action="index.php?controller=alarmas&action=editar&id=<?= $alarma->id ?>">

                <div class="mb-3">
                    <label class="form-label">Fecha y hora:</label>
                    <input class="form-control" type="datetime-local" name="fecha" required
                           value="<?= date('Y-m-d\TH:i', strtotime($alarma->fecha)); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Medicación ID:</label>
                    <input class="form-control" type="number" name="medicacion_id" required
                           value="<?= htmlspecialchars($alarma->medicacion_id) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">¿Apagada?</label>
                    <input type="checkbox" name="apagada" <?= ($alarma->apagada ? "checked" : "") ?>>
                </div>

                <button class="btn btn-caremind" type="submit">Guardar cambios</button>
            </form>

        <?php } ?>

    </div>
</div>

<?php require_once("views/shared/footer.php"); ?>
