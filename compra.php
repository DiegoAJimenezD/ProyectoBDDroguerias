<?php
session_start(); // Iniciar la sesión
include('conexion.php');

// Obtener el correo electrónico desde la sesión
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';

// Verificar que el correo electrónico esté disponible
if (!$email) {
    echo "No se ha encontrado el correo electrónico del usuario.";
    exit;
}

// Consultar la cédula del usuario utilizando el correo electrónico
$queryCliente = $conn->prepare("SELECT cedula FROM cliente WHERE email = ?");
$queryCliente->bind_param("s", $email);
$queryCliente->execute();
$resultCliente = $queryCliente->get_result();
$cliente = $resultCliente->fetch_assoc();

// Verificar si el cliente fue encontrado
if (!$cliente) {
    echo "Cliente no encontrado.";
    exit;
}

$cedula = $cliente['cedula'];  // Obtener la cédula

// Obtener el ID del producto desde la URL
$idProducto = isset($_GET['idProducto']) ? intval($_GET['idProducto']) : 0;

// Consultar los detalles del producto
$queryProducto = $conn->prepare("SELECT * FROM producto WHERE idProducto = ?");
$queryProducto->bind_param("i", $idProducto);
$queryProducto->execute();
$resultProducto = $queryProducto->get_result();
$producto = $resultProducto->fetch_assoc();

if (!$producto) {
    echo "Producto no encontrado.";
    exit;
}

// Si se envía el formulario, procesar la compra
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descuento = isset($_POST['descuento']) ? floatval($_POST['descuento']) : 0;
    $metodoPago = isset($_POST['metodoPago']) ? intval($_POST['metodoPago']) : 1;
    $precioProducto = $producto['precio']; // Obtenemos el precio del producto
    $impuesto = $precioProducto * 0.19; // Ejemplo de cálculo de impuesto (19%)
    $precioTotal = $precioProducto - $descuento + $impuesto; // Calculamos el precio total
    $fechaCompra = date('Y-m-d H:i:s'); // Fecha actual de la compra
    $estado = 'PAGADA'; // Estado de la factura (pagada)

    try {
        $conn->begin_transaction();  // Iniciar la transacción

        // Insertar en la tabla `factura` (Ahora con los datos correctos)
        $queryFactura = $conn->prepare("INSERT INTO factura (impuesto, precio, fechaCompra, estado, clienteCedula) VALUES (?, ?, ?, ?, ?)");
        $queryFactura->bind_param("ddsss", $impuesto, $precioTotal, $fechaCompra, $estado, $cedula);  // Insertar valores en los campos
        $queryFactura->execute();
        $idFactura = $conn->insert_id;  // Obtener el ID de la factura recién insertada

        // Verificar si se creó la factura
        if (!$idFactura) {
            throw new Exception("No se pudo crear la factura.");
        }

        // Insertar en la tabla `venta` con el ID de la factura recién creada
        $queryVenta = $conn->prepare("INSERT INTO venta (descuento, metodoPago, idFactura, cedula) VALUES (?, ?, ?, ?)");
        $queryVenta->bind_param("disi", $descuento, $metodoPago, $idFactura, $cedula);  // Vincula los parámetros
        $queryVenta->execute();
        $idVenta = $conn->insert_id;  // Obtener el ID de la venta recién insertada

        // Insertar en la tabla `productofactura`
        $queryProductoFactura = $conn->prepare("INSERT INTO productofactura (idFactura, idProducto) VALUES (?, ?)");
        $queryProductoFactura->bind_param("ii", $idFactura, $idProducto);
        $queryProductoFactura->execute();

        // Actualizar el inventario restando la cantidad vendida
        $cantidadVendida = 1; // Aquí debes determinar cuántas unidades se vendieron, puede venir desde el formulario si es necesario.
        $queryInventario = $conn->prepare("UPDATE inventario SET cantidadStock = cantidadStock - ? WHERE idProducto = ?");
        $queryInventario->bind_param("ii", $cantidadVendida, $idProducto);
        $queryInventario->execute();

        $conn->commit();  // Confirmar la transacción
        header("Location: factura.php?idFactura=$idFactura");
    } catch (Exception $e) {
        $conn->rollback();  // Revertir la transacción en caso de error
        echo "Error al procesar la compra: " . $e->getMessage();
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styleCompra.css">
    <title>Comprar Producto</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Comprar <?= htmlspecialchars($producto['nombre']); ?></h1>
        <form method="POST" class="formulario-compra">
            <label>Precio: <?= number_format($producto['precio'], 2); ?> COP</label><br>
            <label>Descuento:</label>
            <input type="number" name="descuento" step="0.01" min="0" value="0"><br>
            <label>Método de pago:</label>
            <select name="metodoPago">
                <option value="1">Efectivo</option>
                <option value="2">Tarjeta</option>
                <option value="3">Transferencia</option>
            </select><br>
            <label>Cédula del comprador:</label>
            <input type="text" name="cedula" value="<?= htmlspecialchars($cedula); ?>" required><br>
            <button type="submit">Confirmar Compra</button>
        </form>
    </div>
</body>
</html>
