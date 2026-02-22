<?php require_once("views/shared/header.php"); ?>

<header>
  <h1>CAREMIND</h1>
  <p>Conectar es cuidar</p>
</header>

<div class="contenedor">
  <div class="columna izquierda text-center">
    <h2>Inicio (MVP)</h2>
    <p>Tecnología accesible para el bienestar de las personas mayores.</p>
  </div>

  <div class="columna derecha">
    <h2>Acceso</h2>
    <p>Bienvenido al portal de cuidado. Por favor, selecciona una opción:</p>

    <div class="d-grid gap-3">
      <a class="btn btn-caremind" href="index.php?controller=auth&action=login">Iniciar Sesión</a>
      <a class="btn btn-secondary" href="index.php?controller=auth&action=register">Crear cuenta nueva</a>
    </div>

    <hr>

    <p class="text-center">
      <small>Acceso rápido para desarrollo:</small><br>
      <a href="index.php?controller=personas&action=listado" class="text-decoration-none">
        Ir al Panel Admin
      </a>
    </p>
  </div>
</div>

<?php require_once("views/shared/footer.php"); ?>

