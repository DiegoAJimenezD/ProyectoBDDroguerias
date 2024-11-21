<?php
// Incluir la conexión a la base de datos
include('conexion.php');

// Consulta SQL
$sql = "
SELECT 
    cliente.primernombre AS NombreCliente,
    cliente.primerApellido AS ApellidoCliente,
    SUM(factura.precio) AS TotalGastado
FROM cliente
INNER JOIN factura ON cliente.cedula = factura.clienteCedula
WHERE factura.estado = 'PAGADA'
GROUP BY cliente.cedula
HAVING SUM(factura.precio) > (
    SELECT AVG(TotalGastado) 
    FROM (
        SELECT SUM(factura.precio) AS TotalGastado
        FROM factura
        WHERE factura.estado = 'PAGADA'
        GROUP BY factura.clienteCedula
    ) AS PromedioGastado
)
ORDER BY TotalGastado DESC;
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Clientes con Gastos Altos</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f7fa;
        }

        h1 {
            color: #333;
            text-align: center;
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
            margin-top: 20px;
            display: inline-block;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Estilo del botón para PDF */
        #downloadBtn {
            background-color: #28a745;
        }

        #downloadBtn:hover {
            background-color: #218838;
        }

        /* Tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
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

        /* Estilo para la tabla y otros elementos */
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reporte de Clientes con Gastos Altos</h1>

        <!-- Botón para regresar -->
        <button onclick="window.location.href='reportes.php';">Volver a Productos</button>

        <!-- Botón para generar el PDF -->
        <button id="downloadBtn">Descargar como PDF</button>

        <!-- Tabla de datos -->
        <?php if ($result->num_rows > 0): ?>
            <table id="clientesTable">
                <thead>
                    <tr>
                        <th>Nombre del Cliente</th>
                        <th>Apellido del Cliente</th>
                        <th>Total Gastado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["NombreCliente"]); ?></td>
                            <td><?php echo htmlspecialchars($row["ApellidoCliente"]); ?></td>
                            <td>$<?php echo number_format($row["TotalGastado"], 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay datos disponibles.</p>
        <?php endif; ?>
    </div>

    <script>
        // Función para generar el PDF
        document.getElementById('downloadBtn').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();

            // Título del PDF
            pdf.setFontSize(16);
            pdf.text("Reporte de Clientes con Gastos Altos", 20, 20);

            // Obtener la tabla de datos
            const table = document.getElementById('clientesTable');
            const rows = table.getElementsByTagName('tr');
            let yOffset = 30;  // Posición inicial en el PDF

            // Dibujar los encabezados de la tabla
            pdf.setFontSize(12);
            let header = rows[0].getElementsByTagName('th');
            pdf.text(header[0].innerText, 20, yOffset);
            pdf.text(header[1].innerText, 80, yOffset);
            pdf.text(header[2].innerText, 140, yOffset);
            yOffset += 10;

            // Dibujar los datos de la tabla
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0) {
                    pdf.text(cells[0].innerText, 20, yOffset);
                    pdf.text(cells[1].innerText, 80, yOffset);
                    pdf.text(cells[2].innerText, 140, yOffset);
                    yOffset += 10;
                }
            }

            // Guardar el PDF
            pdf.save('clientes_gastos_altos.pdf');
        });
    </script>

</body>
</html>

<?php
$conn->close();
?>
