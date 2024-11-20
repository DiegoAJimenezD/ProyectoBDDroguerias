<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proveedores</title>
    <link rel="stylesheet" href="css/stylesListas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <header class="header">
        <h1>Proveedores</h1>
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
                    <label for="idProveedor">ID Proveedor:</label>
                    <input type="text" name="idProveedor" id="idProveedor" placeholder="Ingrese ID de proveedor" value="<?= isset($_GET['idProveedor']) ? htmlspecialchars($_GET['idProveedor']) : '' ?>">
                </div>

                <div class="filtro">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" placeholder="Ingrese nombre del proveedor" value="<?= isset($_GET['nombre']) ? htmlspecialchars($_GET['nombre']) : '' ?>">
                </div>

                <div class="filtro">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" placeholder="Ingrese email del proveedor" value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>">
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
    <button class='crear' onclick="window.location.href='crearProveedor.php'">
        <i class='fas fa-star'></i> Crear
    </button>

    <table border="1">
        <thead>
            <tr>
                <th>ID Proveedor</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th> <!-- Nueva columna para las acciones -->
            </tr>
        </thead>
        <tbody id="datosProveedor">
            <?php
            // Conexión a la base de datos
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "drogueriasconfe";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Obtener filtros si existen
            $idProveedor = isset($_GET['idProveedor']) ? $_GET['idProveedor'] : '';
            $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : '';
            $email = isset($_GET['email']) ? $_GET['email'] : '';

            // Consulta SQL para obtener los proveedores con filtros
            $sql = "SELECT idProveedor, nombre, email FROM proveedor WHERE eliminado = 0";

            // Agregar condiciones de filtro si existen
            if ($idProveedor) {
                $sql .= " AND idProveedor LIKE '%" . $conn->real_escape_string($idProveedor) . "%'";
            }
            if ($nombre) {
                $sql .= " AND nombre LIKE '%" . $conn->real_escape_string($nombre) . "%'";
            }
            if ($email) {
                $sql .= " AND email LIKE '%" . $conn->real_escape_string($email) . "%'";
            }

            $result = $conn->query($sql);

            // Mostrar los datos en la tabla
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['idProveedor'] . "</td>
                            <td>" . $row['nombre'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>
                                <button onclick='editarProveedor(" . $row['idProveedor'] . ")'>
                                    <i class='fas fa-edit'></i> Editar
                                </button>
                                <button onclick='eliminarProveedor(" . $row['idProveedor'] . ")'>
                                    <i class='fas fa-trash'></i> Eliminar
                                </button>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No se encontraron proveedores</td></tr>";
            }

            // Cerrar conexión
            $conn->close();
            ?>
        </tbody>
    </table>

    <script>
        // Función para recargar los datos de la página
        function recargarDatos() {
            location.reload(); // Recargar la página
        }

        // Función para editar proveedor
        function editarProveedor(idProveedor) {
            window.location.href = "editarProveedor.php?idProveedor=" + idProveedor;
        }

        // Función para eliminar proveedor
        function eliminarProveedor(idProveedor) {
            if (confirm("¿Seguro que deseas eliminar este proveedor?")) {
                window.location.href = "eliminarProveedor.php?idProveedor=" + idProveedor;
            }
        }
    </script>
</body>
</html>
