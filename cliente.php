<?php
// Incluir la conexión a la base de datos
include('conexion.php');

// Realizar la consulta a la base de datos
$sql = "SELECT cedula, primernombre, segundonombre, primerapellido, segundoapellido, fechanacimiento, email FROM cliente";
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

    <button onclick="recargarDatos()">Recargar Datos</button>

    
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
