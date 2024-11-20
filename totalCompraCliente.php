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

// Consulta SQL para obtener las compras por cliente
$sql = "SELECT c.nombre AS clienteNombre, f.fecha, SUM(df.cantidad * df.precio) AS totalCompra
        FROM factura f
        JOIN cliente c ON f.idCliente = c.idCliente
        JOIN detalle_factura df ON f.idFactura = df.idFactura
        WHERE f.estado = 'PAGADA'
        GROUP BY c.idCliente, f.idFactura
        ORDER BY c.nombre, f.fecha";
$result = $conn->query($sql);

// Verificar si la consulta devuelve resultados
$compras = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $compras[] = $row;
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
    <title>Reporte de Compras por Cliente</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>Reporte de Compras por Cliente</h2>
    <button onclick="window.location.href='inicio.php';">Volver a Inicio</button>

    <!-- Gráfica de Compras -->
    <canvas id="comprasChart" width="400" height="200"></canvas>
    <br><br>
    <button id="downloadBtn">Descargar como PDF</button>

    <script>
        // Datos obtenidos desde PHP
        var compras = <?php echo json_encode($compras); ?>;

        // Preparar los datos para la gráfica
        var labels = compras.map(function(item) {
            return item.clienteNombre + ' (' + item.fecha + ')';
        });

        var data = compras.map(function(item) {
            return item.totalCompra;
        });

        // Crear la gráfica
        var ctx = document.getElementById('comprasChart').getContext('2d');
        var comprasChart = new Chart(ctx, {
            type: 'bar', // Tipo de gráfica (puedes cambiarla a 'line' o 'pie' si lo prefieres)
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total de Compras',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)', // Color de las barras
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Clientes (Fecha de Compra)'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Total de Compras'
                        },
                        beginAtZero: true
                    }
                }
            }
        });

        // Función para generar el PDF
        document.getElementById('downloadBtn').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();
            pdf.setFontSize(16);
            pdf.text("Reporte de Compras por Cliente", 20, 20);
            pdf.addImage(ctx.canvas, 'PNG', 10, 30, 180, 160); // Gráfico
            pdf.save('reporte_compras_cliente.pdf');
        });
    </script>
</body>
</html>