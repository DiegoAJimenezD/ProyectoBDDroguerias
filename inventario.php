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

// Variables para almacenar filtros
$idInventario = isset($_GET['idInventario']) ? $_GET['idInventario'] : '';
$fecha = isset($_GET['fecha']) ? $_GET['fecha'] : '';
$cantidadStock = isset($_GET['cantidadStock']) ? $_GET['cantidadStock'] : '';
$idProducto = isset($_GET['idProducto']) ? $_GET['idProducto'] : '';

// Construir la consulta SQL dinámica con los filtros
$sql = "SELECT idInventario, fecha, cantidadStock, idProducto FROM inventario WHERE eliminado = 0";

$filters = []; // Array para almacenar condiciones
if (!empty($idInventario)) {
    $filters[] = "idInventario = '" . $conn->real_escape_string($idInventario) . "'";
}
if (!empty($fecha)) {
    $filters[] = "fecha = '" . $conn->real_escape_string($fecha) . "'";
}
if (!empty($cantidadStock)) {
    $filters[] = "cantidadStock = " . (int)$cantidadStock;
}
if (!empty($idProducto)) {
    $filters[] = "idProducto = '" . $conn->real_escape_string($idProducto) . "'";
}

// Agregar filtros a la consulta
if (count($filters) > 0) {
    $sql .= " AND " . implode(" AND ", $filters);
}

$result = $conn->query($sql);

// Verificar si la consulta devuelve resultados
$inventarios = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $inventarios[] = $row;
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
    <title>Inventario</title>
    <link rel="stylesheet" href="css/stylesListas.css">
    <!-- Agregar iconos de Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header class="header">
        <h1>Inventario</h1>
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
    <form method="GET" action="">
        <div class="contenedor-filtros">
            <div class="formulario-filtros">
                <div class="filtro">
                    <label for="idInventario">ID Inventario:</label>
                    <input type="text" name="idInventario" id="idInventario" placeholder="Ingrese ID de inventario" value="<?= isset($_GET['idInventario']) ? htmlspecialchars($_GET['idInventario']) : '' ?>">
                </div>

                <div class="filtro">
                    <label for="fecha">Fecha:</label>
                    <input type="date" name="fecha" id="fecha" value="<?= isset($_GET['fecha']) ? htmlspecialchars($_GET['fecha']) : '' ?>">
                </div>

                <div class="filtro">
                    <label for="cantidadStock">Cantidad Stock:</label>
                    <input type="number" name="cantidadStock" id="cantidadStock" placeholder="Ingrese cantidad en stock" value="<?= isset($_GET['cantidadStock']) ? htmlspecialchars($_GET['cantidadStock']) : '' ?>" min="0">
                </div>

                <div class="filtro">
                    <label for="idProducto">ID Producto:</label>
                    <input type="text" name="idProducto" id="idProducto" placeholder="Ingrese ID del producto" value="<?= isset($_GET['idProducto']) ? htmlspecialchars($_GET['idProducto']) : '' ?>">
                </div>
            </div>

            <div class="botones">
                <button type="submit">Filtrar</button>
                <button type="reset" onclick="resetForm()">Limpiar</button>
            </div>
        </div>
    </form>

    <script>
        function resetForm() {
            document.querySelector("form").reset();
            window.location.href = window.location.pathname;
        }
    </script>
    <button onclick="recargarDatos()">
    <i class="fas fa-sync-alt"></i> Recargar Datos
</button>
    <button class='crear' onclick="window.location.href='crearInventario.php'">
        <i class='fas fa-star'></i> Crear
    </button>


    <table border="1">
        <thead>
            <tr>
                <th>ID Inventario</th>
                <th>Fecha</th>
                <th>Cantidad Stock</th>
                <th>ID Producto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="datosInventario">

            <?php
            // Mostrar los datos en la tabla
            if (count($inventarios) > 0) {
                foreach ($inventarios as $row) {
                    echo "<tr>";
                    echo "<td>" . $row["idInventario"] . "</td>";
                    echo "<td>" . $row["fecha"] . "</td>";
                    echo "<td>" . $row["cantidadStock"] . "</td>";
                    echo "<td>" . $row["idProducto"] . "</td>";
                    echo "<td>";
                    echo "<button onclick='editarInventario(" . $row["idInventario"] . ")'><i class='fas fa-edit'></i> Editar</button>";
                    echo "<button onclick='eliminarInventario(" . $row["idInventario"] . ")'><i class='fas fa-trash'></i> Eliminar</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se encontraron datos</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function recargarDatos() {
            location.reload(); // Recargar la página
        }

        function editarInventario(id) {
            window.location.href = 'editarInventario.php?id=' + id;
        }

        function eliminarInventario(idInventario) {
            if (confirm("¿Seguro que deseas eliminar este inventario?")) {
                window.location.href = "eliminarInventario.php?idInventario=" + idInventario;
            }
        }
    </script>
</body>
</html>
