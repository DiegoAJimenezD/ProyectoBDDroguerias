<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="css/stylesAdmin.css">
</head>
<body>
    <header>
        <h1>Panel de Administración</h1>
    </header>

    <main>
        <section id="clientes">
            <img src="images/clientes.png" alt="Clientes">
            <h2>Clientes</h2>
            <button onclick="window.location.href='cliente.php';">Administrar Clientes</button>

        </section>

        <section id="empleados">
            <img src="images/empleados.png" alt="Empleados">
            <h2>Empleados</h2>
            <button onclick="window.location.href='empleado.php';">Administrar Empleados</button>
        </section>

        <section id="sucursales">
            <img src="images/sucursales.png" alt="Sucursales">
            <h2>Sucursales</h2>
            <button onclick="window.location.href='sucursal.php';">Administrar Sucursales</button>
        </section>

        <section id="productos">
            <img src="images/productos.png" alt="Productos">
            <h2>Productos</h2>
            <button onclick="window.location.href='producto.php';">Administrar Productos</button>
        </section>

        <section id="inventario">
            <img src="images/inventario.png" alt="Inventario">
            <h2>Inventario</h2>
            <button onclick="window.location.href='inventario.php';">Gestionar Inventario</button>
        </section>

        <section id="proveedores">
            <img src="images/proveedores.png" alt="Proveedores">
            <h2>Proveedores</h2>
            <button onclick="window.location.href='proveedor.php';">Administrar Proveedores</button>
        </section>

        <section id="pedidos">
            <img src="images/pedidos.png" alt="Pedidos">
            <h2>Pedidos</h2>
            <button onclick="window.location.href='pedido.php';">Administrar Pedidos</button>
        </section>

        <section id="ventas">
            <img src="images/ventas.png" alt="Ventas">
            <h2>Ventas</h2>
            <button onclick="window.location.href='venta.php';">Gestionar Ventas</button>
        </section>

        <section id="Cerra sesion">
            <img src="images/ventas.png" alt="Cerrar sesion">
            <h2>Cerrar Sesion</h2>
            <button onclick="window.location.href='logout.php';">Cerrar Sesion</button>
        </section>


    </main>


    <script src="scripts.js"></script>
</body>
</html>
