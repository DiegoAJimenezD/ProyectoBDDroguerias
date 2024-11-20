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

// Consulta SQL para obtener el número de ventas por empleado
$sql = "SELECT e.nombre, COUNT(ev.idVenta) AS cantidadVentas
        FROM empleado e
        JOIN empleadoventa ev ON e.idEmpleado = ev.idEmpleado
        GROUP BY e.idEmpleado
        ORDER BY cantidadVentas DESC";
$result = $conn->query($sql);

// Verificar si la consulta devuelve resultados
$empleados = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $empleados[] = $row;
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
    <title>Estadísticas de Ventas por Empleado</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Gráfica de Ventas por Empleado</h2>
    <button onclick="window.location.href='empleado.php';">Volver a Empleados</button>

    <!-- Gráfica aquí -->
    <canvas id="ventasChart" width="400" height="200"></canvas>

    <script>
        // Datos obtenidos desde PHP
        var empleados = <?php echo json_encode($empleados); ?>;
        
        // Preparar los datos para la gráfica
        var labels = empleados.map(function(item) {
            return item.nombre; // Nombres de los empleados
        });

        var data = empleados.map(function(item) {
            return item.cantidadVentas; // Número de ventas realizadas por cada empleado
        });

        // Crear la gráfica
        var ctx = document.getElementById('ventasChart').getContext('2d');
        var ventasChart = new Chart(ctx, {
            type: 'bar', // Puedes cambiar a 'pie' si prefieres una gráfica circular
            data: {
                labels: labels,
                datasets: [{
                    label: 'Número de Ventas Realizadas',
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