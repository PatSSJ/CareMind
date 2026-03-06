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

        <?php if (empty($personas)) { ?>

            <p>No tienes perfiles creados.</p>

            <a class="btn btn-caremind"
               href="index.php?controller=personas&action=crear">
                Crear perfil
            </a>

        <?php } else { ?>

            <form method="post" action="index.php?controller=alarmas&action=crear">

                <div class="mb-3">

                    <label>Perfil (persona):</label>

                    <select class="form-control" name="persona_id">

                        <option value="">Selecciona una persona</option>

                        <?php foreach ($personas as $p) { ?>

                            <option value="<?php echo $p->id; ?>">

                                <?php echo htmlspecialchars($p->nombre); ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>


                <div class="mb-3">

                    <label>Fecha y hora:</label>

                    <input class="form-control"
                           type="datetime-local"
                           name="fecha">

                </div>


                <div class="mb-3">

                    <label>Medicamento:</label>

                    <select class="form-control" name="medicacion_id">

                        <option value="">Selecciona medicamento</option>

                        <?php foreach ($medicamentos as $m) { ?>

                            <option value="<?php echo $m->id; ?>">

                                <?php echo htmlspecialchars($m->nombre); ?>

                            </option>

                        <?php } ?>

                    </select>

                </div>

                <button class="btn btn-caremind" type="submit">
                    Guardar
                </button>

            </form>

        <?php } ?>

    </div>
</div>

<?php require_once("views/shared/footer.php"); ?>
