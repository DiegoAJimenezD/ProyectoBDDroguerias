<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link rel="stylesheet" href="css/stylesListas.css">
</head>
<body>
    <header class="header">
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
            </ul>
        </nav>
    </header>
    <button onclick="window.location.reload()">Recargar Datos</button>

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
            // Conexión a la base de datos
            $host = 'localhost'; // Cambia esto según tu configuración
            $usuario = 'root'; // Cambia esto según tu configuración
            $contrasena = ''; // Cambia esto según tu configuración
            $base_de_datos = 'drogueriasconfe'; // Nombre de tu base de datos

            // Conexión a la base de datos
            $conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta SQL para obtener las ventas
            $sql = "SELECT v.idVenta, v.descuento, m.nombre AS metodoPago, v.idFactura, v.cedula
                    FROM venta v
                    JOIN metodoPago m ON v.metodoPago = m.idMetodoPago ORDER BY v.idVenta ASC";

            $resultado = $conn->query($sql);

            // Mostrar los datos en la tabla
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["idVenta"] . "</td>";
                    echo "<td>" . $row["descuento"] . "</td>";
                    echo "<td>" . $row["metodoPago"] . "</td>";
                    echo "<td>" . $row["idFactura"] . "</td>";
                    echo "<td>" . $row["cedula"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se encontraron ventas</td></tr>";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
