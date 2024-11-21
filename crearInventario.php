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

// Procesar la creación o actualización del inventario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idInventario = $_POST['idInventario'];
    $cantidadStock = $_POST['cantidadStock'];
    $fecha = $_POST['fecha'];
    $idProducto = $_POST['idProducto'];

    // Verificar si ya existe una entrada con el mismo idInventario y idProducto
    $checkQuery = "SELECT * FROM inventario WHERE idInventario = ? AND idProducto = ?";
    $stmt = $conn->prepare($checkQuery);
    $stmt->bind_param("si", $idInventario, $idProducto);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Si existe, actualizar la cantidad en stock
        $updateQuery = "UPDATE inventario SET cantidadStock = cantidadStock + ? WHERE idInventario = ? AND idProducto = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("iis", $cantidadStock, $idInventario, $idProducto);

        if ($updateStmt->execute()) {
            echo '<div id="successMessage" class="toast success">Stock actualizado correctamente.</div>';
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "inventario.php";
                    }, 3000);
                  </script>';
        } else {
            echo '<div id="errorMessage" class="toast error">Error al actualizar el stock: ' . $updateStmt->error . '</div>';
        }
        $updateStmt->close();
    } else {
        // Si no existe, insertar un nuevo registro
        $insertQuery = "INSERT INTO inventario (idInventario, cantidadStock, fecha, idProducto) 
                        VALUES (?, ?, ?, ?)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("siss", $idInventario, $cantidadStock, $fecha, $idProducto);

        if ($insertStmt->execute()) {
            echo '<div id="successMessage" class="toast success">Inventario creado correctamente.</div>';
            echo '<script>
                    setTimeout(function() {
                        window.location.href = "inventario.php";
                    }, 3000);
                  </script>';
        } else {
            echo '<div id="errorMessage" class="toast error">Error al crear el inventario: ' . $insertStmt->error . '</div>';
        }
        $insertStmt->close();
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
    <title>Crear Inventario - Droguerías Comfenalco</title>
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