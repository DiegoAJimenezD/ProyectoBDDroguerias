<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generar Reportes</title>
    <link rel="stylesheet" href="css/stylesListas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        td button {
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            background-color: #316bff;
            color: white;
            border: none;
            border-radius: 5px;
            display: block;
            margin: 0 auto;  /* Centra el botón en la celda */
        }
        td button:hover {
            background-color: #22449c;
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>Generar Reportes</h1>
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

    <!-- Tabla de reportes -->
    <table>
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Reporte de Productos</td>
                <td>
                    <button onclick="generarReporte('productos')">
                        <i class="fas fa-file-alt"></i> Generar Reporte
                    </button>
                </td>
            </tr>
            <tr>
                <td>Reporte de Proveedores</td>
                <td>
                    <button onclick="generarReporte('proveedores')">
                        <i class="fas fa-file-alt"></i> Generar Reporte
                    </button>
                </td>
            </tr>
            <tr>
                <td>Reporte de Inventario</td>
                <td>
                    <button onclick="generarReporte('inventario')">
                        <i class="fas fa-file-alt"></i> Generar Reporte
                    </button>
                </td>
            </tr>
            <tr>
                <td>Reporte de Proveedores</td>
                <td>
                    <button onclick="generarReporte('proveedores')">
                        <i class="fas fa-file-alt"></i> Generar Reporte
                    </button>
                </td>
            </tr>
            <tr>
                <td>Reporte de Proveedores</td>
                <td>
                    <button onclick="generarReporte('proveedores')">
                        <i class="fas fa-file-alt"></i> Generar Reporte
                    </button>
                </td>
            </tr>
            <tr>
                <td>Reporte de Proveedores</td>
                <td>
                    <button onclick="generarReporte('proveedores')">
                        <i class="fas fa-file-alt"></i> Generar Reporte
                    </button>
                </td>
            </tr>
            <tr>
                <td>Reporte de Proveedores</td>
                <td>
                    <button onclick="generarReporte('proveedores')">
                        <i class="fas fa-file-alt"></i> Generar Reporte
                    </button>
                </td>
            </tr>
            <tr>
                <td>Reporte de Proveedores</td>
                <td>
                    <button onclick="generarReporte('proveedores')">
                        <i class="fas fa-file-alt"></i> Generar Reporte
                    </button>
                </td>
            </tr>
            <tr>
                <td>Reporte de Proveedores</td>
                <td>
                    <button onclick="generarReporte('proveedores')">
                        <i class="fas fa-file-alt"></i> Generar Reporte
                    </button>
                </td>
            </tr>
            <tr>
                <td>Reporte de Proveedores</td>
                <td>
                    <button onclick="generarReporte('proveedores')">
                        <i class="fas fa-file-alt"></i> Generar Reporte
                    </button>
                </td>
            </tr>
        </tbody>
    </table>

    <script>
        function generarReporte(tipo) {
            alert("Generando reporte de: " + tipo);
            // Aquí puedes agregar la lógica para generar el reporte
            // Redirigir a una página de generación de reporte, por ejemplo:
            // window.location.href = "generarReporte.php?tipo=" + tipo;
        }
    </script>
</body>
</html>