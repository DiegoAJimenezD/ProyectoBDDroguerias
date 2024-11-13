<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Droquerías Comfenalco</title>
    <link rel="stylesheet" href="css/stylesLogin.css">
</head>

<body>

    <header class="header">
        <h1>Droquerías Comfenalco</h1>
        <p>Todo lo que necesitas para tu salud y bienestar</p>
    </header>

    <nav class="navbar">
        <div class="navbar-container">
            <a href="index.php" class="navbar-brand">
                <img src="images/logo.png" alt="Logo Droquerías Comfenalco" class="navbar-logo">
            </a>
            <ul class="navbar-nav">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="login.php">Iniciar sesión</a></li>
                <li><a href="registro.php">Registrarse</a></li>
            </ul>
        </div>
    </nav>

    <section class="login-section">
        <div class="login-container">
            <h2>Iniciar Sesión</h2>
            <form action="login_process.php" method="POST" class="login-form">
                <div class="input-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" placeholder="Ingrese su correo electrónico" required>
                </div>
                <div class="input-group">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>
                </div>
                <button type="submit" class="login-button">Iniciar Sesión</button>
            </form>
            <p class="forgot-password"><a href="#">¿Olvidaste tu contraseña?</a></p>
            <p class="register">¿No tienes una cuenta? <a href="registro.php">Regístrate aquí</a></p>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2024 Droquerías Comfenalco - Todos los derechos reservados</p>
    </footer>

</body>

</html>


