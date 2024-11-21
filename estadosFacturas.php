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

// Consulta SQL para obtener el número de facturas por estado
$sql = "SELECT estado, COUNT(*) AS cantidad
        FROM factura
        WHERE estado IN ('PAGADA', 'PENDIENTE', 'CANCELADA') 
        GROUP BY estado";
$result = $conn->query($sql);

// Verificar si la consulta devuelve resultados
$facturas = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $facturas[] = $row;
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
    <title>Estadísticas de Facturas por Estado</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
        }

        h2 {
            color: #333;
            text-align: center;
            padding-top: 20px;
        }

        button {
            background-color: #007BFF;
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

        #downloadBtn {
            background-color: #28a745;
        }

        #downloadBtn:hover {
            background-color: #218838;
        }

        /* Canvas (Gráfica) */
        canvas {
            display: block;
            margin: 20px auto;
        }

        /* Responsive table */
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
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Loader */
        #loader {
            display: none;
            margin: 20px auto;
            text-align: center;
            font-size: 18px;
            color: #007BFF;
        }

    </style>
</head>
<body>

    <h2>Gráfica de Facturas por Estado</h2>

    <button onclick="window.location.href='reportes.php';">Volver</button>
    <button id="downloadBtn">Descargar como PDF</button>

    <div id="loader">Cargando...</div>

    <!-- Gráfica aquí -->
    <canvas id="facturasChart" width="400" height="200"></canvas>

    <script>
        // Datos obtenidos desde PHP
        var facturas = <?php echo json_encode($facturas); ?>;
        
        // Preparar los datos para la gráfica
        var labels = facturas.map(function(item) {
            return item.estado; // Estado de la factura (PAGADA, PENDIENTE, CANCELADA)
        });

        var data = facturas.map(function(item) {
            return item.cantidad; // Número de facturas en cada estado
        });

        // Crear la gráfica
        var ctx = document.getElementById('facturasChart').getContext('2d');
        var facturasChart = new Chart(ctx, {
            type: 'bar', // Cambiado a gráfica de barras verticales
            data: {
                labels: labels,
                datasets: [{
                    label: 'Número de Facturas',
                    data: data,
                    backgroundColor: ['#4CAF50', '#FFC107', '#F44336'], // Colores diferenciados por estado
                    borderColor: ['#388E3C', '#FFB300', '#D32F2F'], // Bordes para mejorar contraste
                    borderWidth: 1,
                    hoverBackgroundColor: ['#66BB6A', '#FFCA28', '#E57373'], // Colores al pasar el cursor
                    hoverBorderColor: ['#388E3C', '#FFB300', '#D32F2F'],
                    hoverBorderWidth: 2
                }]
            },
            options: {
                indexAxis: 'y', // Barras horizontales
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw + ' facturas';
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true, // Asegurarse de que el eje X comience en 0
                        ticks: {
                            font: {
                                size: 12
                            }
                        },
                        title: {
                            display: true,
                            text: 'Cantidad de Facturas',
                            font: {
                                size: 14
                            }
                        }
                    },
                    y: {
                        ticks: {
                            font: {
                                size: 12
                            }
                        },
                        title: {
                            display: true,
                            text: 'Estado de la Factura',
                            font: {
                                size: 14
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
            
            // Agregar el título y la gráfica al PDF
            pdf.setFontSize(16);
            pdf.text("Estadísticas de Facturas por Estado", 20, 20);
            pdf.addImage(ctx.canvas, 'PNG', 10, 30, 180, 160);

            // Guardar el PDF
            pdf.save('estadisticas_facturas.pdf');
        });
    </script>
</body>
</html>