
<div class="container">
    <h2 class="text-center">Productos Destacados</h2>
    <div class="product-container">
        <?php
        include 'conexion.php';  // Incluir la conexión a la base de datos

        // Consulta para obtener los productos y la cantidad de inventario
        $sql = "SELECT p.idProducto, p.nombre, p.precio, p.categoriaProducto, p.imagen, i.cantidadStock
                FROM producto p
                JOIN inventario i ON p.idProducto = i.idProducto";
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
            echo "No hay productos disponibles";
        }

        // Cerrar la conexión
        $conn->close();
        ?>
    </div>
</div>