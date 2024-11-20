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

// Inicializar variables
$idInventario = $fecha = $cantidadStock = $idProducto = "";
$error = "";

// Verificar si llega el parámetro `id`
if (isset($_GET['id'])) {
    $idInventario = $_GET['id'];

    // Consulta para obtener los datos del inventario
    $sql = "SELECT * FROM inventario WHERE idInventario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idInventario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $fecha = $row['fecha'];
        $cantidadStock = $row['cantidadStock'];
        $idProducto = $row['idProducto'];
    } else {
        $error = "No se encontró el registro con ID: $idInventario";
    }
    $stmt->close();
}

// Verificar si se envió el formulario para actualizar los datos
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fecha = $_POST['fecha'];
    $cantidadStock = $_POST['cantidadStock'];

    // Actualizar los datos en la base de datos
    $sql = "UPDATE inventario SET fecha = ?, cantidadStock = ? WHERE idInventario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $fecha, $cantidadStock, $idInventario);

    if ($stmt->execute()) {
        echo "<script>alert('Inventario actualizado exitosamente');</script>";
        echo "<script>window.location.href = 'inventario.php';</script>";
    } else {
        $error = "Error al actualizar el inventario: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Inventario</title>
    <link rel="stylesheet" href="css/stylesEditarC.css">
    <!-- Agregar iconos de Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <header class="header">
        <h1>Editar Inventario</h1>
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

    <main>
        <?php if ($error): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php else: ?>
            <form action="editarInventario.php?id=<?php echo $idInventario; ?>" method="post" class="form-inventario">
                <div class="form-group">
                    <label for="fecha">Fecha:</label>
                    <input type="date" id="fecha" name="fecha" value="<?php echo htmlspecialchars($fecha); ?>" required>
                </div>
                <div class="form-group">
                    <label for="cantidadStock">Cantidad Stock:</label>
                    <input type="number" id="cantidadStock" name="cantidadStock" value="<?php echo htmlspecialchars($cantidadStock); ?>" required>
                </div>
                <p>ID Producto asociado: <strong><?php echo htmlspecialchars($idProducto); ?></strong></p>
                <div class="form-buttons">
                    <button type="submit" class="btn guardar"><i class="fas fa-save"></i> Guardar Cambios</button>
                </div>
            </form>
        <?php endif; ?>
    </main>
</body>
</html>
