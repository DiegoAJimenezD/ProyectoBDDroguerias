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
$sql = "SELECT c.nombre AS categoria, p.nombre AS producto, COUNT(pv.idProducto) AS cantidadVendida
        FROM producto p
        JOIN categoriaProducto c ON p.categoriaProducto = c.idCategoria
        JOIN productoVenta pv ON p.idProducto = pv.idProducto
        GROUP BY c.idCategoria, p.idProducto
        ORDER BY c.idCategoria, cantidadVendida DESC";
$result = $conn->query($sql);

// Verificar si la consulta devuelve resultados
$productos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
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
    <title>Estadísticas de Productos Más Vendidos por Categoría</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Gráfica de Productos Más Vendidos por Categoría</h2>
    <button onclick="window.location.href='productos.php';">Volver a Productos</button>

    <!-- Gráfica aquí -->
    <canvas id="productosChart" width="400" height="200"></canvas>

    <script>
        // Datos obtenidos desde PHP
        var productos = <?php echo json_encode($productos); ?>;
        
        // Preparar los datos para la gráfica
        var categorias = [];
        var productosPorCategoria = {};

        // Organizar los productos por categoría
        productos.forEach(function(item) {
            if (!productosPorCategoria[item.categoria]) {
                productosPorCategoria[item.categoria] = [];
            }
            productosPorCategoria[item.categoria].push({
                producto: item.producto,
                cantidadVendida: item.cantidadVendida
            });
        });

        // Preparar etiquetas y datos para la gráfica
        var labels = [];
        var data = [];

        // Limitar a los 5 productos más vendidos por categoría para no sobrecargar la gráfica
        for (const categoria in productosPorCategoria) {
            var categoriaData = productosPorCategoria[categoria];
            categoriaData.sort(function(a, b) {
                return b.cantidadVendida - a.cantidadVendida; // Ordenar por cantidad de ventas descendente
            });

            labels.push(categoria);
            data.push(categoriaData.slice(0, 5)); // Tomar solo los 5 más vendidos
        }

        // Crear la gráfica
        var ctx = document.getElementById('productosChart').getContext('2d');
        var productosChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: data.map(function(categoriaData, index) {
                    return {
                        label: labels[index],
                        data: categoriaData.map(function(item) {
                            return item.cantidadVendida;
                        }),
                        backgroundColor: '#ff5733', // Color de la barra
                        borderColor: '#ff5733',
                        borderWidth: 1
                    };
                })
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>