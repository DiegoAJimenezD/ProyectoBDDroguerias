

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

// Consulta SQL para obtener los datos de inventario
$sql = "SELECT idProducto, SUM(cantidadStock) as totalStock FROM inventario GROUP BY idProducto";
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
    <title>Estadísticas de Stock</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Gráfica de Stock por Producto</h2>
    <button onclick="window.location.href='inventario.php';">Volver a Inventario</button>

    <!-- Gráfica aquí -->
    <canvas id="stockChart" width="400" height="200"></canvas>

    <script>
        // Datos obtenidos desde PHP
        var productos = <?php echo json_encode($productos); ?>;
        
        // Preparar los datos para la gráfica
        var labels = productos.map(function(item) {
            return 'Producto ' + item.idProducto;
        });

        var data = productos.map(function(item) {
            return item.totalStock;
        });

        // Crear la gráfica
        var ctx = document.getElementById('stockChart').getContext('2d');
        var stockChart = new Chart(ctx, {
            type: 'bar', // Cambiar a 'pie' para una gráfica circular
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cantidad de Stock',
                    data: data,
                    backgroundColor: ['#ff5733', '#33ff57', '#3357ff', '#ff33a8', '#f3c300'], // Puedes cambiar los colores
                    borderColor: ['#ff5733', '#33ff57', '#3357ff', '#ff33a8', '#f3c300'],
                    borderWidth: 1
                }]
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