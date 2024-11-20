<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Inventario - Droguerías Comfenalco</title>
    <link rel="stylesheet" href="css/stylesEditarC.css">
</head>
<body>

    <header class="header">
        <h1>Crear Inventario</h1>
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

    // Procesar la creación del inventario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idInventario = $_POST['idInventario'];
        $cantidadStock = $_POST['cantidadStock'];
        $fecha = $_POST['fecha'];
        $idProducto = $_POST['idProducto'];

        $sql = "INSERT INTO inventario (idInventario, cantidadStock, fecha, idProducto) 
                VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siss", $idInventario, $cantidadStock, $fecha, $idProducto);

        if ($stmt->execute()) {
            header("Location: inventario.php");
        } else {
            echo "<p>Error al crear el inventario: " . $stmt->error . "</p>";
        }
        $stmt->close();
    }

    $conn->close();
    ?>

    <!-- Formulario de creación de inventario -->
    <div class="container">
        <form action="crearInventario.php" method="POST">
            <h2>Crear Inventario</h2>
            <div class="form-group">
                <label for="idInventario">ID del Inventario:</label>
                <input type="text" id="idInventario" name="idInventario" required>
            </div>
            <div class="form-group">
                <label for="cantidadStock">Cantidad en Stock:</label>
                <input type="number" id="cantidadStock" name="cantidadStock" required>
            </div>
            <div class="form-group">
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>
            </div>
            <div class="form-group">
                <label for="idProducto">ID del Producto:</label>
                <input type="text" id="idProducto" name="idProducto" required>
            </div>
            <button type="submit">Guardar Inventario</button>
        </form>
    </div>

</body>
</html>
