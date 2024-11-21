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

// Procesar la creación del producto
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $idProducto = $_POST['idProducto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $categoriaProducto = $_POST['categoriaProducto'];
    $imagenUrl = null;

    // Manejar la imagen si se sube
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "images/"; // Carpeta donde se guardarán las imágenes
        $fileName = basename($_FILES['imagen']['name']);
        $targetFile = $targetDir . $fileName;

        // Verificar que la carpeta exista, si no, crearla
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Mover el archivo subido a la carpeta
        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $targetFile)) {
            $imagenUrl = $targetFile; // Guardar la ruta de la imagen
        } else {
            echo "<p>Error al subir la imagen.</p>";
        }
    }

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO producto (idProducto, nombre, precio, categoriaProducto, imagen) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    // Vincular los parámetros correctamente
    $stmt->bind_param("ssdss", $idProducto, $nombre, $precio, $categoriaProducto, $imagenUrl);

    // Ejecutar la consulta y verificar el resultado
    if ($stmt->execute()) {
        echo '<div id="successMessage" class="toast success">Producto creado con éxito.</div>';
        // Redirigir a la página de productos después de 3 segundos
        echo '<script>
                setTimeout(function() {
                    window.location.href = "producto.php";
                }, 3000);
              </script>';
    } else {
        echo '<div id="errorMessage" class="toast error">Error al crear el producto: ' . $stmt->error . '</div>';
    }

    $stmt->close(); // Cerrar la consulta preparada
}

$conn->close(); // Cerrar la conexión
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Producto - Droguerías Comfenalco</title>
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
    <h1>Crear Producto</h1>
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

<!-- Formulario de creación de producto -->
<div class="container">
    <form action="crearProductos.php" method="POST" enctype="multipart/form-data">
        
        <div class="form-group">
            <label for="idProducto">ID del Producto:</label>
            <input type="text" id="idProducto" name="idProducto" required>
        </div>

        <div class="form-group">
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>

        <div class="form-group">
            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" step="0.01" required>
        </div>

        <div class="form-group">
            <label for="categoriaProducto">Categoría:</label>
            <input type="number" id="categoriaProducto" name="categoriaProducto" required>
        </div>

        <!-- Campo para subir imagen -->
        <div class="form-group">
            <label for="imagen">Imagen del Producto:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*">
        </div>

        <button type="submit">Guardar Producto</button>
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