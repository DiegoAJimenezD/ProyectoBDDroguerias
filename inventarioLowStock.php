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

// Consulta SQL para obtener los productos con poco stock
$sql =  "SELECT 
    i.idProducto, 
    p.nombre, 
    p.precio, 
    SUM(i.cantidadStock) AS totalStock
FROM 
    inventario i
JOIN 
    producto p ON i.idProducto = p.idProducto
GROUP BY 
    i.idProducto, p.nombre, p.precio
HAVING 
    totalStock < 10;";

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
    <title>Productos por Agotarse</title>
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Button styles */
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #3f87a6;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Button to PDF */
        #downloadBtn {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        #downloadBtn:hover {
            background-color: #0056b3;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
    <h2>Productos con Bajo Stock</h2>
    <button onclick="window.location.href='reportes.php';">Volver a Inventario</button>

    <!-- Tabla de productos con bajo stock -->
    <table id="productosTable">
        <thead>
            <tr>
                <th>ID Producto</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock Total</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($productos)) { ?>
                <?php foreach ($productos as $producto) { ?>
                    <tr>
                        <td><?php echo $producto['idProducto']; ?></td>
                        <td><?php echo $producto['nombre']; ?></td>
                        <td><?php echo $producto['precio']; ?></td>
                        <td><?php echo $producto['totalStock']; ?></td>
                    </tr>
                <?php } ?>
            <?php } else { ?>
                <tr>
                    <td colspan="4">No hay productos con bajo stock.</td>
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
            pdf.text("Estadísticas de Stock", 20, 20);

            // Obtener la tabla de productos
            const table = document.getElementById('productosTable');
            const rows = table.getElementsByTagName('tr');
            let yOffset = 30;  // Empezar a dibujar después del título

            // Dibujar los encabezados de la tabla
            pdf.setFontSize(12);
            let header = rows[0].getElementsByTagName('th');
            pdf.text(header[0].innerText, 10, yOffset);
            pdf.text(header[1].innerText, 50, yOffset);
            pdf.text(header[2].innerText, 120, yOffset);
            pdf.text(header[3].innerText, 160, yOffset);
            yOffset += 10;

            // Dibujar los datos de la tabla
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                if (cells.length > 0) {
                    pdf.text(cells[0].innerText, 10, yOffset);
                    pdf.text(cells[1].innerText, 50, yOffset);
                    pdf.text(cells[2].innerText, 120, yOffset);
                    pdf.text(cells[3].innerText, 160, yOffset);
                    yOffset += 10;
                }
            }

            // Guardar el PDF
            pdf.save('estadisticas_stock.pdf');
        });
    </script>
</body>
</html>