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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Estilos generales */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-top: 20px;
        }

        /* Botones */
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin: 10px;
            display: inline-block;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Canvas de la gráfica */
        canvas {
            display: block;
            margin: 20px auto;
        }

        /* Estilo del botón de PDF */
        #downloadBtn {
            background-color: #28a745;
        }

        #downloadBtn:hover {
            background-color: #218838;
        }

        /* Estilo para la tabla y otros elementos */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
            font-size: 14px;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>

    <h2>Gráfica de Stock por Producto</h2>

    <!-- Botones -->
    <button onclick="window.location.href='reportes.php';">Volver a Inventario</button>
    <button id="downloadBtn">Descargar como PDF</button>

    <!-- Gráfica -->
    <canvas id="stockChart" width="700" height="500"></canvas>

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
            type: 'bar', // Cambiar a 'horizontalBar' en Chart.js v2 o configurar 'indexAxis' en v3
            data: {
                labels: labels,
                datasets: [{
                    label: 'Cantidad de Stock',
                    data: data,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)', // Color de las barras
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y', // Barras horizontales
                responsive: true,
                scales: {
                    x: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Cantidad de Stock'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Productos'
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw + ' unidades';
                            }
                        }
                    }
                }
            }
        });

        // Función para generar el PDF
        document.getElementById('downloadBtn').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();
            pdf.setFontSize(16);
            pdf.text("Estadísticas de Stock", 20, 20);
            pdf.addImage(ctx.canvas, 'PNG', 10, 30, 180, 160);
            pdf.save('estadisticas_stock.pdf');
        });
    </script>

</body>
</html>