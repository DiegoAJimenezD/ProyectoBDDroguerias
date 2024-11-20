<?php
require 'vendor/autoload.php';  // Carga todas las dependencias de Composer

use Dompdf\Dompdf;
use Dompdf\Options;

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

// Función para convertir la imagen a base64
function imageToBase64($path) {
    $image = file_get_contents($path);
    return 'data:image/png;base64,' . base64_encode($image);
}

// Ruta de la imagen en tu proyecto
$logoBase64 = imageToBase64('images/logo.png');



$conn->close();

// Crear la instancia de DOMPDF
$dompdf = new Dompdf();

// Definir las opciones de DOMPDF
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$dompdf->setOptions($options);



// Incluir los estilos CSS directamente en el HTML
$html = "
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .factura-container {
            width: 60%;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .factura-header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }

        .factura-header .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }

        .factura-content {
            padding: 20px 0;
        }

        .factura-content h2 {
            color: #444;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .factura-content p {
            margin: 5px 0;
            font-size: 16px;
        }

        .factura-footer {
            text-align: center;
            margin-top: 20px;
        }

        .factura-footer button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .factura-footer button:hover {
            background-color: #0056b3;
        }
    </style>

    <div class='factura-container'>
        <header class='factura-header'>
          
            <h1>Factura de Compra</h1>
        </header>
        <div class='factura-content'>
            <h2>Datos de la Factura</h2>
            <p><strong>Número de Factura:</strong> {$factura['idFactura']}</p>
            <p><strong>Fecha de Compra:</strong> {$factura['fechaCompra']}</p>
            <p><strong>Estado:</strong> {$factura['estado']}</p>
            <h2>Cliente</h2>
            <p><strong>Cédula del Cliente:</strong> {$factura['clienteCedula']}</p>
            <p><strong>Email del Cliente:</strong> {$factura['clienteEmail']}</p>
            <h2>Producto</h2>
            <p><strong>Nombre del Producto:</strong> {$factura['productoNombre']}</p>
            <p><strong>Precio del Producto:</strong> \$" . number_format($factura['productoPrecio'], 0, ',', '.') . " COP</p>
            <h2>Totales</h2>
            <p><strong>Impuesto:</strong> \$" . number_format($factura['impuesto'], 0, ',', '.') . " COP</p>
            <p><strong>Precio Total:</strong> \$" . number_format($factura['precio'], 0, ',', '.') . " COP</p>
        </div>
    </div>
";

// Cargar el contenido HTML en DOMPDF
$dompdf->loadHtml($html);

// Configurar el tamaño del papel
$dompdf->setPaper('A4', 'portrait');

// Renderizar el PDF
$dompdf->render();

// Forzar la descarga del archivo PDF
$dompdf->stream("factura_{$factura['idFactura']}.pdf", ["Attachment" => true]);
?>
