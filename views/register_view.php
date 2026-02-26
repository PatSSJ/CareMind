<?php require_once("views/shared/header.php"); ?>

<header>
	<h1>CAREMIND</h1>
	<p>Únete a nuestra comunidad</p>
</header>

<div class="contenedor">
	<div class="columna izquierda">
    	<h2>Registro de Cuidador</h2>
    	<p>Crea tu cuenta en CareMind para empezar a configurar perfiles de dependientes y sus medicaciones.</p>
    	<p>
            <a href="index.php?controller=auth&action=inicio" class="text-decoration-none"> Volver</a>
        </p>
	</div>

	<div class="columna derecha">

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php echo $_SESSION['error']; ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

    	<form action="index.php?controller=auth&action=register" method="post">
        	<div class="mb-2">
            	<label class="form-label">Nombre completo:</label>
            	<input class="form-control" type="text" name="nombre" required>
        	</div>

        	<div class="mb-2">
            	<label class="form-label">Email:</label>
            	<input class="form-control" type="email" name="email" required>
        	</div>

        	<div class="mb-2">
            	<label class="form-label">Contraseña:</label>
            	<input class="form-control" type="password" name="password" required>
        	</div>

        	<div class="mb-3">
            	<label class="form-label">Confirmar contraseña:</label>
            	<input class="form-control" type="password" name="confirm_password" required>
        	</div>
		
        	<button type="submit" class="btn btn-caremind w-100 mb-2">Crear mi cuenta</button>
        	<a class="btn btn-secondary w-100" href="index.php?controller=auth&action=login">Ya tengo una cuenta</a>
    	</form>
	</div>
</div>

<?php require_once("views/shared/footer.php"); ?>

