<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="css/stylesListas.css">
</head>
<body>
    <header class="header">
        <h1>Productos</h1>
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

    <button onclick="window.location.reload()">Recargar Datos</button>

    <table border="1">
        <thead>
            <tr>
                <th>ID Producto</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Acciones</th> <!-- Nueva columna para acciones -->
            </tr>
        </thead>
        <tbody id="datosProducto">
            <?php
            // Conexión a la base de datos
            $host = 'localhost';
            $usuario = 'root';
            $contrasena = '';
            $base_de_datos = 'drogueriasconfe';

            $conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            $sql = "SELECT p.idProducto, p.nombre, p.precio, c.nombre AS categoria 
                    FROM producto p
                    JOIN categoriaProducto c ON p.categoriaProducto = c.idCategoria
                    WHERE p.eliminado = 0  -- Filtrar productos no eliminados
                    ORDER BY p.idProducto ASC";

            $resultado = $conn->query($sql);

            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["idProducto"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["precio"] . "</td>";
                    echo "<td>" . $row["categoria"] . "</td>";
                    echo "<td>
                            <button onclick='editarProducto(" . $row["idProducto"] . ")'>Editar</button>
                            <button onclick='eliminarProducto(" . $row["idProducto"] . ")'>Eliminar</button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se encontraron productos</td></tr>";
            }

            $conn->close();
            ?>
        </tbody>
    </table>

    <script>
        function editarProducto(idProducto) {
            window.location.href = "editarProducto.php?idProducto=" + idProducto;
        }

        function eliminarProducto(idProducto) {
            if (confirm("¿Seguro que deseas eliminar este producto?")) {
                window.location.href = "eliminarProducto.php?idProducto=" + idProducto;
            }
        }
    </script>

</body>
</html>