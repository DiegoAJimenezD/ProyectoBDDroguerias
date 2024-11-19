<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sucursales</title>
    <link rel="stylesheet" href="css/stylesListas.css">
</head>
<body>
    <header class="header">
        <h1>Sucursales</h1>
        <nav>
        <ul>
                <li><a href="cliente.php">Clientes</a></li>
                <li><a href="empleado.php">Empleados</a></li>
                <li><a href="sucursal.php">Sucursales</a></li>
                <li><a href="producto.php">Productos</a></li>
                <li><a href="inventario.php">Inventario</a></li>
                <li><a href="proveedor.php">Proveedores</a></li>
                <li><a href="pedido.php">Pedidos</a></li>
                <li><a href="venta.php">Ventas</a></li>
                <li><a href="administrador.php">Panel</a></li>

            </ul>
        </nav>
    </header>
    <button onclick="recargarDatos()">Recargar Datos</button>
    <table border="1">
        <thead>
            <tr>
                <th>ID Sucursal</th>
                <th>Nombre</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody id="datosSucursal">
            <?php
            // Conectar a la base de datos
            $servername = "localhost";  // Servidor de la base de datos
            $username = "root";         // Usuario de MySQL
            $password = "";             // Contraseña de MySQL
            $dbname = "drogueriasconfe"; // Nombre de la base de datos

            // Crear la conexión
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta para obtener todas las sucursales
            $sql = "SELECT idSucursal, nombre, direccion FROM sucursal";
            $result = $conn->query($sql);

            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                // Mostrar los datos en formato de tabla HTML
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["idSucursal"] . "</td>
                            <td>" . $row["nombre"] . "</td>
                            <td>" . $row["direccion"] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No se encontraron sucursales</td></tr>";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
        </tbody>
    </table>
    <script>
        function recargarDatos() {
            // Para recargar los datos, puedes recargar la página o hacer una petición AJAX
            window.location.reload(); // Recarga la página
        }
    </script>
</body>
</html>
