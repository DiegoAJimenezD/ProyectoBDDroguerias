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
        // Mostrar mensaje de éxito
        echo '<div id="successMessage" class="toast success">Producto actualizado correctamente.</div>';
        // Redirigir después de un breve retardo para que se vea la alerta
        echo '<script>
                setTimeout(function() {
                    window.location.href = "producto.php";
                }, 3000); // Redirigir después de 3 segundos
              </script>';
    } else {
        echo '<div id="errorMessage" class="toast error">Error al actualizar el producto.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto - Droguerías Comfenalco</title>
    <link rel="stylesheet" href="css/stylesEditarC.css">
    <style>
        /* Estilo para el panel de alerta (toast) */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            border-radius: 5px;
            font-size: 16px;
            z-index: 9999;
            opacity: 0;
            transform: translateY(-50px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        /* Estilo para la alerta de éxito */
        .toast.success {
            background-color: #4CAF50; /* Verde para éxito */
        }

        /* Estilo para la alerta de error */
        .toast.error {
            background-color: #f44336; /* Rojo para error */
        }

        /* Mostrar el toast */
        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
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

    <script>
        // Mostrar el mensaje de éxito con un pequeño retardo para que se vea
        window.onload = function() {
            const successMessage = document.getElementById('successMessage');
            const errorMessage = document.getElementById('errorMessage');

            if (successMessage) {
                successMessage.classList.add('show');
            } else if (errorMessage) {
                errorMessage.classList.add('show');
            }
        };
    </script>

</body>
</html>