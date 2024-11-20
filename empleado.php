<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="stylesheet" href="css/stylesListas.css">
    <!-- Agregar iconos de Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        /* Estilo para la celda de acciones */
        .acciones {
            display: flex;
            justify-content: space-evenly;
            gap: 10px;
        }

        .acciones button {
            padding: 5px 10px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
        }

        .acciones button.editar {
            background-color: #4CAF50;
            color: white;
        }

        .acciones button.editar:hover {
            background-color: #45a049;
        }

        .acciones button.eliminar {
            background-color: #f44336;
            color: white;
        }

        .acciones button.eliminar:hover {
            background-color: #e53935;
        }

        .acciones i {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Empleados</h1>
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
                    <label for="idEmpleado">ID Empleado:</label>
                    <input type="text" name="idEmpleado" id="idEmpleado" placeholder="Ingrese ID de empleado" value="<?= isset($_GET['idEmpleado']) ? htmlspecialchars($_GET['idEmpleado']) : '' ?>">
                </div>

                <div class="filtro">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre" value="<?= isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : '' ?>">
                </div>

                <div class="filtro">
                    <label for="horario">Horario:</label>
                    <input type="time" name="horario" id="horario" value="<?= isset($_GET['horario']) ? htmlspecialchars($_GET['horario']) : '' ?>">
                </div>

                <div class="filtro">
                    <label for="sucursal">Sucursal (solo números):</label>
                    <input type="number" name="sucursal" id="sucursal" placeholder="Ingrese número de sucursal" value="<?= isset($_GET['sucursal']) ? htmlspecialchars($_GET['sucursal']) : '' ?>" min="1">
                </div>

                <div class="filtro">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Ingrese email" value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>">
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

        function recargarDatos() {
            window.location.reload(); // Recarga la página
        }
    </script>

    <!-- Botón de recarga de datos -->
<!-- Botón para recargar los datos con icono -->
<button onclick="recargarDatos()">
    <i class="fas fa-sync-alt"></i> Recargar Datos
</button>

    <button class='crear' onclick="window.location.href='crearEmpleado.php'">
    <i class='fas fa-star'></i> Crear
</button>

    <!-- Tabla de empleados -->
    <table border="1">
        <thead>
            <tr>
                <th>ID Empleado</th>
                <th>Nombre</th>
                <th>Horario</th>
                <th>Sucursal</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="datosEmpleado">
            <?php
            // Conectar a la base de datos
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

            // Inicializar la consulta base
            $sql = "SELECT idEmpleado, nombre, horario, sucursal, email FROM empleado WHERE eliminado = 0";

            // Filtrar por ID de empleado si se proporciona
            if (isset($_GET['idEmpleado']) && !empty($_GET['idEmpleado'])) {
                $idEmpleado = $_GET['idEmpleado'];
                $sql .= " AND idEmpleado LIKE '%$idEmpleado%'";
            }

            // Filtrar por nombre si se proporciona
            if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
                $nombre = $_GET['nombre'];
                $sql .= " AND nombre LIKE '%$nombre%'";
            }

            // Filtrar por horario si se proporciona
            if (isset($_GET['horario']) && !empty($_GET['horario'])) {
                $horario = $_GET['horario'];
                $sql .= " AND horario = '$horario'";
            }

            // Filtrar por sucursal si se proporciona
            if (isset($_GET['sucursal']) && !empty($_GET['sucursal'])) {
                $sucursal = $_GET['sucursal'];
                $sql .= " AND sucursal = $sucursal";
            }

            // Filtrar por email si se proporciona
            if (isset($_GET['email']) && !empty($_GET['email'])) {
                $email = $_GET['email'];
                $sql .= " AND email LIKE '%$email%'";
            }

            // Ejecutar la consulta
            $result = $conn->query($sql);

            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
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
        function editarEmpleado(id) {
            window.location.href = 'editarEmpleado.php?id=' + id;
        }

        function eliminarEmpleado(idEmpleado) {
            if (confirm("¿Seguro que deseas eliminar este empleado?")) {
                window.location.href = "eliminarEmpleado.php?idEmpleado=" + idEmpleado;
            }
        }
    </script>
</body>
</html>
