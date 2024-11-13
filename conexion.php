<?php
// conexion.php

$servername = "localhost";  // o tu servidor de base de datos
$username = "root";         // tu usuario de MySQL
$password = "";             // tu contraseña de MySQL
$dbname = "drogueriasconfe"; // el nombre de tu base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
