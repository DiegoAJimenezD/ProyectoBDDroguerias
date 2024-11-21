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

// Consulta SQL para obtener las facturas pagadas con el monto total
$sql = "
    SELECT 
        f.idFactura,
        f.fechaCompra,
        f.estado,
        SUM(fv.cantidad * p.precio) + IFNULL(f.impuesto, 0) AS montoTotal
    FROM 
        factura f
    JOIN 
        facturaventa fv ON f.idFactura = fv.idFactura
    JOIN 
        producto p ON fv.idProducto = p.idProducto
    WHERE 
        f.fechaCompra BETWEEN '2024-01-01' AND '2024-12-31'  -- Ajusta la fecha según sea necesario
        AND f.estado = 'PAGADA'  -- O puedes cambiar a PENDIENTE, CANCELADA, etc.
    GROUP BY 
        f.idFactura
    ORDER BY 
        f.fechaCompra DESC
";

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
    <title>Resumen de Facturas Pagadas</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
    <h2>Resumen de Facturas Pagadas</h2>
    <button onclick="window.location.href='reportes.php';">Volver al Menú</button>

    <!-- Tabla de facturas pagadas -->
    <table id="facturasTable">
        <thead>
            <tr>
                <th>ID Factura</th>
                <th>Fecha de Compra</th>
                <th>Estado</th>
                <th>Monto Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($facturas)) { ?>
                <?php foreach ($facturas as $factura) { ?>
                    <tr>
                        <td><?php echo $factura['idFactura']; ?></td>
                        <td><?php echo $factura['fechaCompra']; ?></td>
                        <td><?php echo $factura['estado']; ?></td>
                        <td><?php echo number_format($factura['montoTotal'], 2, ',', '.'); ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="4">No hay facturas pagadas para este período.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Botón para generar PDF -->
    <button id="downloadBtn">Descargar como PDF</button>

    <script>
        // Función para generar el PDF
        document.getElementById('downloadBtn').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();

            // Título del PDF
            pdf.setFontSize(16);
            pdf.text("Resumen de Facturas Pagadas", 20, 20);

            // Obtener la tabla de facturas
            const table = document.getElementById('facturasTable');
            const rows = table.getElementsByTagName('tr');
            let yOffset = 30;  // Posición inicial en el PDF

            // Dibujar encabezados de la tabla
            pdf.setFontSize(12);
            let header = rows[0].getElementsByTagName('th');
            pdf.text(header[0].innerText, 20, yOffset);
            pdf.text(header[1].innerText, 50, yOffset);
            pdf.text(header[2].innerText, 100, yOffset);
            pdf.text(header[3].innerText, 150, yOffset);
            yOffset += 10;

            // Dibujar los datos de la tabla
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0) {
                    pdf.text(cells[0].innerText, 20, yOffset);
                    pdf.text(cells[1].innerText, 50, yOffset);
                    pdf.text(cells[2].innerText, 100, yOffset);
                    pdf.text(cells[3].innerText, 150, yOffset);
                    yOffset += 10;
                }
            }

            // Guardar el PDF
            pdf.save('facturas_pagadas.pdf');
        });
    </script>
</body>
</html>