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
                <li><a href="login.php">Regresar</a></li>
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
            </tr>
        </thead>
        <tbody id="datosProducto">
            <?php
            // Conexión a la base de datos
            $host = 'localhost';
            $usuario = 'root';
            $contrasena = '';
            $base_de_datos = 'drogueriasconfe';

            // Conexión a la base de datos
            $conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta SQL para obtener los productos
            $sql = "SELECT p.idProducto, p.nombre, p.precio, c.nombre AS categoria 
                    FROM producto p
                    JOIN categoriaProducto c ON p.categoriaProducto = c.idCategoria";

            $resultado = $conn->query($sql);

            // Mostrar los datos en la tabla
            if ($resultado->num_rows > 0) {
                while($row = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["idProducto"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["precio"] . "</td>";
                    echo "<td>" . $row["categoria"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron productos</td></tr>";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        </tbody>
    </table>

    <!-- Contenedor para la gráfica -->
    <h2>Productos Más Vendidos</h2>
    <canvas id="graficaProductosMasVendidos" width="400" height="200"></canvas>

    <!-- Script para Chart.js y para obtener datos de productos más vendidos -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Obtener los datos de los productos más vendidos desde el archivo PHP
        fetch('obtener_productos_mas_vendidos.php')
            .then(response => response.json())
            .then(data => {
                // Configurar los datos de la gráfica
                const ctx = document.getElementById('graficaProductosMasVendidos').getContext('2d');
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: data.productos,
                        datasets: [{
                            label: 'Productos más vendidos',
                            data: data.cantidades,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error al obtener los datos:', error));
    </script>
</body>
</html>