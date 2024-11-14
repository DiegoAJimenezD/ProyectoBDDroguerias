<?php
// Incluir la conexión a la base de datos
include('conexion.php');

// Verificar si se ha pasado una cédula por URL
if (isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    // Obtener los datos actuales del cliente
    $sql = "SELECT cedula, primernombre, segundonombre, primerapellido, segundoapellido, fechanacimiento, email FROM cliente WHERE cedula = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('s', $cedula);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $cliente = $result->fetch_assoc();
        } else {
            echo "Cliente no encontrado.";
            exit();
        }
        $stmt->close();
    } else {
        echo "Error al consultar la base de datos.";
        exit();
    }

    // Verificar si se ha enviado el formulario para actualizar los datos
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Obtener los nuevos valores desde el formulario
        $primernombre = $_POST['primernombre'];
        $segundonombre = $_POST['segundonombre'];
        $primerapellido = $_POST['primerapellido'];
        $segundoapellido = $_POST['segundoapellido'];
        $fechanacimiento = $_POST['fechanacimiento'];
        $email = $_POST['email'];

        // Actualizar los datos en la base de datos
        $update_sql = "UPDATE cliente SET primernombre = ?, segundonombre = ?, primerapellido = ?, segundoapellido = ?, fechanacimiento = ?, email = ? WHERE cedula = ?";
        if ($update_stmt = $conn->prepare($update_sql)) {
            $update_stmt->bind_param('sssssss', $primernombre, $segundonombre, $primerapellido, $segundoapellido, $fechanacimiento, $email, $cedula);
            if ($update_stmt->execute()) {
                header('Location: cliente.php?mensaje=Cliente actualizado correctamente');
                exit();
            } else {
                echo "Error al actualizar el cliente.";
            }
            $update_stmt->close();
        } else {
            echo "Error al preparar la consulta de actualización.";
        }
    }
} else {
    echo "No se ha especificado una cédula.";
    exit();
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="css/stylesEditarC.css">
</head>
<body>
    <header>
        <h1>Editar Cliente</h1>
        <nav>
            <ul>
                <li><a href="cliente.php">Clientes</a></li>
                <li><a href="empleado.php">Empleados</a></li>
                <li><a href="sucursal.php">Sucursales</a></li>
                <li><a href="producto.php">Productos</a></li>
                <li><a href="inventario.php">Inventario</a></li>
                <li><a href="proveedor.php">Proveedores</a></li>
                <li><a href="pedido.php">Pedidos</a></li>
                <li><a href="venta.php">Ventas</a></li>
                <li><a href="administrador.php">Panel</a></li>
            </ul>
        </nav>
    </header>

    <form method="POST" action="editarCliente.php?cedula=<?php echo $cliente['cedula']; ?>">
        <label for="primernombre">Primer Nombre:</label>
        <input type="text" id="primernombre" name="primernombre" value="<?php echo $cliente['primernombre']; ?>" required>

        <label for="segundonombre">Segundo Nombre:</label>
        <input type="text" id="segundonombre" name="segundonombre" value="<?php echo $cliente['segundonombre']; ?>">

        <label for="primerapellido">Primer Apellido:</label>
        <input type="text" id="primerapellido" name="primerapellido" value="<?php echo $cliente['primerapellido']; ?>" required>

        <label for="segundoapellido">Segundo Apellido:</label>
        <input type="text" id="segundoapellido" name="segundoapellido" value="<?php echo $cliente['segundoapellido']; ?>">

        <label for="fechanacimiento">Fecha de Nacimiento:</label>
        <input type="date" id="fechanacimiento" name="fechanacimiento" value="<?php echo $cliente['fechanacimiento']; ?>" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" value="<?php echo $cliente['email']; ?>" required>

        <button type="submit">Actualizar Cliente</button>
    </form>

</body>
</html>
