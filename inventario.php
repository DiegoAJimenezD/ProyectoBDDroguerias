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
            <li><a href="cliente.php">Clientes</a></li>
            <li><a href="empleado.php">Empleados</a></li>
            <li><a href="sucursal.php">Sucursales</a></li>
            <li><a href="producto.php">Productos</a></li>
            <li><a href="inventario.php">Inventario</a></li>
            <li><a href="proveedor.php">Proveedores</a></li>
            <li><a href="pedido.php">Pedidos</a></li>
            <li><a href="venta.php">Ventas</a></li>
        </ul>
    </nav>
    </header>
    <button onclick="recargarDatos()">Recargar Datos</button>
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
            <!-- Datos a cargar dinámicamente -->
        </tbody>
    </table>
</body>
</html>
