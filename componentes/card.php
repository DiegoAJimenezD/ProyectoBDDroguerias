<div class="container">
    <!-- Título de la sección de productos destacados -->
    <h2 class="text-center">Productos Destacados</h2>

    <!-- Formulario para los filtros -->
    <form method="GET" action="" class="formularioFiltros" id="filterForm">
        <!-- Filtro por categoría -->
        <div class="filtro">
            <label for="categoria">Categoría:</label>
            <select name="categoria" id="categoria">
                <option value="">Todas</option>
                <?php
                include 'conexion.php';  // Incluir la conexión a la base de datos

                // Consulta para obtener las categorías disponibles
                $sqlCategorias = "SELECT idCategoria, nombre FROM categoriaproducto";
                $resultCategorias = $conn->query($sqlCategorias);

                // Mostrar las categorías en el desplegable
                while ($rowCategoria = $resultCategorias->fetch_assoc()) {
                    // Si el filtro de categoría está seleccionado, marcar la opción como 'selected'
                    $selected = (isset($_GET['categoria']) && $_GET['categoria'] == $rowCategoria['idCategoria']) ? 'selected' : '';
                    echo "<option value='" . $rowCategoria['idCategoria'] . "' $selected>" . $rowCategoria['nombre'] . "</option>";
                }

                $conn->close();  // Cerrar la conexión
                ?>
            </select>
        </div>

        <!-- Filtro por nombre del producto -->
        <div class="filtro">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Buscar por nombre" value="<?= isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : '' ?>">
        </div>

        <!-- Filtro por precio máximo -->
        <div class="filtro">
            <label for="precio">Precio máximo:</label>
            <input type="number" name="precio" id="precio" min="0" step="0.01" placeholder="Precio máximo" value="<?= isset($_GET['precio']) ? htmlspecialchars($_GET['precio']) : '' ?>">
        </div>

        <!-- Botones de filtro -->
        <div class="filtro-boton">
            <button type="submit">Filtrar</button>
            <button type="button" onclick="resetFilters()">Limpiar</button>
        </div>
    </form>

    <!-- Contenedor de los productos -->
    <div class="product-container">
        <?php
        include 'conexion.php';  // Incluir la conexión a la base de datos

        // Consulta SQL básica para obtener productos con sus categorías y stock
        $sql = "SELECT p.idProducto, p.nombre, p.precio, cp.nombre AS categoriaNombre, p.imagen, i.cantidadStock
                FROM producto p
                JOIN inventario i ON p.idProducto = i.idProducto
                JOIN categoriaproducto cp ON p.categoriaProducto = cp.idCategoria";

        // Agregar condiciones a la consulta SQL si se han enviado filtros
        $conditions = [];
        if (isset($_GET['categoria']) && $_GET['categoria'] !== '') {
            $categoria = $conn->real_escape_string($_GET['categoria']);
            $conditions[] = "p.categoriaProducto = '$categoria'";  // Filtrar por categoría
        }
        if (isset($_GET['nombre']) && $_GET['nombre'] !== '') {
            $nombre = $conn->real_escape_string($_GET['nombre']);
            $conditions[] = "p.nombre LIKE '%$nombre%'";  // Filtrar por nombre
        }
        if (isset($_GET['precio']) && $_GET['precio'] !== '') {
            $precio = (float) $_GET['precio'];
            $conditions[] = "p.precio <= $precio";  // Filtrar por precio máximo
        }

        // Si hay condiciones, agregar al final de la consulta
        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        $result = $conn->query($sql);  // Ejecutar la consulta

        // Verificar si hay productos disponibles
        if ($result->num_rows > 0) {
            // Mostrar los productos obtenidos de la consulta
            while($row = $result->fetch_assoc()) {
                echo '<div class="card product">';
                echo '<img src="' . $row['imagen'] . '" alt="Producto ' . $row['nombre'] . '">';
                echo '<h5>' . $row['nombre'] . '</h5>';
                echo '<p>Categoría: ' . $row['categoriaNombre'] . '</p>';
                echo '<p>$' . number_format($row['precio'], 0, ',', '.') . '</p>';
                echo '<p><strong>Stock disponible: ' . $row['cantidadStock'] . '</strong></p>';
                // Modificar el botón para redirigir a la página de compra
                echo '<button onclick="redirigirCompra(' . $row['idProducto'] . ')">Comprar</button>';
                echo '</div>';
            }
        } else {
            echo "No hay productos disponibles";  // Mensaje si no se encuentran productos
        }

        $conn->close();  // Cerrar la conexión
        ?>
    </div>
</div>

<script>
    // Función para limpiar los campos del formulario de filtros
    function resetFilters() {
        document.getElementById("categoria").value = "";  // Limpiar el filtro de categoría
        document.getElementById("nombre").value = "";  // Limpiar el filtro de nombre
        document.getElementById("precio").value = "";  // Limpiar el filtro de precio
        document.getElementById("filterForm").submit();  // Enviar el formulario para aplicar los cambios
    }

    // Función para redirigir a la página de compra
    function redirigirCompra(idProducto) {
        window.location.href = `compra.php?idProducto=${idProducto}`;
    }
</script>
