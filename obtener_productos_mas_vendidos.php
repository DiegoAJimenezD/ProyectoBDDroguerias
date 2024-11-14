<?php
// Configura los detalles de conexión a la base de datos
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$base_de_datos = 'drogueriasconfe';

// Conexión a la base de datos
$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(['error' => 'Conexión fallida: ' . $conn->connect_error]));
}

// Consulta SQL para obtener los productos más vendidos
$sql = "SELECT nombre, cantidad_vendida FROM producto ORDER BY cantidad_vendida DESC LIMIT 5"; // Cambia la consulta según tu estructura

$resultado = $conn->query($sql);

// Preparar los datos en formato JSON
$data = [
    'productos' => [],
    'cantidades' => []
];

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $data['productos'][] = $row['nombre'];
        $data['cantidades'][] = $row['cantidad_vendida'];
    }
}

// Enviar los datos como JSON
header('Content-Type: application/json');
echo json_encode($data);

// Cerrar la conexión
$conn->close();
?>