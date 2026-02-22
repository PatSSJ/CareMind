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

    <?php if (isset($_SESSION['mensaje'])): ?>
      <div class="alert alert-success">
        <?php echo $_SESSION['mensaje']; ?>
      </div>
      <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <?php if (!isset($personas) || empty($personas)): ?>

      <p>No hay personas registradas.</p>

    <?php else: ?>

      <table class="table table-striped">
        
          <tr>
            <th>Nombre</th>
            <th>DNI</th>
            <th>Teléfono</th>
            <th>Dirección</th>
          </tr>
        

        
          <?php foreach ($personas as $p): ?>
            <tr>
              <td><?php echo $p->nombre; ?></td>
              <td><?php echo $p->dni; ?></td>
              <td><?php echo $p->telefono; ?></td>
              <td><?php echo $p->direccion; ?></td>
            </tr>
          <?php endforeach; ?>
        

      </table>

    <?php endif; ?>

  </div>
</div>

<?php require_once("views/shared/footer.php"); ?>

