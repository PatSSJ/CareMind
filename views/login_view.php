<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once("views/shared/header.php"); 
?>


<header>
	<h1>CAREMIND</h1>
	<p>Acceso al sistema</p>
</header>

<div class="contenedor">
	<div class="columna izquierda">
    	<h2>Bienvenido de nuevo</h2>
    	<p>Introduce tu identificación de cuidador para gestionar tus pacientes.</p>
    	<p>
            <a href="index.php?controller=auth&action=inicio" class="text-decoration-none">
                Volver al inicio
            </a>
        </p>
	</div>

	<div class="columna derecha">

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

    	<form action="index.php?controller=auth&action=login" method="post">

        	<div class="mb-3">
            	<label class="form-label">Correo electrónico:</label>
            	<input class="form-control"
                       type="email"
                       name="email"
                       required
                       placeholder="correo@correo.com">
        	</div>

        	<div class="mb-3">
            	<label class="form-label">Contraseña:</label>
            	<input class="form-control"
                       type="password"
                       name="password"
                       required>
        	</div>

        	<button type="submit" class="btn btn-caremind">
                Entrar
            </button>

        	<div class="text-center">
            	<a href="index.php?controller=auth&action=register"
                   class="btn btn-outline-secondary btn-sm">
                   ¿No tienes cuenta? Regístrate
                </a>
        	</div>

    	</form>
	</div>
</div>

<?php require_once("views/shared/footer.php"); ?>

