<?php require_once("views/shared/header.php"); ?>

<h2>Listado de alarmas</h2>

<p>
    <a href="index.php?controller=personas&action=listado">Volver</a> |
    <a href="index.php?controller=alarmas&action=crear">Fijar nueva alarma</a>
</p>

<hr>

<?php
if (isset($_SESSION['mensaje'])) {
    echo "<p>" . htmlspecialchars($_SESSION['mensaje']) . "</p>";
    unset($_SESSION['mensaje']);
}

if (empty($alarmas)) {
    echo "<p>No hay alarmas registradas.</p>";
    require_once("views/shared/footer.php");
    return;
}
?>

<table border="1">
    <tr>
        <th>Fecha</th>
        <th>Medicamento</th>
        <th>Apagada</th>
        <th>Acciones</th>
    </tr>

    <?php foreach ($alarmas as $a) { ?>
        <tr>
            <td><?php echo htmlspecialchars($a->fecha); ?></td>
            <td><?php echo htmlspecialchars($a->medicamento_nombre); ?></td>
            <td><?php echo $a->apagada ? "Sí" : "No"; ?></td>
            <td>
                <a href="index.php?controller=alarmas&action=editar&id=<?php echo $a->id; ?>">Editar</a> |
                <a href="index.php?controller=alarmas&action=eliminar&id=<?php echo $a->id; ?>" onclick="return confirm('¿Eliminar?');">Eliminar</a>
                <?php
                echo !$a->apagada
                        ? ' | <a href="index.php?controller=alarmas&action=apagar&id=' . $a->id . '">Apagar</a>'
                        : '';
                ?>
            </td>
        </tr>
    <?php } require_once("views/shared/footer.php"); ?>
