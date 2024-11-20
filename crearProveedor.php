<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drogueriasconfe";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $idProveedor = $_POST['idProveedor'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    // Validación simple
    if (empty($idProveedor) || empty($nombre) || empty($email)) {
        echo "Todos los campos son requeridos.";
    } else {
        // Preparar la consulta SQL para insertar el nuevo proveedor
        $sql = "INSERT INTO proveedor (idProveedor, nombre, email) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $idProveedor, $nombre, $email);

        // Ejecutar la consulta y verificar si fue exitosa
        if ($stmt->execute()) {
            echo "Proveedor creado con éxito.";
            // Redirigir a la página de proveedores después de insertar
            header("Location: proveedor.php");
            exit;
        } else {
            echo "Error al crear proveedor: " . $stmt->error;
        }
    }
}

// Cerrar la conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Proveedor - Droquerías Comfenalco</title>
    <link rel="stylesheet" href="css/stylesEditarC.css">
</head>
<body>

    <header class="header">
        <h1>Crear Proveedor</h1>
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

    <!-- Formulario de creación de proveedor -->
    <div class="container">
        <form action="crearProveedor.php" method="POST">
            <div class="form-group">
                <label for="idProveedor">ID del Proveedor:</label>
                <input type="text" id="idProveedor" name="idProveedor" value="<?= isset($producto['idProveedor']) ? $producto['idProveedor'] : '' ?>" required>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre del Proveedor:</label>
                <input type="text" id="nombre" name="nombre" value="<?= isset($producto['nombre']) ? $producto['nombre'] : '' ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= isset($producto['email']) ? $producto['email'] : '' ?>" required>
            </div>

            <button type="submit">Guardar proveedor</button>
        </form>
    </div>

</body>
</html>
