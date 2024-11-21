<?php

// Incluir la conexión a la base de datos
include('conexion.php');

// Consulta SQL
$sql = "
SELECT 
    cliente.primernombre AS NombreCliente,
    cliente.primerApellido AS ApellidoCliente,
    COUNT(productofactura.idProducto) AS TotalProductosComprados,
    SUM(factura.precio) AS TotalGastado
FROM cliente
INNER JOIN factura ON cliente.cedula = factura.clienteCedula
INNER JOIN productofactura ON factura.idFactura = productofactura.idFactura
WHERE factura.estado = 'PAGADA'
GROUP BY cliente.cedula
ORDER BY TotalGastado DESC;
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Clientes y Compras</title>
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
        <h1>Reporte de Clientes y Productos Comprados</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nombre del Cliente</th>
                        <th>Apellido del Cliente</th>
                        <th>Total de Productos Comprados</th>
                        <th>Total Gastado</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["NombreCliente"]) . " " . htmlspecialchars($row["ApellidoCliente"]); ?></td>
                            <td><?php echo htmlspecialchars($row["ApellidoCliente"]); ?></td>
                            <td><?php echo $row["TotalProductosComprados"]; ?></td>
                            <td>$<?php echo number_format($row["TotalGastado"], 2); ?></td>
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
