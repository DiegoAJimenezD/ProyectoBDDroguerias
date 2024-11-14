<?php
// Conectar a la base de datos
include('conexion.php');

// Consulta SQL para obtener las ventas
$sql = "SELECT v.idVenta, v.descuento, m.nombre AS metodoPago, v.idFactura, v.cedula
        FROM venta v
        JOIN metodoPago m ON v.metodoPago = m.idMetodoPago ORDER BY v.idVenta ASC";
$resultado = $conn->query($sql);

// Verificar si hay resultados
$ventas = [];
if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $ventas[] = $row; // Almacenamos los datos en un arreglo
    }
} else {
    $ventas = [];
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link rel="stylesheet" href="css/stylesListas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <header>
        <h1>Ventas</h1>
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
                <li><a href="login.php">Regresar</a></li>
            </ul>
        </nav>
    </header>

    <button onclick="recargarDatos()">Recargar Datos</button>

    <table border="1">
        <thead>
            <tr>
                <th>ID Venta</th>
                <th>Descuento</th>
                <th>Método de Pago</th>
                <th>ID Factura</th>
                <th>Cédula Cliente</th>
            </tr>
        </thead>
        <tbody id="datosVenta">
            <?php
            // Mostrar los datos de ventas
            if (count($ventas) > 0) {
                foreach ($ventas as $venta) {
                    echo "<tr>";
                    echo "<td>" . $venta['idVenta'] . "</td>";
                    echo "<td>" . $venta['descuento'] . "</td>";
                    echo "<td>" . $venta['metodoPago'] . "</td>";
                    echo "<td>" . $venta['idFactura'] . "</td>";
                    echo "<td>" . $venta['cedula'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se encontraron ventas.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function recargarDatos() {
            window.location.reload(); // Recarga la página
        }
    </script>
</body>
</html>