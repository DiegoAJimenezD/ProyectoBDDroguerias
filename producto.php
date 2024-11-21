<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="css/stylesListas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

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


    <!-- Formulario de filtros -->
 <!-- Formulario de filtros -->
 <form method="GET" action="" id="filterForm">
        <div class="contenedor-filtros">
            <div class="formulario-filtros">
                <div class="filtro">
                    <label for="idProducto">ID Producto:</label>
                    <input type="text" name="idProducto" id="idProducto" placeholder="Ingrese ID del producto" value="<?= isset($_GET['idProducto']) ? htmlspecialchars($_GET['idProducto']) : '' ?>">
                </div>

                <div class="filtro">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre" value="<?= isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : '' ?>">
                </div>

                <div class="filtro">
                    <label for="precio">Precio:</label>
                    <input type="number" name="precio" id="precio" placeholder="Ingrese precio" value="<?= isset($_GET['precio']) ? htmlspecialchars($_GET['precio']) : '' ?>" min="0" step="any">
                </div>

                <div class="filtro">
                    <label for="categoria">Categoría:</label>
                    <select name="categoria" id="categoria">
                        <option value="">Seleccionar categoría</option>
                        <option value="Medicamentos" <?= isset($_GET['categoria']) && $_GET['categoria'] == 'Medicamentos' ? 'selected' : '' ?>>Medicamentos</option>
                        <option value="Cosmeticos" <?= isset($_GET['categoria']) && $_GET['categoria'] == 'Cosmeticos' ? 'selected' : '' ?>>Cosméticos</option>
                        <option value="Higiene Personal" <?= isset($_GET['categoria']) && $_GET['categoria'] == 'Higiene Personal' ? 'selected' : '' ?>>Higiene Personal</option>
                    </select>
                </div>
            </div>

            <div class="botones">
                <button type="submit">Filtrar</button>
                <button type="reset" onclick="resetFilters()">Limpiar</button>
            </div>
        </div>
    </form>

    <button onclick="recargarDatos()">
    <i class="fas fa-sync-alt"></i> Recargar Datos
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
                $conditions[] = "c.nombre = '$categoria'";  // Filtrar por categoría
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
                            <button onclick='editarProducto(" . $row["idProducto"] . ")'> <i class='fas fa-edit'></i> Editar</button>
                            <button onclick='eliminarProducto(" . $row["idProducto"] . ")'> <i class='fas fa-trash-alt'></i>Eliminar</button>
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

        function recargarDatos() {
            location.reload(); // Recargar la página
        }
        function resetFilters() {
            document.getElementById("categoria").value = "";  
            document.getElementById("nombre").value = "";  
            document.getElementById("precio").value = "";  
            document.getElementById("idProducto").value = "";  
            document.getElementById("filterForm").submit();  
        }
        function editarProducto(idProducto) {
            window.location.href = "editarProducto.php?idProducto=" + idProducto;
        }

        function eliminarProducto(idProducto) {
            if (confirm("¿Seguro que deseas eliminar este producto?")) {
                window.location.href = "eliminarProducto.php?idProducto=" + idProducto;
            }
        }
    </script>

    
</body>
</html>
