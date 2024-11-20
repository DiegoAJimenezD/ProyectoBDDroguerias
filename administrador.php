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

    <main class="grid-container">
        <section id="empleados" class="grid-item">
            <img src="images/empleados.png" alt="Empleados">
            <h2>Empleados</h2>
            <button onclick="window.location.href='empleado.php';">Administrar Empleados</button>
        </section>

        <section id="productos" class="grid-item">
            <img src="images/productos.png" alt="Productos">
            <h2>Productos</h2>
            <button onclick="window.location.href='producto.php';">Administrar Productos</button>
        </section>

        <section id="proveedores" class="grid-item">
            <img src="images/proveedores.png" alt="Proveedores">
            <h2>Proveedores</h2>
            <button onclick="window.location.href='proveedor.php';">Administrar Proveedores</button>
        </section>

        <section id="inventario" class="grid-item">
            <img src="images/inventario.png" alt="Inventario">
            <h2>Inventario</h2>
            <button onclick="window.location.href='inventario.php';">Gestionar Inventario</button>
        </section>


        <section id="reportes" class="grid-item">
            <img src="images/inventario.png" alt="Reportes">
            <h2>Reportes</h2>
            <button onclick="window.location.href='reportes.php';">Descargar Reportes</button>
        </section>
        
        <section id="cerrar-sesion" class="grid-item">
            <img src="images/logout.png" alt="Cerrar Sesión">
            <h2>Cerrar Sesión</h2>
            <button onclick="window.location.href='logout.php';">Cerrar Sesión</button>
        </section>

        
        <section id="cerrar-sesion" class="grid-item">
            <img src="images/logout.png" alt="Cerrar Sesión">
            <h2>Cerrar Sesión</h2>
            <button onclick="window.location.href='logout.php';">Cerrar Sesión</button>
        </section>

    </main>

    <script src="scripts.js"></script>
</body>
</html>
