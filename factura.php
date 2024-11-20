<?php
require 'vendor/autoload.php';  // Esto carga automáticamente todas las dependencias de Composer

session_start();
include('conexion.php');

// Obtener el ID de la factura desde la URL
$idFactura = isset($_GET['idFactura']) ? intval($_GET['idFactura']) : 0;

// Consultar los datos de la factura
$queryFactura = $conn->prepare("
    SELECT f.idFactura, f.impuesto, f.precio, f.fechaCompra, f.estado,
           c.cedula AS clienteCedula, c.primernombre AS clienteNombre, c.email AS clienteEmail, 
           p.nombre AS productoNombre, p.precio AS productoPrecio
    FROM factura f
    JOIN cliente c ON f.clienteCedula = c.cedula
    JOIN productofactura pf ON f.idFactura = pf.idFactura
    JOIN producto p ON pf.idProducto = p.idProducto
    WHERE f.idFactura = ?
");

$queryFactura->bind_param("i", $idFactura);
$queryFactura->execute();
$resultFactura = $queryFactura->get_result();
$factura = $resultFactura->fetch_assoc();

if (!$factura) {
    echo "Factura no encontrada.";
    exit;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleFactura.css">
    <title>Factura de Compra</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>  <!-- Incluir SweetAlert2 -->
</head>
<body>
    <div class="factura-container">
        <header class="factura-header">
            <img src="images/logo.png" alt="Logo" class="logo">
            <h1>Factura de Compra</h1>
        </header>
        <div class="factura-content">
            <h2>Datos de la Factura</h2>
            <p><strong>Número de Factura:</strong> <?= $factura['idFactura'] ?></p>
            <p><strong>Fecha de Compra:</strong> <?= $factura['fechaCompra'] ?></p>
            <p><strong>Estado:</strong> <?= $factura['estado'] ?></p>

            <h2>Cliente</h2>
            <p><strong>Cédula del Cliente:</strong> <?= htmlspecialchars($factura['clienteCedula'] ?? 'No disponible') ?></p>
            <p><strong>Email del Cliente:</strong> <?= htmlspecialchars($factura['clienteEmail'] ?? 'No disponible') ?></p>
            
            <h2>Producto</h2>
            <p><strong>Nombre del Producto:</strong> <?= htmlspecialchars($factura['productoNombre'] ?? 'No disponible') ?></p>
            <p><strong>Precio del Producto:</strong> $<?= number_format($factura['productoPrecio'] ?? 0, 0, ',', '.') ?> COP</p>

            <h2>Totales</h2>
            <p><strong>Impuesto:</strong> $<?= number_format($factura['impuesto'], 0, ',', '.') ?> COP</p>
            <p><strong>Precio Total:</strong> $<?= number_format($factura['precio'], 0, ',', '.') ?> COP</p>
        </div>
        <footer class="factura-footer">
            <button onclick="location.href='productos.php';">Volver a la Tienda</button>
            
            <!-- Botón de descarga modificado con SweetAlert2 -->
            <button onclick="descargarPDF()">Descargar PDF</button>
        </footer>
    </div>

    <script>
        // Función para mostrar la alerta y redirigir a la descarga del PDF
        function descargarPDF() {
            // Mostrar la alerta de descarga exitosa
            Swal.fire({
                title: '¡Descarga Exitosa!',
                text: 'La factura se ha descargado como PDF.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir al PHP que genera el PDF
                    window.location.href = 'generar_pdf.php?idFactura=<?= $idFactura ?>';
                }
            });
        }
    </script>
</body>
</html>
