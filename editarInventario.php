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
        // Mostrar mensaje de éxito
        echo '<div id="successMessage" class="toast success">Inventario actualizado exitosamente.</div>';
        // Redirigir después de un breve retardo para que se vea la alerta
        echo '<script>
                setTimeout(function() {
                    window.location.href = "inventario.php";
                }, 3000); // Redirigir después de 3 segundos
              </script>';
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