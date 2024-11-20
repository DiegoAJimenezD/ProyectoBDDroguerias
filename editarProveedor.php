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

// Verificar si se pasa un ID de proveedor en la URL
if (isset($_GET['idProveedor'])) {
    $idProveedor = $_GET['idProveedor'];

    // Obtener los datos del proveedor
    $sql = "SELECT idProveedor, nombre, email FROM proveedor WHERE idProveedor = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idProveedor);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $proveedor = $result->fetch_assoc();
    } else {
        echo "<p>Proveedor no encontrado.</p>";
        exit;
    }
} else {
    echo "<p>ID de proveedor no proporcionado.</p>";
    exit;
}

// Procesar la actualización de los datos del proveedor
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $idProveedor = $_POST['idProveedor'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];

    // Actualizar los datos en la base de datos
    $updateSql = "UPDATE proveedor SET nombre = ?, email = ? WHERE idProveedor = ?";
    $stmtUpdate = $conn->prepare($updateSql);
    $stmtUpdate->bind_param("ssi", $nombre, $email, $idProveedor);

    if ($stmtUpdate->execute()) {
        // Redirigir a proveedor.php después de una actualización exitosa
        header("Location: proveedor.php");
        exit; // Detener la ejecución después de la redirección
    } else {
        echo "<p>Error al actualizar el proveedor: " . $stmtUpdate->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proveedor - Droquerías Comfenalco</title>
    <link rel="stylesheet" href="css/stylesEditarC.css">
</head>
<body>

    <header class="header">
        <h1>Editar Proveedor</h1>
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

    <!-- Formulario de edición de proveedor -->
    <div class="container">
        <form action="editarProveedor.php?idProveedor=<?= $proveedor['idProveedor'] ?>" method="POST">
            <input type="hidden" name="idProveedor" value="<?= $proveedor['idProveedor'] ?>">

            <div class="form-group">
                <label for="nombre">Nombre del Proveedor:</label>
                <input type="text" id="nombre" name="nombre" value="<?= $proveedor['nombre'] ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= $proveedor['email'] ?>" required>
            </div>

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>

</body>
</html>
