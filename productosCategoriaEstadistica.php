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

// Consulta SQL para obtener los productos más vendidos por categoría
$sql = "SELECT p.categoriaProducto, c.nombre AS categoriaNombre, p.nombre AS productoNombre, COUNT(pf.idProducto) AS cantidadVendida
        FROM producto p
        JOIN productofactura pf ON p.idProducto = pf.idProducto
        JOIN factura f ON pf.idFactura = f.idFactura
        JOIN venta v ON f.idFactura = v.idFactura
        JOIN categoriaproducto c ON p.categoriaProducto = c.idCategoria
        WHERE f.estado = 'PAGADA'
        GROUP BY p.categoriaProducto, p.idProducto
        ORDER BY categoriaProducto, cantidadVendida DESC";

$result = $conn->query($sql);

// Verificar si la consulta devuelve resultados
$categorias = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Agrupamos los productos por categoría
        $categorias[$row['categoriaNombre']][] = [
            'producto' => $row['productoNombre'],
            'cantidad' => $row['cantidadVendida']
        ];
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
    <title>Productos Más Vendidos por Categoría</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
</head>
<body>
    <h2>Productos Más Vendidos por Categoría</h2>
    <button onclick="window.location.href='producto.php';">Volver a Productos</button>
    <button id="downloadBtn">Descargar como PDF</button>

    <!-- Mostrar productos más vendidos por categoría -->
    <div id="productosMasVendidos">
        <?php foreach ($categorias as $categoria => $productos): ?>
            <h3><?php echo $categoria; ?></h3>
            <ul>
                <?php foreach ($productos as $producto): ?>
                    <li><?php echo $producto['producto']; ?> - <?php echo $producto['cantidad']; ?> unidades</li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    </div>

    <!-- Mostrar productos más vendidos por categoría -->
    <div id="productosMasVendidos">
        <?php foreach ($categorias as $categoria => $productos): ?>
            <h3><?php echo $categoria; ?></h3>
            <ul>
                <?php foreach ($productos as $producto): ?>
                    <li><?php echo $producto['producto']; ?> - <?php echo $producto['cantidad']; ?> unidades</li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    </div>

    <!-- Mostrar productos más vendidos por categoría -->
    <div id="productosMasVendidos">
        <?php foreach ($categorias as $categoria => $productos): ?>
            <h3><?php echo $categoria; ?></h3>
            <ul>
                <?php foreach ($productos as $producto): ?>
                    <li><?php echo $producto['producto']; ?> - <?php echo $producto['cantidad']; ?> unidades</li>
                <?php endforeach; ?>
            </ul>
        <?php endforeach; ?>
    </div>

    <!-- Gráfica aquí -->
    <canvas id="myChart" width="400" height="200"></canvas>

    <script>
        // Datos obtenidos desde PHP
        var categorias = <?php echo json_encode($categorias); ?>;

        // Preparar los datos para la gráfica
        var labels = Object.keys(categorias); // Etiquetas de categorías
        var datasets = [];

        // Crear un conjunto de datos por cada producto
        Object.keys(categorias).forEach(function(categoria, index) {
            categorias[categoria].forEach(function(producto) {
                let dataset = datasets.find(ds => ds.label === producto.producto);
                if (!dataset) {
                    dataset = {
                        label: producto.producto,
                        data: Array(labels.length).fill(0),
                        backgroundColor: `hsl(${Math.random() * 360}, 70%, 60%)`
                    };
                    datasets.push(dataset);
                }
                dataset.data[index] = producto.cantidad;
            });
        });

        // Crear la gráfica de barras apiladas
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,  // Categorías
                datasets: datasets  // Productos dentro de las categorías


        var labels = Object.keys(categorias); // Etiquetas de categoría
        var data = labels.map(function(categoria) {
            // Total de productos vendidos por cada categoría
            return categorias[categoria].reduce(function(total, producto) {
                return total + producto.cantidad;
            }, 0);
        });

        // Crear la gráfica
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar', // Cambiar a 'pie' para una gráfica circular
            data: {
                labels: labels,  // Etiquetas de categorías
                datasets: [{
                    label: 'Productos Más Vendidos por Categoría',
                    data: data,  // Total de productos vendidos por categoría
                    backgroundColor: ['#ff5733', '#33ff57', '#3357ff', '#ff33a8', '#f3c300'], // Colores para las categorías
                    borderColor: ['#ff5733', '#33ff57', '#3357ff', '#ff33a8', '#f3c300'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw + ' unidades';
                            }
                        }
                    },
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    x: {
                        stacked: true // Apilar barras en el eje X
                    },
                    y: {
                        stacked: true // Apilar barras en el eje Y
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
            
            // Convertir la imagen de la gráfica a base64
            var imgData = ctx.canvas.toDataURL("image/png");
            pdf.addImage(ctx.canvas, 'PNG', 10, 30, 180, 160);
            
            // Agregar los productos más vendidos al PDF
            let yPosition = 200;
            Object.keys(categorias).forEach(function(categoria) {
                pdf.text(categoria, 20, yPosition);
                yPosition += 10;
                categorias[categoria].forEach(function(producto) {
                    pdf.text(`${producto.producto} - ${producto.cantidad} unidades`, 20, yPosition);
                    yPosition += 10;
                });
            });

            // Guardar el PDF
            pdf.save('estadisticas_facturas.pdf');
        });
    </script>
</body>
</html>