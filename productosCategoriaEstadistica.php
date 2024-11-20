<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drogueriasconfe";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los productos más vendidos por categoría
$sql = "SELECT p.categoriaProducto, c.nombre AS categoriaNombre, COUNT(pf.idProducto) AS cantidadVendida
        FROM producto p
        JOIN productofactura pf ON p.idProducto = pf.idProducto
        JOIN factura f ON pf.idFactura = f.idFactura
        JOIN venta v ON f.idFactura = v.idFactura
        JOIN categoriaproducto c ON p.categoriaProducto = c.idCategoria
        WHERE f.estado = 'PAGADA'
        GROUP BY p.categoriaProducto
        ORDER BY cantidadVendida DESC";

$result = $conn->query($sql);

// Verificar si la consulta devuelve resultados
$categorias = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row;
    }
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos Más Vendidos por Categoría</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Productos Más Vendidos por Categoría</h2>
    <button onclick="window.location.href='producto.php';">Volver a Productos</button>

    <!-- Gráfica aquí -->
    <canvas id="myChart" width="400" height="200"></canvas>

    <script>
        // Datos obtenidos desde PHP
        var categorias = <?php echo json_encode($categorias); ?>;

        // Preparar los datos para la gráfica
        var labels = categorias.map(function(item) {
            return item.categoriaNombre;  // Etiquetas de categoría
        });

        var data = categorias.map(function(item) {
            return item.cantidadVendida;  // Cantidad de productos vendidos
        });

        // Crear la gráfica
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie', // Cambiar a 'pie' para una gráfica circular
            data: {
                labels: labels,  // Etiquetas de categorías
                datasets: [{
                    label: 'Productos Más Vendidos por Categoría',
                    data: data,  // Cantidad de productos vendidos por categoría
                    backgroundColor: ['#ff5733', '#33ff57', '#3357ff', '#ff33a8', '#f3c300'], // Colores para las categorías
                    borderColor: ['#ff5733', '#33ff57', '#3357ff', '#ff33a8', '#f3c300'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' unidades';
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>