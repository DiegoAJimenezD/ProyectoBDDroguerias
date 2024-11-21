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

  <!-- Estilo CSS para centrar el título -->
<style>
    h2 {
        text-align: center;
    }
</style>

<!-- Título de la tabla -->
<h2>Consulta Faciles</h2>

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
            <td>Reporte Estado Factura</td>
            <td>
               <button onclick="window.location.href='estadosFacturas.php';">
            <i class="fas fa-file-alt"></i> Generar Reporte
            </button>
            </td>
        </tr>
        <tr>
            <td>Reporte Poco Stock</td>
            <td>
            <button onclick="window.location.href='inventarioLowStock.php';">
            <i class="fas fa-file-alt"></i> Generar Reporte
            </button>
            </td>
        </tr>
        <tr>
            <td>Reporte Stock Productos</td>
            <td>
            <button onclick="window.location.href='estadisticasStock.php';">
            <i class="fas fa-file-alt"></i> Generar Reporte
            </button>
            </td>
        </tr>
    </tbody>
</table>


  <!-- Estilo CSS para centrar el título -->
<style>
    h2 {
        text-align: center;
    }
</style>

<!-- Título de la tabla -->
<h2>Consulta Intermedias</h2>

<!-- Tabla de reportes -->
<table>
    <thead>
        <tr>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    
    <td>Reporte de Clientes</td>
                <td>
                    <button onclick="window.location.href='reporte_cliente.php'">
                        <i class="fas fa-file-alt"></i> Generar Reporte
                     </button>
                </td>
        <tr>
            <td>Reporte Poco Stock</td>
            <td>
            <button onclick="window.location.href='inventarioLowStock.php';">
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
       
        <td>Reporte de Proveedores</td>
                <td>
                    <button onclick="window.location.href='reporte_proveedores.php'">
                        <i class="fas fa-file-alt"></i> Generar Reporte
                     </button>
                </td>
    </tbody>
</table>


   <!-- Estilo CSS para centrar el título -->
<style>
    h2 {
        text-align: center;
    }
</style>

<!-- Título de la tabla -->
<h2>Consulta Avanzadas</h2>

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
            <td>Reporte de cliente con compra mayor al promedio</td>
                <td>
                    <button onclick="window.location.href='reporte_cliente_avanzado.php'">
                        <i class="fas fa-file-alt"></i> Generar Reporte
                     </button>
                </td>
        </tr>
        <tr>
            <td>Productos con ventas superiores al promedio de su categoría</td>
                <td>
                    <button onclick="window.location.href='reporte_producto_avanzado.php'">
                        <i class="fas fa-file-alt"></i> Generar Reporte
                     </button>
                </td>
        </tr>
        <tr>
            <td>Reporte de clientes con subsidios y sus compras</td>
            <td>
                <button onclick="window.location.href='subsidio_reporte_avanzada.php'">
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
