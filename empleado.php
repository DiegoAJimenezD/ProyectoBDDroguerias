<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="stylesheet" href="css/stylesListas.css">
    <!-- Agregar iconos de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header class="header">
        <h1>Empleados</h1>
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
                <th>ID Empleado</th>
                <th>Nombre</th>
                <th>Horario</th>
                <th>Sucursal</th>
                <th>Email</th>
                <th>Acciones</th> <!-- Columna para los botones -->
            </tr>
        </thead>
        <tbody id="datosEmpleado">
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

            // Consulta para obtener todos los empleados
            $sql = "SELECT idEmpleado, nombre, horario, sucursal, email FROM empleado";
            $result = $conn->query($sql);

            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                // Mostrar los datos en formato de tabla HTML
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row["idEmpleado"] . "</td>
                            <td>" . $row["nombre"] . "</td>
                            <td>" . $row["horario"] . "</td>
                            <td>" . $row["sucursal"] . "</td>
                            <td>" . $row["email"] . "</td>
                            <td>
                                <button class='editar' onclick='editarEmpleado(" . $row["idEmpleado"] . ")'>
                                    <i class='fas fa-edit'></i> Editar
                                </button>
                                <button class='eliminar' onclick='eliminarEmpleado(" . $row["idEmpleado"] . ")'>
                                    <i class='fas fa-trash-alt'></i> Eliminar
                                </button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No se encontraron empleados</td></tr>";
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

        function editarEmpleado(id) {
            // Aquí puedes redirigir a la página de edición, pasando el ID del empleado
            window.location.href = 'editarEmpleado.php?id=' + id;
        }

        function eliminarEmpleado(id) {
            // Confirmación antes de eliminar
            if (confirm("¿Estás seguro de que deseas eliminar este empleado?")) {
                // Aquí puedes agregar la lógica para eliminar al empleado
                window.location.href = 'eliminarEmpleado.php?id=' + id;
            }
        }
    </script>

    <style>
        /* Estilos personalizados para los botones */
        .editar {
            background-color: #28a745; /* Verde */
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
        }

        .editar i {
            margin-right: 5px;
        }

        .editar:hover {
            background-color: #218838;
        }

        .eliminar {
            background-color: #dc3545; /* Rojo */
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
            display: inline-flex;
            align-items: center;
        }

        .eliminar i {
            margin-right: 5px;
        }

        .eliminar:hover {
            background-color: #c82333;
        }
    </style>
</body>
</html>
