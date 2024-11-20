
<?php
// Conexión a la base de datos
$servername = "localhost"; // Cambia esto si el servidor es diferente
$username = "root"; // Usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$dbname = "drogueriasconfe"; // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener los datos de la tabla inventario
$sql = "SELECT idInventario, fecha, cantidadStock, idProducto FROM inventario";
$result = $conn->query($sql);

// Verificar si la consulta devuelve resultados
if ($result->num_rows > 0) {
    $inventarios = array();
    while ($row = $result->fetch_assoc()) {
        $inventarios[] = $row;
    }
} else {
    $inventarios = []; // Si no hay resultados, definimos un arreglo vacío
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
</head>
<body>
    <header class="header">

        <h1>Inventario</h1>
        <nav>
        <ul>
        <li>
                <li><a href="empleado.php">Empleados</a></li>
                <li><a href="producto.php">Productos</a></li>
                <li><a href="proveedor.php">Proveedores</a></li>
                <li><a href="inventario.php">Inventario</a></li>
                <li><a href="administrador.php">Panel</a></li>   
            </ul>
        </nav>
    </header>
    <button onclick="window.location.href='estadisticasStock.php';">Ver Gráfica de Stock</button>
    <button onclick="recargarDatos()">Recargar Datos</button>
    <button class='crear' onclick="window.location.href='crearInventario.php'">
    <i class='fas fa-star'></i> Crear
</button>
    </header>

    <table border="1">
        <thead>
            <tr>
                <th>ID Inventario</th>
                <th>Fecha</th>
                <th>Cantidad Stock</th>
                <th>ID Producto</th>
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
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron datos</td></tr>";
            }
            ?>
        </tbody>
    </table>

    

    <script>
        function recargarDatos() {
            location.reload(); // Recargar la página
        }
    </script>
            <!-- Datos a cargar dinámicamente -->
        </tbody>
    </table>

    
</body>
</html>
