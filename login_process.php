<?php
session_start(); // Iniciar la sesión
include 'conexion.php';

$email = $_POST['email'];
$contrasena = $_POST['password'];

// Verificar si el usuario es cliente
$sql_cliente = "SELECT * FROM cliente WHERE email = '$email' AND contrasena = '$contrasena'";
$result_cliente = $conn->query($sql_cliente);

if ($result_cliente->num_rows > 0) {
    $cliente = $result_cliente->fetch_assoc();
    $_SESSION['usuario'] = $cliente['primernombre'] . ' ' . $cliente['primerApellido']; // Guardar nombre en la sesión
    $_SESSION['tipo_usuario'] = 'cliente'; // Guardar tipo de usuario en la sesión
    header("Location: index.php");
    exit();
}

// Verificar si el usuario es empleado
$sql_empleado = "SELECT * FROM empleado WHERE email = '$email' AND contrasena = '$contrasena'";
$result_empleado = $conn->query($sql_empleado);

if ($result_empleado->num_rows > 0) {
    $empleado = $result_empleado->fetch_assoc();
    $_SESSION['usuario'] = $empleado['nombre']; // Guardar nombre del empleado en la sesión
    $_SESSION['tipo_usuario'] = 'empleado'; // Guardar tipo de usuario en la sesión
    header("Location: empleado.php");
    exit();
}

// Si no coincide en ninguna tabla
echo "<script>alert('Credenciales incorrectas. Inténtalo de nuevo.'); window.location.href = 'login.php';</script>";

$conn->close();
?>
