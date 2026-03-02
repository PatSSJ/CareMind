<?php require_once("views/shared/header.php"); ?>

<header class="text-center mt-4">
    <h1>CAREMIND</h1>
    <p>Acceso a la Web</p>
</header>

<div class="contenedor">

    <div class="columna izquierda">
        <h2>¡Bienvenido de nuevo!</h2>
        <p>
            <a href="index.php?controller=auth&action=inicio" class="text-decoration-none">
                Volver al inicio
            </a>
        </p>
    </div>

    <div class="columna derecha">

        <?php if (isset($_SESSION['error'])) { ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($_SESSION['error']); ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php } ?>

        <?php if (isset($_SESSION['mensaje'])) { ?>
            <div class="alert alert-success">
                <?php echo htmlspecialchars($_SESSION['mensaje']); ?>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php } ?>

        <form action="index.php?controller=auth&action=login" method="post" class="mb-4">
            <div class="mb-3">
                <label class="form-label">Correo electrónico:</label>
                <input class="form-control" type="email" name="email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña:</label>
                <input class="form-control" type="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-caremind">Entrar</button>

            <div class="text-center mt-2">
                <a href="index.php?controller=auth&action=register" class="btn btn-outline-secondary btn-sm">
                    ¿No tienes cuenta? Regístrate
                </a>
            </div>
        </form>

        <hr>

        <form action="index.php?controller=auth&action=login" method="post">
            <div class="mb-3">
                <label>Acceso con PIN:</label>
                <input class="form-control" type="text" name="pin" required>
            </div>
            <button type="submit" class="btn btn-danger">Acceder con PIN</button>
        </form>

    </div>
</div>

<?php require_once("views/shared/footer.php"); ?>
