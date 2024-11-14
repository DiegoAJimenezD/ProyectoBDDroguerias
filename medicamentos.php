<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicamentos - Droquerías Comfenalco</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <header class="header">
        <h1>Medicamentos</h1>
        <p>Encuentra los mejores medicamentos para tu salud.</p>
    </header>

    <?php
    include 'componentes\navbar.php';
    ?>

    <section class="banner">
        <p>¡Recupera tu bienestar con nuestros medicamentos de calidad!</p>
    </section>

    <div class="container my-4">
        <h2 class="text-center">Productos de Medicamentos</h2>
        <div class="product-container">
            <?php
            // Conectar a la base de datos
            include 'conexion.php';  // Incluir la conexión a la base de datos

            // Consulta para obtener los productos de la categoría 'Medicamentos' y su stock
            $sql = "SELECT p.idProducto, p.nombre, p.precio, p.imagen, i.cantidadStock 
                    FROM producto p
                    JOIN categoriaproducto cp ON p.categoriaProducto = cp.idCategoria
                    JOIN inventario i ON p.idProducto = i.idProducto
                    WHERE cp.nombre = 'Medicamentos'";  // Filtramos por la categoría 'Medicamentos'

            $result = $conn->query($sql);

            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                // Mostrar los productos
                while($row = $result->fetch_assoc()) {
                    echo '<div class="card product">';
                    echo '<img src="' . $row['imagen'] . '" alt="Producto ' . $row['nombre'] . '">';
                    echo '<h5>' . $row['nombre'] . '</h5>';
                    echo '<p>$' . number_format($row['precio'], 0, ',', '.') . '</p>';
                    echo '<p><strong>Stock disponible: ' . $row['cantidadStock'] . '</strong></p>';
                    echo '<button>Comprar</button>';
                    echo '</div>';
                }
            } else {
                echo "<p>No hay productos disponibles en esta categoría.</p>";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        </div>
    </div>

    <?php
    include 'componentes\footer.php';
    ?>

</body>
</html>
