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
        echo '<div id="errorMessage" class="toast error">Todos los campos son requeridos.</div>';
    } else {
        // Preparar la consulta SQL para insertar el nuevo proveedor
        $sql = "INSERT INTO proveedor (idProveedor, nombre, email) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $idProveedor, $nombre, $email);

        // Ejecutar la consulta y verificar si fue exitosa
        if ($stmt->execute()) {
            echo '<div id="successMessage" class="toast success">Proveedor creado con éxito.</div>';
            // Redirigir a la página de proveedores después de insertar
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "proveedor.php";
                    }, 3000); // Redirigir después de 3 segundos
                  </script>';
        } else {
            echo '<div id="errorMessage" class="toast error">Error al crear proveedor: ' . $stmt->error . '</div>';
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
