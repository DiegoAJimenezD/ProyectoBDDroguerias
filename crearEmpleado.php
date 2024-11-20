<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Empleado - Droguerías Comfenalco</title>
    <link rel="stylesheet" href="css/stylesEditarC.css">
</head>
<body>

    <header class="header">
        <h1>Crear Empleado</h1>
        <nav>
            <ul>
                <li><a href="empleado.php">Empleados</a></li>
                <li><a href="producto.php">Productos</a></li>
                <li><a href="proveedor.php">Proveedores</a></li>
                <li><a href="inventario.php">Inventario</a></li>
                <li><a href="administrador.php">Panel</a></li> 
            </ul>
        </nav>
    </header>

    <?php
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "drogueriasconfe";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar si la conexión fue exitosa
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Procesar la creación del empleado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos del formulario
        $idEmpleado = $_POST['idEmpleado'];
        $nombre = $_POST['nombre'];
        $horario = $_POST['horario'];
        $sucursal = $_POST['sucursal'];
        $email = $_POST['email'];
        $contrasena = $_POST['contrasena'];

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO empleado (idEmpleado, nombre, horario, sucursal, email, contrasena) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $idEmpleado, $nombre, $horario, $sucursal, $email, $contrasena);

        if ($stmt->execute()) {
            // Redirigir a la página de empleados después de la creación exitosa
            header("Location: empleado.php");
            exit; // Detener la ejecución después de la redirección
        } else {
            echo "<p>Error al crear el empleado: " . $stmt->error . "</p>";
        }
    }

    ?>

    <!-- Formulario de creación de empleado -->
    <div class="container">
        <form action="crearEmpleado.php" method="POST">
            <div class="form-group">
                <label for="idEmpleado">Id Empleado:</label>
                <input type="text" id="idEmpleado" name="idEmpleado" required>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="horario">Horario:</label>
                <input type="time" id="horario" name="horario" required>
            </div>

            <div class="form-group">
                <label for="sucursal">Sucursal:</label>
                <input type="text" id="sucursal" name="sucursal" required>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" id="contrasena" name="contrasena" required>
            </div>

            <button type="submit">Guardar empleado</button>
        </form>
    </div>

</body>
</html>
