<?php session_start(); ?>
<nav class="navbar">
    <div class="navbar-container">
        <a href="index.php" class="navbar-brand">
            <img src="images/logo.png" alt="Logo Droquerías Comfenalco" class="navbar-logo">
        </a>
        <ul class="navbar-nav">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="productos.php">Productos</a></li>
            <?php if (isset($_SESSION['usuario'])): ?>
                <li><a href="#"><?php echo $_SESSION['usuario']; ?></a></li>
                <li><a href="logout.php"><button class="Logout">Cerrar sesión</button></a></li>
            <?php else: ?>
                <li><a href="login.php">Iniciar sesión</a></li>
                <li><a href="registro.php">Registrarse</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
