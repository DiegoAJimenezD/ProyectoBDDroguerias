<?php
// Conexión a la base de datos
include('conexion.php');

// Verificar si se pasa un ID de producto en la URL
if (isset($_GET['idEmpleado'])) {
    $idEmpleado = $_GET['idEmpleado'];

    // Primero, actualizar el estado del producto a eliminado (soft delete)
    $sqlActualizarEmpleado = "UPDATE empleado SET eliminado = 1 WHERE idEmpleado = ?";
    $stmt = $conn->prepare($sqlActualizarEmpleado);
    $stmt->bind_param("i", $idEmpleado);

    if ($stmt->execute()) {
        echo "Producto marcado como eliminado correctamente.";
        // Redirigir a la página de productos después de la eliminación exitosa
        header("Location: empleado.php");
        exit; // Detener la ejecución después de la redirección
    } else {
        echo "Error al marcar el empleado como eliminado: " . $stmt->error;
    }
} else {
    echo "<p>ID de empleado no proporcionado.</p>";
}
?>