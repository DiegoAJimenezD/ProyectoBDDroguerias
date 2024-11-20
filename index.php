<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Droquerías Comfenalco</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <header class="header">
        <h1>Droquerías Comfenalco</h1>
        <p>Todo lo que necesitas para tu salud y bienestar</p>
    </header>

    <?php
    include 'componentes\navbar.php';
    ?>

    <section class="banner">
        <p>¡Promociones y descuentos en productos seleccionados!</p>
    </section>

    <div class="container">
        <h2 class="text-center">Categorías Principales</h2>
        <div class="category-container">
            <a href="cosmeticos.php" class="card category">
                <img src="images/cosmeticos.png" alt="Cosméticos">
                <p>Cosméticos</p>
            </a>
            <a href="medicamentos.php" class="card category">
                <img src="images/vitaminas.png" alt="Vitaminas y Suplementos">
                <p>Medicamentos</p>
            </a>
            <a href="cuidadoP.php" class="card category">
                <img src="images/cuidadoP.png" alt="Cuidado Personal">
                <p>Cuidado Personal</p>
            </a>
        </div>

        <h2 class="text-center">Productos Destacados</h2>
        <div class="product-container">
            <?php
            // Conectar a la base de datos
            include 'conexion.php';  // Incluir la conexión a la base de datos

            // Consulta para obtener los productos con mayor stock
            $sql = "SELECT p.idProducto, p.nombre, p.precio, p.imagen, i.cantidadStock 
                    FROM producto p
                    JOIN inventario i ON p.idProducto = i.idProducto
                    ORDER BY i.cantidadStock DESC
                    LIMIT 3";  // Limitar a los 3 productos con mayor stock

            $result = $conn->query($sql);

            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                // Mostrar los productos
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="card product">';
                    echo '<img src="' . $row['imagen'] . '" alt="Producto ' . $row['nombre'] . '">';
                    echo '<h5>' . $row['nombre'] . '</h5>';
                    echo '<p>$' . number_format($row['precio'], 0, ',', '.') . '</p>';
                    echo '<p><strong>Stock disponible: ' . $row['cantidadStock'] . '</strong></p>';
                    
                    // Agregar el botón con la función para redirigir a la página de compra
                    echo '<button onclick="redirigirCompra(' . $row['idProducto'] . ')">Comprar</button>';
                    echo '</div>';
                }
            } else {
                echo "<p>No hay productos destacados disponibles.</p>";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        </div>
    </div>

    <?php
    include 'componentes\footer.php';
    ?>

<script>
    // Función para redirigir a la página de compra
    function redirigirCompra(idProducto) {
        // Redirige a la página de compra pasando el id del producto en la URL
        window.location.href = `compra.php?idProducto=${idProducto}`;
    }
</script>

</body>

</html>
