<?php

// Incluir la conexión a la base de datos
include('conexion.php');

// Consulta SQL
$sql = "
SELECT 
    proveedor.nombre AS NombreProveedor,
    producto.nombre AS NombreProducto,
    SUM(inventario.cantidadStock) AS CantidadTotalStock,
    SUM(productoproveedor.costo * inventario.cantidadStock) AS MontoTotalSuministrado
FROM productoproveedor
INNER JOIN proveedor ON productoproveedor.idProveedor = proveedor.idProveedor
INNER JOIN producto ON productoproveedor.idProducto = producto.idProducto
INNER JOIN inventario ON productoproveedor.idProducto = inventario.idProducto
GROUP BY proveedor.idProveedor, producto.idProducto
ORDER BY MontoTotalSuministrado DESC
LIMIT 25;
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Proveedores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            background: white;
        }
        h1 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Reporte de Proveedores y Productos</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nombre del Proveedor</th>
                        <th>Nombre del Producto</th>
                        <th>Cantidad de Productos Suministrados</th>
                        <th>Monto Total Suministrado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["NombreProveedor"]); ?></td>
                            <td><?php echo htmlspecialchars($row["NombreProducto"]); ?></td>
                            <td><?php echo $row["CantidadTotalStock"]; ?></td> <!-- Corregido aquí -->
                            <td>$<?php echo number_format($row["MontoTotalSuministrado"], 2); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay datos disponibles.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
