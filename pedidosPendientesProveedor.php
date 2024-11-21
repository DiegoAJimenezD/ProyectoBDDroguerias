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

// Consulta SQL para obtener los pedidos pendientes por proveedor
$sql = 
    "SELECT 
        prov.nombre AS proveedor,
        COUNT(ppp.idPedido) AS pedidos_pendientes
    FROM 
        pedidoproductoproveedor ppp
    JOIN 
        proveedor prov ON ppp.idProveedor = prov.idProveedor
    WHERE 
        ppp.estado = 'PENDIENTE'
    GROUP BY 
        prov.nombre";


$result = $conn->query($sql);

// Verificar si la consulta devuelve resultados
$pedidos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pedidos[] = $row;
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
    <title>Pedidos Pendientes por Proveedor</title>
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
    <h2>Pedidos Pendientes por Proveedor</h2>
    <button onclick="window.location.href='reportes.php';">Volver al Menú</button>

    <!-- Tabla de pedidos pendientes -->
    <table id="pedidosTable">
        <thead>
            <tr>
                <th>Proveedor</th>
                <th>Pedidos Pendientes</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($pedidos)) { ?>
                <?php foreach ($pedidos as $pedido) { ?>
                    <tr>
                        <td><?php echo $pedido['proveedor']; ?></td>
                        <td><?php echo $pedido['pedidos_pendientes']; ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="2">No hay pedidos pendientes.</td>
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
            pdf.text("Pedidos Pendientes por Proveedor", 20, 20);

            // Obtener la tabla
            const table = document.getElementById('pedidosTable');
            const rows = table.getElementsByTagName('tr');
            let yOffset = 30;  // Posición inicial en el PDF

            // Dibujar encabezados de la tabla
            pdf.setFontSize(12);
            let header = rows[0].getElementsByTagName('th');
            pdf.text(header[0].innerText, 20, yOffset);
            pdf.text(header[1].innerText, 120, yOffset);
            yOffset += 10;

            // Dibujar los datos de la tabla
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0) {
                    pdf.text(cells[0].innerText, 20, yOffset);
                    pdf.text(cells[1].innerText, 120, yOffset);
                    yOffset += 10;
                }
            }

            // Guardar el PDF
            pdf.save('pedidos_pendientes.pdf');
        });
    </script>
</body>
</html>