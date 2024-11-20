<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="css/stylesListas.css">
</head>
<body>
    <header class="header">
        <h1>Productos</h1>
        <nav>
            <ul>
            <li><a href="empleado.php">Empleados</a></li>
                <li><a href="producto.php">Productos</a></li>
                <li><a href="proveedor.php">Proveedores</a></li>
                <li><a href="inventario.php">Inventario</a></li>
                <li><a href="administrador.php">Panel</a></li>  
            </ul>
        </nav>
    </header>

    <form method="GET" action="">
    <div class="contenedor-filtros">
    <div class="formulario-filtros">
    <div class="filtro">
        <label for="categoria">Categoría:</label>
        <select name="categoria" id="categoria">
            <option value="">Todas</option>
            <?php
            $conn = new mysqli('localhost', 'root', '', 'drogueriasconfe');
            $sqlCategorias = "SELECT idCategoria, nombre FROM categoriaProducto";
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
        <label for="idProducto">ID Producto:</label>
        <input type="number" name="idProducto" id="idProducto" placeholder="Buscar por ID" value="<?= isset($_GET['idProducto']) ? htmlspecialchars($_GET['idProducto']) : '' ?>">
    </div>

    <div class="filtro">
        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" min="0" step="0.01" placeholder="Precio" value="<?= isset($_GET['precio']) ? htmlspecialchars($_GET['precio']) : '' ?>">
    </div>

    <div class="filtro-boton">
        <button type="submit">Filtrar</button>
        <button type="button" onclick="resetForm()">Limpiar</button>
    </div>
        </div>
        </div>
</form>

    <!-- Botón para recargar los datos -->
    <button class='Estadisticas' onclick="window.location.href='productosCategoriaEstadistica.php'">
    <i class='fas fa-star'></i> Estatisticas Ventas
    <button onclick="window.location.reload()">Recargar Datos</button>
    <button class='crear' onclick="window.location.href='crearProductos.php'">
    <i class='fas fa-star'></i> Crear
</button>

    <!-- Tabla de Productos -->
    <table border="1">
        <thead>
            <tr>
                <th>ID Producto</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="datosProducto">
            <?php
            // Conexión a la base de datos
            $conn = new mysqli('localhost', 'root', '', 'drogueriasconfe');

            // Consulta base para obtener productos
            $sql = "SELECT p.idProducto, p.nombre, p.precio, c.nombre AS categoria 
                    FROM producto p
                    JOIN categoriaProducto c ON p.categoriaProducto = c.idCategoria
                    WHERE p.eliminado = 0";

            // Agregar filtros a la consulta
            $conditions = [];
            if (isset($_GET['categoria']) && $_GET['categoria'] !== '') {
                $categoria = $conn->real_escape_string($_GET['categoria']);
                $conditions[] = "p.categoriaProducto = '$categoria'";  // Filtrar por categoría
            }
            if (isset($_GET['nombre']) && $_GET['nombre'] !== '') {
                $nombre = $conn->real_escape_string($_GET['nombre']);
                $conditions[] = "p.nombre LIKE '%$nombre%'";  // Filtrar por nombre
            }

            if (isset($_GET['idProducto']) && $_GET['idProducto'] !== '') {
                $idProducto = (int) $_GET['idProducto'];
                $conditions[] = "p.idProducto = $idProducto";  // Filtrar por ID Producto
            }

            if (isset($_GET['precio']) && $_GET['precio'] !== '') {
                $precio = (float) $_GET['precio'];
                $conditions[] = "p.precio = $precio";  // Filtrar por precio exacto
            }

            // Si hay filtros, agregarlos a la consulta
            if (!empty($conditions)) {
                $sql .= " AND " . implode(' AND ', $conditions);
            }


            // Ejecutar la consulta
            $resultado = $conn->query($sql);

            // Mostrar los resultados
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    echo "<tr id='producto-" . $row["idProducto"] . "'>";
                    echo "<td>" . $row["idProducto"] . "</td>";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["precio"] . "</td>";
                    echo "<td>" . $row["categoria"] . "</td>";
                    echo "<td>
                            <button onclick='editarProducto(" . $row["idProducto"] . ")'>Editar</button>
                            <button onclick='eliminarProducto(" . $row["idProducto"] . ")'>Eliminar</button>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se encontraron productos</td></tr>";
            }

            $conn->close();  // Cerrar la conexión
            ?>
        </tbody>
    </table>

    <script>

function resetForm() {
            document.querySelector("form").reset();
            window.location.href = window.location.pathname;
        }
        function editarProducto(idProducto) {
            window.location.href = "editarProducto.php?idProducto=" + idProducto;
        }

        function eliminarProducto(idProducto) {
            if (confirm("¿Seguro que deseas eliminar este producto?")) {
                window.location.href = "eliminarProducto.php?idProducto=" + idProducto;
            }
        }

        // Función para limpiar los filtros
        function resetFilters() {
            document.getElementById("categoria").value = "";  
            document.getElementById("nombre").value = "";  
            document.getElementById("precio").value = "";  
            document.getElementById("idProducto").value = "";  
            document.getElementById("filterForm").submit();  
        }
    </script>

</body>
</html>