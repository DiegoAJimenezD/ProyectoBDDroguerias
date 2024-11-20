<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado - Droquerías Comfenalco</title>
    <link rel="stylesheet" href="css/stylesEditarC.css">
</head>
<body>

    <header class="header">
        <h1>Editar Empleado</h1>
        <nav>
            <ul>
            <li><a href="cliente.php">Clientes</a></li>
                <li><a href="empleado.php">Empleados</a></li>
                <li><a href="producto.php">Productos</a></li>
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

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verificar si se pasa un ID de empleado en la URL
    if (isset($_GET['id'])) {
        $idEmpleado = $_GET['id'];

        // Obtener los datos del empleado
        $sql = "SELECT idEmpleado, nombre, horario, sucursal, email FROM empleado WHERE idEmpleado = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idEmpleado);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $empleado = $result->fetch_assoc();
        } else {
            echo "<p>Empleado no encontrado.</p>";
            exit;
        }
    } else {
        echo "<p>ID de empleado no proporcionado.</p>";
        exit;
    }

    // Procesar la actualización de los datos del empleado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos del formulario
        $idEmpleado = $_POST['idEmpleado'];
        $nombre = $_POST['nombre'];
        $horario = $_POST['horario'];
        $sucursal = $_POST['sucursal'];
        $email = $_POST['email'];

        // Actualizar los datos en la base de datos
        $updateSql = "UPDATE empleado SET nombre = ?, horario = ?, sucursal = ?, email = ? WHERE idEmpleado = ?";
        $stmtUpdate = $conn->prepare($updateSql);
        $stmtUpdate->bind_param("ssssi", $nombre, $horario, $sucursal, $email, $idEmpleado);

        if ($stmtUpdate->execute()) {
            // Redirigir a empleado.php después de una actualización exitosa
            header("Location: empleado.php");
            exit; // Detener la ejecución después de la redirección
        } else {
            echo "<p>Error al actualizar los datos: " . $stmtUpdate->error . "</p>";
        }
    }
    ?>

    <!-- Formulario de edición de empleado -->
    <div class="container">
        <form action="editarEmpleado.php?id=<?= $empleado['idEmpleado'] ?>" method="POST">
            <input type="hidden" name="idEmpleado" value="<?= $empleado['idEmpleado'] ?>">

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?= $empleado['nombre'] ?>" required>
            </div>

            <div class="form-group">
                <label for="horario">Horario:</label>
                <input type="text" id="horario" name="horario" value="<?= $empleado['horario'] ?>" required>
            </div>

            <div class="form-group">
                <label for="sucursal">Sucursal:</label>
                <input type="text" id="sucursal" name="sucursal" value="<?= $empleado['sucursal'] ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="<?= $empleado['email'] ?>" required>
            </div>

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>

    <?php
    $conn->close();
    ?>

</body>
</html>
