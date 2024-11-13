<?php
// Incluir la conexión a la base de datos
include('conexion.php');

// Realizar la consulta a la base de datos
$sql = "SELECT cedula, primernombre, segundonombre, primerapellido, segundoapellido, fechanacimiento, email FROM cliente";
$result = $conn->query($sql);

// Comprobar si hay resultados
if ($result->num_rows > 0) {
    // Si hay resultados, generamos las filas de la tabla
    $clientes = [];
    while($row = $result->fetch_assoc()) {
        $clientes[] = $row; // Almacenamos los datos en un arreglo
    }
} else {
    $clientes = [];
}

// Cerrar la conexión
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="css/stylesListas.css">
</head>
<body>
    <header>
        <h1>Clientes</h1>
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
                <li><a href="login.php">regresar</a></li>
                
            </ul>
        </nav>
    </header>

    <button onclick="recargarDatos()">Recargar Datos</button>
    <table border="1">
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Primer Nombre</th>
                <th>Segundo Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Fecha Nacimiento</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody id="datosCliente">
            <?php
            // Mostrar los resultados de la consulta
            if (count($clientes) > 0) {
                foreach ($clientes as $cliente) {
                    echo "<tr>";
                    echo "<td>" . $cliente['cedula'] . "</td>";
                    echo "<td>" . $cliente['primernombre'] . "</td>";
                    echo "<td>" . $cliente['segundonombre'] . "</td>";
                    echo "<td>" . $cliente['primerapellido'] . "</td>";
                    echo "<td>" . $cliente['segundoapellido'] . "</td>";
                    echo "<td>" . $cliente['fechanacimiento'] . "</td>";
                    echo "<td>" . $cliente['email'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No se encontraron clientes.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function recargarDatos() {
            // Para recargar los datos, puedes recargar la página o hacer una petición AJAX
            window.location.reload(); // Recarga la página
        }
    </script>
</body>
</html>
