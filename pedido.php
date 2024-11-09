<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <link rel="stylesheet" href="css/stylesListas.css">
</head>
<body>
    <header class="header">
        <h1>Pedidos</h1>
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
                <th>ID Pedido</th>
                <th>Fecha Pedido</th>
            </tr>
        </thead>
        <tbody id="datosPedido">
            <?php
            // Conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "drogueriasconfe";

            // Crear conexión
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta SQL para obtener los pedidos
            $sql = "SELECT idPedido, fechaPedido FROM pedido";
            $result = $conn->query($sql);

            // Mostrar los datos en la tabla
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['idPedido'] . "</td>
                            <td>" . $row['fechaPedido'] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No se encontraron pedidos</td></tr>";
            }

            // Cerrar conexión
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>
