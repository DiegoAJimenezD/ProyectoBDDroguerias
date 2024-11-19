<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drogueriasconfe";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se pasa un ID de empleado en la URL
if (isset($_GET['id'])) {
    $idEmpleado = $_GET['id'];

    // Eliminar el empleado con el ID proporcionado
    $sql = "DELETE FROM empleado WHERE idEmpleado = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idEmpleado);

    if ($stmt->execute()) {
        // Redirigir a la página empleado.php después de la eliminación exitosa
        header("Location: empleado.php");
        exit; // Detener la ejecución después de la redirección
    } else {
        echo "<p>Error al eliminar el empleado: " . $stmt->error . "</p>";
    }
} else {
    echo "<p>ID de empleado no proporcionado.</p>";
}

// Cerrar la conexión
$conn->close();
?>
