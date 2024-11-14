<div class="container">
    <h2 class="text-center">Productos Destacados</h2>

    <!-- Filtros -->
    <form method="GET" action="" class="formularioFiltros" id="filterForm">
        <div class="filtro">
            <label for="categoria">Categoría:</label>
            <select name="categoria" id="categoria">
                <option value="">Todas</option>
                <?php
                include 'conexion.php';  // Incluir la conexión a la base de datos

                // Consulta para obtener las categorías disponibles
                $sqlCategorias = "SELECT idCategoria, nombre FROM categoriaproducto";
                $resultCategorias = $conn->query($sqlCategorias);

                while ($rowCategoria = $resultCategorias->fetch_assoc()) {
                    $selected = (isset($_GET['categoria']) && $_GET['categoria'] == $rowCategoria['idCategoria']) ? 'selected' : '';
                    echo "<option value='" . $rowCategoria['idCategoria'] . "' $selected>" . $rowCategoria['nombre'] . "</option>";
                }

                $conn->close();
                ?>
            </select>
        </div>

        <div class="filtro">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" placeholder="Buscar por nombre" value="<?= isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : '' ?>">
        </div>

        <div class="filtro">
            <label for="precio">Precio máximo:</label>
            <input type="number" name="precio" id="precio" min="0" step="0.01" placeholder="Precio máximo" value="<?= isset($_GET['precio']) ? htmlspecialchars($_GET['precio']) : '' ?>">
        </div>
        <div class="filtro-boton">
    <button type="submit">Filtrar</button>
    <button type="button" onclick="resetFilters()">Limpiar</button>
</div>

    </form>

    <div class="product-container">
        <?php
        include 'conexion.php';  // Incluir la conexión a la base de datos

        // Construir la consulta SQL con filtros
        $sql = "SELECT p.idProducto, p.nombre, p.precio, cp.nombre AS categoriaNombre, p.imagen, i.cantidadStock
                FROM producto p
                JOIN inventario i ON p.idProducto = i.idProducto
                JOIN categoriaproducto cp ON p.categoriaProducto = cp.idCategoria";

        // Aplicar filtros si se han enviado
        $conditions = [];
        if (isset($_GET['categoria']) && $_GET['categoria'] !== '') {
            $categoria = $conn->real_escape_string($_GET['categoria']);
            $conditions[] = "p.categoriaProducto = '$categoria'";
        }
        if (isset($_GET['nombre']) && $_GET['nombre'] !== '') {
            $nombre = $conn->real_escape_string($_GET['nombre']);
            $conditions[] = "p.nombre LIKE '%$nombre%'";
        }
        if (isset($_GET['precio']) && $_GET['precio'] !== '') {
            $precio = (float) $_GET['precio'];
            $conditions[] = "p.precio <= $precio";
        }

        if (!empty($conditions)) {
            $sql .= " WHERE " . implode(' AND ', $conditions);
        }

        $result = $conn->query($sql);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Mostrar los productos
            while($row = $result->fetch_assoc()) {
                echo '<div class="card product">';
                echo '<img src="' . $row['imagen'] . '" alt="Producto ' . $row['nombre'] . '">';
                echo '<h5>' . $row['nombre'] . '</h5>';
                echo '<p>Categoría: ' . $row['categoriaNombre'] . '</p>';
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

<script>
    // Función para limpiar los campos del formulario de filtros
    function resetFilters() {
        document.getElementById("categoria").value = "";
        document.getElementById("nombre").value = "";
        document.getElementById("precio").value = "";
        document.getElementById("filterForm").submit();
    }
</script>
