<?php
// Incluir la conexión a la base de datos
include('conexion.php');

// Consulta SQL avanzada
$sql = "
SELECT
    c.cedula,
    CONCAT(c.primerNombre, ' ', c.segundoNombre, ' ', c.primerApellido, ' ', c.segundoApellido) AS nombre_completo,
    (SELECT COUNT(s.idSubsidio) FROM subsidio s WHERE s.cedula = c.cedula) AS numero_subsidios,
    (SELECT GROUP_CONCAT(DISTINCT s.tipoSubsidio SEPARATOR ', ') FROM subsidio s WHERE s.cedula = c.cedula) AS tipos_subsidios,
    (SELECT SUM(s.monto) FROM subsidio s WHERE s.cedula = c.cedula) AS total_subsidios,
    (SELECT COUNT(f.idFactura) FROM factura f WHERE f.clienteCedula = c.cedula) AS total_facturas,
    (SELECT SUM(f.precio) FROM factura f WHERE f.clienteCedula = c.cedula) AS valor_total_facturas,
    (SELECT COUNT(pf.idproducto) FROM productoFactura pf WHERE pf.idFactura IN (SELECT f.idFactura FROM factura f WHERE f.clienteCedula = c.cedula)) AS total_productos_comprados,
    (SELECT p.nombre FROM producto p WHERE p.idproducto = (SELECT pf.idproducto FROM productoFactura pf WHERE pf.idFactura IN (SELECT f.idFactura FROM factura f WHERE f.clienteCedula = c.cedula) GROUP BY pf.idproducto ORDER BY COUNT(pf.idproducto) DESC LIMIT 1)) AS producto_mas_comprado
FROM cliente c
WHERE (SELECT SUM(s.monto) FROM subsidio s WHERE s.cedula = c.cedula) > 0
ORDER BY total_subsidios DESC;
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Avanzado</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.22/jspdf.plugin.autotable.min.js"></script>
    <style>
        /* Estilos */
        body { font-family: Arial, sans-serif; margin: 20px; background-color: #f9f9f9; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; background-color: #fff; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; word-wrap: break-word; }
        th { background-color: #4CAF50; color: white; text-align: center; font-weight: bold; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        td:nth-child(3), td:nth-child(4), td:nth-child(5), td:nth-child(6), td:nth-child(7), td:nth-child(8), td:nth-child(9) { text-align: center; }
        .container { max-width: 1000px; margin: 0 auto; padding: 20px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); background: white; }
        h1 { text-align: center; color: #333; }
        .download-btn { display: block; margin: 20px auto; padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer; font-size: 16px; }
        button { background-color: #007bff; color: white; padding: 10px 20px; font-size: 14px; border: none; cursor: pointer; border-radius: 5px; transition: background-color 0.3s ease; margin-top: 20px; display: inline-block; }
        button:hover { background-color: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reporte de clientes con subsidios y sus compras</h1>
        <?php if ($result->num_rows > 0): ?>
            <table id="subsidiosTable">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre Completo</th>
                        <th>Número de Subsidios</th>
                        <th>Tipos de Subsidios</th>
                        <th>Total Subsidios</th>
                        <th>Número de Facturas</th>
                        <th>Valor Total Facturas</th>
                        <th>Total Productos Comprados</th>
                        <th>Producto Más Comprado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["cedula"]); ?></td>
                            <td><?php echo htmlspecialchars($row["nombre_completo"]); ?></td>
                            <td><?php echo htmlspecialchars($row["numero_subsidios"]); ?></td>
                            <td><?php echo htmlspecialchars($row["tipos_subsidios"]); ?></td>
                            <td><?php echo number_format($row["total_subsidios"], 2); ?></td>
                            <td><?php echo htmlspecialchars($row["total_facturas"]); ?></td>
                            <td><?php echo number_format($row["valor_total_facturas"], 2); ?></td>
                            <td><?php echo htmlspecialchars($row["total_productos_comprados"]); ?></td>
                            <td><?php echo htmlspecialchars($row["producto_mas_comprado"]); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <button id="downloadBtn" class="download-btn">Descargar Reporte en PDF</button>
        <?php else: ?>
            <p>No hay datos disponibles.</p>
        <?php endif; ?>
        <button onclick="window.location.href='reportes.php';">Volver al Menu</button>
    </div>

    <script>
        // Función para generar el PDF
        document.getElementById('downloadBtn').addEventListener('click', function() {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();

            // Título del PDF
            pdf.setFontSize(16);
            pdf.text("Reporte de clientes con subsidios y sus compras", 20, 20);

            // Configurar la tabla con AutoTable
            const table = document.getElementById('subsidiosTable');
            const rows = table.getElementsByTagName('tr');
            const data = [];

            // Recopilamos las filas de la tabla
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                const rowData = [];
                for (let j = 0; j < cells.length; j++) {
                    rowData.push(cells[j].innerText);
                }
                data.push(rowData);
            }

            // Definir los encabezados de la tabla
            const headers = [
                "Cédula", 
                "Nombre Completo", 
                "Número de Subsidios", 
                "Tipos de Subsidios", 
                "Total Subsidios", 
                "Número de Facturas", 
                "Valor Total Facturas", 
                "Total Productos Comprados", 
                "Producto Más Comprado"
            ];

            // Estilos para la tabla
            pdf.autoTable({
                head: [headers],
                body: data,
                startY: 30,
                theme: 'grid',
                headStyles: {
                    fillColor: [76, 175, 80], // Verde
                    textColor: 255, // Blanco
                    fontStyle: 'bold',
                },
                bodyStyles: {
                    fontSize: 10,
                },
                margin: { top: 40 },
            });

            // Guardar el PDF
            pdf.save('reporte_clientes_subsidios.pdf');
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>