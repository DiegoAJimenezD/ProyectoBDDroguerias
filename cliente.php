<?php
// Incluir la conexión a la base de datos
include('conexion.php');

// Obtener los valores de los filtros, si están definidos
$cedulaFiltro = isset($_GET['cedula']) ? $_GET['cedula'] : '';
$primernombreFiltro = isset($_GET['primernombre']) ? $_GET['primernombre'] : '';
$segundonombreFiltro = isset($_GET['segundonombre']) ? $_GET['segundonombre'] : '';
$primerapellidoFiltro = isset($_GET['primerapellido']) ? $_GET['primerapellido'] : '';
$segundoapellidoFiltro = isset($_GET['segundoapellido']) ? $_GET['segundoapellido'] : '';
$fechanacimientoFiltro = isset($_GET['fechanacimiento']) ? $_GET['fechanacimiento'] : '';
$emailFiltro = isset($_GET['email']) ? $_GET['email'] : '';

// Construir la consulta con los filtros
$sql = "SELECT cedula, primernombre, segundonombre, primerapellido, segundoapellido, fechanacimiento, email FROM cliente WHERE 1=1";

if ($cedulaFiltro) {
    $sql .= " AND cedula LIKE '%" . $conn->real_escape_string($cedulaFiltro) . "%'";
}
if ($primernombreFiltro) {
    $sql .= " AND primernombre LIKE '%" . $conn->real_escape_string($primernombreFiltro) . "%'";
}
if ($segundonombreFiltro) {
    $sql .= " AND segundonombre LIKE '%" . $conn->real_escape_string($segundonombreFiltro) . "%'";
}
if ($primerapellidoFiltro) {
    $sql .= " AND primerapellido LIKE '%" . $conn->real_escape_string($primerapellidoFiltro) . "%'";
}
if ($segundoapellidoFiltro) {
    $sql .= " AND segundoapellido LIKE '%" . $conn->real_escape_string($segundoapellidoFiltro) . "%'";
}
if ($fechanacimientoFiltro) {
    $sql .= " AND fechanacimiento = '" . $conn->real_escape_string($fechanacimientoFiltro) . "'";
}
if ($emailFiltro) {
    $sql .= " AND email LIKE '%" . $conn->real_escape_string($emailFiltro) . "%'";
}

// Realizar la consulta a la base de datos
$result = $conn->query($sql);

// Comprobar si hay resultados
if ($result->num_rows > 0) {
    // Si hay resultados, generamos las filas de la tabla
    $clientes = [];
    while($row = $result->fetch_assoc()) {
        $clientes[] = $row; // Almacenamos los datos en un arreglo
    }
} else {
    $clientes = [];
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="stylesheet" href="css/stylesListas.css">
    <!-- Incluir Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Estilo para la celda de acciones */
        .acciones {
            display: flex; /* Usamos flexbox para alinear los botones */
            justify-content: space-evenly; /* Espacio uniforme entre los botones */
            gap: 10px; /* Espacio entre los botones */
        }

        /* Estilo para los botones */
        .acciones button {
            padding: 5px 10px; /* Tamaño de los botones */
            cursor: pointer; /* Cambia el cursor al pasar por encima */
            border: none; /* Sin borde */
            border-radius: 5px; /* Bordes redondeados */
            transition: background-color 0.3s ease; /* Animación suave para el color de fondo */
            display: flex;
            align-items: center;
        }

        /* Botón de editar (verde) */
        .acciones button.editar {
            background-color: #4CAF50; /* Verde */
            color: white; /* Color del texto */
        }

        .acciones button.editar:hover {
            background-color: #45a049; /* Verde más oscuro en hover */
        }

        /* Botón de eliminar (rojo) */
        .acciones button.eliminar {
            background-color: #f44336; /* Rojo */
            color: white; /* Color del texto */
        }

        .acciones button.eliminar:hover {
            background-color: #e53935; /* Rojo más oscuro en hover */
        }

        .acciones i {
            margin-right: 5px; /* Espacio entre el icono y el texto */
        }
    </style>
</head>
<body>
    
    <header>
        <h1>Clientes</h1>
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

    <form method="GET" action="">
    <div class="contenedor-filtros">
        <div class="formulario-filtros">
            <div class="filtro">
                <label for="cedula">Cédula:</label>
                <input type="text" name="cedula" id="cedula" placeholder="Buscar por cédula" value="<?= isset($_GET['cedula']) ? htmlspecialchars($_GET['cedula']) : '' ?>">
            </div>

            <div class="filtro">
                <label for="primernombre">Primer Nombre:</label>
                <input type="text" name="primernombre" id="primernombre" placeholder="Buscar por primer nombre" value="<?= isset($_GET['primernombre']) ? htmlspecialchars($_GET['primernombre']) : '' ?>">
            </div>

            <div class="filtro">
                <label for="segundonombre">Segundo Nombre:</label>
                <input type="text" name="segundonombre" id="segundonombre" placeholder="Buscar por segundo nombre" value="<?= isset($_GET['segundonombre']) ? htmlspecialchars($_GET['segundonombre']) : '' ?>">
            </div>

            <div class="filtro">
                <label for="primerapellido">Primer Apellido:</label>
                <input type="text" name="primerapellido" id="primerapellido" placeholder="Buscar por primer apellido" value="<?= isset($_GET['primerapellido']) ? htmlspecialchars($_GET['primerapellido']) : '' ?>">
            </div>

            <div class="filtro">
                <label for="segundoapellido">Segundo Apellido:</label>
                <input type="text" name="segundoapellido" id="segundoapellido" placeholder="Buscar por segundo apellido" value="<?= isset($_GET['segundoapellido']) ? htmlspecialchars($_GET['segundoapellido']) : '' ?>">
            </div>

            <div class="filtro">
                <label for="fechanacimiento">Fecha de Nacimiento:</label>
                <input type="date" name="fechanacimiento" id="fechanacimiento" value="<?= isset($_GET['fechanacimiento']) ? htmlspecialchars($_GET['fechanacimiento']) : '' ?>">
            </div>

            <div class="filtro">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Buscar por email" value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>">
            </div>
        </div>

        <!-- Botones debajo de los filtros -->
        <div class="botones">
            <button onclick="window.location.href='clientepdf.php';">Generar reporte</button>
            <button type="submit">Filtrar</button>
            <button type="reset" onclick="resetForm()">Limpiar</button> <!-- Botón limpiar -->
        </div>
    </div>
</form>

<script>
    function resetForm() {
        // Obtiene todos los campos del formulario
        var form = document.querySelector("form");

        // Recorre todos los campos y los limpia
        form.reset();

        // Si quieres asegurarte de limpiar también los valores de los filtros de URL (GET), puedes redirigir a una URL sin parámetros
        window.location.href = window.location.pathname;
    }
</script>

    
    <div class>
    <button onclick="recargarDatos()">Recargar Datos</button>
    </div>
   

    <table border="1">
        <thead>
            <tr>
                <th>Cédula</th>
                <th>Primer Nombre</th>
                <th>Segundo Nombre</th>
                <th>Primer Apellido</th>
                <th>Segundo Apellido</th>
                <th>Fecha Nacimiento</th>
                <th>Email</th>
                <th>Acciones</th> <!-- Nueva columna para acciones -->
            </tr>
        </thead>
        <tbody id="datosCliente">
            <?php
            // Mostrar los resultados de la consulta
            if (count($clientes) > 0) {
                foreach ($clientes as $cliente) {
                    echo "<tr>";
                    echo "<td>" . $cliente['cedula'] . "</td>";
                    echo "<td>" . $cliente['primernombre'] . "</td>";
                    echo "<td>" . $cliente['segundonombre'] . "</td>";
                    echo "<td>" . $cliente['primerapellido'] . "</td>";
                    echo "<td>" . $cliente['segundoapellido'] . "</td>";
                    echo "<td>" . $cliente['fechanacimiento'] . "</td>";
                    echo "<td>" . $cliente['email'] . "</td>";
                    echo "<td class='acciones'>
                            <button class='editar' onclick='editarCliente(\"" . $cliente['cedula'] . "\")'>
                                <i class='fas fa-edit'></i> Editar
                            </button>
                            <button class='eliminar' onclick='eliminarCliente(\"" . $cliente['cedula'] . "\")'>
                                <i class='fas fa-trash-alt'></i> Eliminar
                            </button>
                          </td>"; // Botones con iconos
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No se encontraron clientes.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>

        function editarCliente(cedula) {
            window.location.href = "editarCliente.php?cedula=" + cedula;
        }

        function eliminarCliente(cedula) {
            if (confirm("¿Estás seguro de eliminar este cliente?")) {
                window.location.href = "eliminarCliente.php?cedula=" + cedula;
            }
        }

        function recargarDatos() {
            window.location.reload();
        // Función para recargar los datos
        function recargarDatos() {
            window.location.reload(); // Recarga la página

        }

        // Función para manejar la acción de editar
        function editarCliente(cedula) {
            // Redirige a la página de edición pasando la cédula como parámetro
            window.location.href = 'editarCliente.php?cedula=' + cedula;
        }

        // Función para manejar la acción de eliminar
        function eliminarCliente(cedula) {
            // Preguntar al usuario si está seguro de eliminar
            if (confirm('¿Estás seguro de eliminar este cliente?')) {
                // Enviar una solicitud para eliminar el cliente
                window.location.href = 'eliminarCliente.php?cedula=' + cedula;
            }
        }
    </script>
</body>
</html>
