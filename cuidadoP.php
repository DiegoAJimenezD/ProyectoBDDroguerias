<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Cuidado Personal | Droquerías COMFENALCO</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <header class="header">
        <h1>Cuidado Personal</h1>
        <p>Encuentra los mejores productos de cuidado personal</p>
    </header>

    <?php
    include 'componentes\navbar.php';
    ?>

    <section class="banner">
        <p>¡Promociones y descuentos en productos seleccionados!</p>
    </section>

    <div class="container">
        <h2 class="text-center">Productos de Cuidado Personal</h2>

        <div class="product-container">
            <?php
            // Conectar a la base de datos
            include 'conexion.php';  // Incluir la conexión a la base de datos

            // Consulta para obtener los productos de la categoría 'Cuidado Personal' y su stock
            $sql = "SELECT p.idProducto, p.nombre, p.precio, p.imagen, i.cantidadStock 
                    FROM producto p
                    JOIN categoriaproducto cp ON p.categoriaProducto = cp.idCategoria
                    JOIN inventario i ON p.idProducto = i.idProducto
                    WHERE cp.nombre = 'Higiene Personal'";  // Filtramos por la categoría 'Cuidado Personal'

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

<script>
    // Función para redirigir a la página de compra
    function redirigirCompra(idProducto) {
        // Redirige a la página de compra pasando el id del producto en la URL
        window.location.href = `compra.php?idProducto=${idProducto}`;
    }
</script>
</body>

</html>
