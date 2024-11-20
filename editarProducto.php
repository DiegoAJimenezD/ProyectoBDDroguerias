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

// Verificar si se pasa un ID de producto en la URL
if (isset($_GET['idProducto'])) {
    $idProducto = $_GET['idProducto'];

    // Obtener los datos del producto
    $sql = "SELECT idProducto, nombre, precio, categoriaProducto FROM producto WHERE idProducto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idProducto);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();
    } else {
        echo "<p>Producto no encontrado.</p>";
        exit;
    }
} else {
    echo "<p>ID de producto no proporcionado.</p>";
    exit;
}

// Procesar la actualización de los datos del producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $idProducto = $_POST['idProducto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoria = $_POST['categoria'];

    // Actualizar los datos en la base de datos
    $updateSql = "UPDATE producto SET nombre = ?, precio = ?, categoriaProducto = ? WHERE idProducto = ?";
    $stmtUpdate = $conn->prepare($updateSql);
    $stmtUpdate->bind_param("sssi", $nombre, $precio, $categoria, $idProducto);

    if ($stmtUpdate->execute()) {
        // Redirigir a producto.php después de una actualización exitosa
        header("Location: producto.php");
        exit; // Detener la ejecución después de la redirección
    } else {
        echo "<p>Error al actualizar el producto: " . $stmtUpdate->error . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Droquerías Comfenalco</title>
    <link rel="stylesheet" href="css/stylesEditarC.css">
</head>
<body>

    <header class="header">
        <h1>Editar Producto</h1>
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

    <!-- Formulario de edición de producto -->
    <div class="container">
        <form action="editarProducto.php?idProducto=<?= $producto['idProducto'] ?>" method="POST">
            <input type="hidden" name="idProducto" value="<?= $producto['idProducto'] ?>">

            <div class="form-group">
                <label for="nombre">Nombre del Producto:</label>
                <input type="text" id="nombre" name="nombre" value="<?= $producto['nombre'] ?>" required>
            </div>

            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" value="<?= $producto['precio'] ?>" required>
            </div>

            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <input type="text" id="categoria" name="categoria" value="<?= $producto['categoriaProducto'] ?>" required>
            </div>

            <button type="submit">Guardar Cambios</button>
        </form>
    </div>

    <?php
    $conn->close();
    ?>

</body>
</html>