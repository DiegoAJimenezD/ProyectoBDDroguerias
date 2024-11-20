<?php
require 'vendor/autoload.php';  // Carga todas las dependencias de Composer

use Dompdf\Dompdf;
use Dompdf\Options;

include('conexion.php');

// Obtener los filtros o los valores de búsqueda
$cedulaFiltro = isset($_GET['cedula']) ? $_GET['cedula'] : '';
$primernombreFiltro = isset($_GET['primernombre']) ? $_GET['primernombre'] : '';
$segundonombreFiltro = isset($_GET['segundonombre']) ? $_GET['segundonombre'] : '';
$primerapellidoFiltro = isset($_GET['primerapellido']) ? $_GET['primerapellido'] : '';
$segundoapellidoFiltro = isset($_GET['segundoapellido']) ? $_GET['segundoapellido'] : '';
$fechanacimientoFiltro = isset($_GET['fechanacimiento']) ? $_GET['fechanacimiento'] : '';
$emailFiltro = isset($_GET['email']) ? $_GET['email'] : '';

// Consulta a la base de datos con los filtros
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
$clientes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clientes[] = $row;
    }
}

// Cerrar la conexión
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

        .cliente-container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .cliente-header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .cliente-footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 20px;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .cliente-content {
            padding: 20px 0;
        }

        .cliente-content h2 {
            color: #444;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

    </style>

    <div class='cliente-container'>
        <header class='cliente-header'>
            <h1>Clientes Registrados</h1>
        </header>
        <div class='cliente-content'>
            <h2>Lista de Clientes</h2>
            <table>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Fecha de Nacimiento</th>
                </tr>";

foreach ($clientes as $cliente) {
    $html .= "
                <tr>
                    <td>{$cliente['cedula']}</td>
                    <td>{$cliente['primernombre']} {$cliente['segundonombre']}</td>
                    <td>{$cliente['primerapellido']} {$cliente['segundoapellido']}</td>
                    <td>{$cliente['email']}</td>
                    <td>{$cliente['fechanacimiento']}</td>
                </tr>";
}

$html .= "
            </table>
        </div>
    </div>

    <footer class='cliente-footer'>
        <p>Generado por Sistema de Gestión de Clientes - " . date('Y') . "</p>
    </footer>
";

// Cargar el contenido HTML en DOMPDF
$dompdf->loadHtml($html);

// Configurar el tamaño del papel
$dompdf->setPaper('A4', 'portrait');

// Renderizar el PDF
$dompdf->render();

// Forzar la descarga del archivo PDF
$dompdf->stream("clientes.pdf", ["Attachment" => true]);
?>