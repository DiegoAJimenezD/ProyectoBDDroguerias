<?php
// Incluir la conexión a la base de datos
include('conexion.php');

// Consulta SQL
$sql = "
SELECT 
    producto.nombre AS NombreProducto,
    categoriaproducto.nombre AS Categoria,
    SUM(productofactura.idProducto) AS TotalVentas
FROM producto
INNER JOIN categoriaproducto ON producto.categoriaProducto = categoriaproducto.idCategoria
INNER JOIN productofactura ON producto.idProducto = productofactura.idProducto
GROUP BY producto.idProducto, categoriaproducto.idCategoria
HAVING SUM(productofactura.idProducto) > (
    SELECT AVG(TotalVentasCategoria)
    FROM (
        SELECT 
            categoriaproducto.idCategoria,
            SUM(productofactura.idProducto) AS TotalVentasCategoria
        FROM producto
        INNER JOIN categoriaproducto ON producto.categoriaProducto = categoriaproducto.idCategoria
        INNER JOIN productofactura ON producto.idProducto = productofactura.idProducto
        GROUP BY categoriaproducto.idCategoria
    ) AS VentasPorCategoria
)
ORDER BY TotalVentas DESC
LIMIT 25;
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Ventas por Producto</title>
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
        <h1>Reporte de Ventas por Producto</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nombre del Producto</th>
                        <th>Categoría</th>
                        <th>Total Ventas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row["NombreProducto"]); ?></td>
                            <td><?php echo htmlspecialchars($row["Categoria"]); ?></td>
                            <td><?php echo htmlspecialchars($row["TotalVentas"]); ?></td>
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
