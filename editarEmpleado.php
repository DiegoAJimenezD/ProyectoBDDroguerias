<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empleado - Droquerías Comfenalco</title>
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
    <h1>Editar Empleado</h1>
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
        // Mostrar mensaje de éxito
        echo '<div id="successMessage" class="toast success">Empleado actualizado exitosamente.</div>';
        // Redirigir después de un breve retardo para que se vea la alerta
        echo '<script>
                setTimeout(function() {
                    window.location.href = "empleado.php";
                }, 3000); // Redirigir después de 3 segundos
              </script>';
    } else {
        echo '<div id="errorMessage" class="toast error">Error al actualizar el empleado: ' . $stmtUpdate->error . '</div>';
    }
    $stmtUpdate->close();
}

$conn->close();
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