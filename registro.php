<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Droquerías Comfenalco</title>
    <link rel="stylesheet" href="css/stylesRegistro.css">
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

    <section class="register-section">
        <div class="register-container">
            <h2>Crear Cuenta</h2>
            <form action="register_process.php" method="POST" class="register-form">
                <div class="form-row">
                    <div class="input-group">
                        <label for="cedula">Cédula</label>
                        <input type="text" id="cedula" name="cedula" placeholder="Ingrese su cédula" required>
                    </div>
                    <div class="input-group">
                        <label for="primer_nombre">Primer Nombre</label>
                        <input type="text" id="primer_nombre" name="primer_nombre" placeholder="Ingrese su primer nombre" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label for="segundo_nombre">Segundo Nombre</label>
                        <input type="text" id="segundo_nombre" name="segundo_nombre" placeholder="Ingrese su segundo nombre">
                    </div>
                    <div class="input-group">
                        <label for="primer_apellido">Primer Apellido</label>
                        <input type="text" id="primer_apellido" name="primer_apellido" placeholder="Ingrese su primer apellido" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label for="segundo_apellido">Segundo Apellido</label>
                        <input type="text" id="segundo_apellido" name="segundo_apellido" placeholder="Ingrese su segundo apellido">
                    </div>
                    <div class="input-group">
                        <label for="fecha_nacimiento">Fecha de Nacimiento</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <label for="direccion">Dirección</label>
                        <input type="text" id="direccion" name="direccion" placeholder="Ingrese su dirección" required>
                    </div>
                    <div class="input-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" placeholder="Ingrese su correo electrónico" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group-full">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" placeholder="Ingrese su contraseña" required>
                    </div>
                </div>

                <button type="submit" class="register-button">Crear Cuenta</button>
            </form>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; 2024 Droquerías Comfenalco - Todos los derechos reservados</p>
    </footer>

</body>

</html>
