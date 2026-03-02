<?php require_once("views/shared/header.php"); ?>

<header>
    <h1>CAREMIND</h1>
    <p>Listado de personas</p>
</header>

<div class="contenedor">
    <div class="columna">

        <h2>Personas</h2>

        <p>
            <a class="btn btn-secondary btn-sm" href="index.php?controller=auth&action=logout">Cerrar sesión</a>
            <a class="btn btn-caremind btn-sm" href="index.php?controller=personas&action=crear">Nueva persona</a>
            <a class="btn btn-caremind btn-sm" href="index.php?controller=alarmas&action=listado">Alarmas</a>
            <a class="btn btn-caremind btn-sm" href="index.php?controller=medicamentos&action=listado">Medicamentos</a>
        </p>

        <?php if (isset($_SESSION['mensaje'])) { ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($_SESSION['mensaje']); ?>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php } ?>

        <?php if (empty($personas)) { ?>
            <p>No hay personas registradas.</p>
        <?php } else { ?>

            <table class="table table-striped">
                <tr>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>NSS</th>
                    <th>Acciones</th>
                </tr>

                <?php foreach ($personas as $p) { ?>
                    <tr>
                        <td><?= htmlspecialchars($p->nombre) ?></td>
                        <td><?= htmlspecialchars($p->dni) ?></td>
                        <td><?= htmlspecialchars($p->telefono) ?></td>
                        <td><?= htmlspecialchars($p->direccion) ?></td>
                        <td><?= htmlspecialchars($p->num_seguridad_social) ?></td>
                        <td>
                            <a class="btn btn-danger btn-sm"
                               href="index.php?controller=personas&action=eliminar&id=<?= $p->id ?>"
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
