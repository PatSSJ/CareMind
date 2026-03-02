<?php require_once("views/shared/header.php"); ?>

<header>
    <h1>CAREMIND</h1>
    <p>Listado de medicamentos</p>
</header>

<div class="contenedor">
    <div class="columna">

        <h2>Medicamentos</h2>

        <p>
            <a class="btn btn-secondary btn-sm" href="index.php?controller=personas&action=listado">Volver</a>
            <a class="btn btn-caremind btn-sm" href="index.php?controller=medicamentos&action=crear">Nuevo medicamento</a>
        </p>

        <?php if (isset($_SESSION['mensaje'])) { ?>
            <p><?= htmlspecialchars($_SESSION['mensaje']) ?></p>
            <?php unset($_SESSION['mensaje']); ?>
        <?php } ?>

        <?php if (empty($medicamentos)) { ?>
            <p>No hay medicamentos.</p>
        <?php } else { ?>
            <table border="1">
                <tr>
                    <th>Nombre</th>
                    <th>Dosis</th>
                    <th>Acciones</th>
                </tr>
                <?php foreach ($medicamentos as $m) { ?>
                    <tr>
                        <td><?= htmlspecialchars($m->nombre) ?></td>
                        <td><?= htmlspecialchars($m->dosis) ?></td>
                        <td>
                            <a href="index.php?controller=medicamentos&action=eliminar&id=<?= $m->id ?>"
                               onclick="return confirm('¿Eliminar?');">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>

    </div>
</div>

<?php require_once("views/shared/footer.php"); ?>



