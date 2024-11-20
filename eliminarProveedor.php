<?php
// Conexión a la base de datos
include('conexion.php');

// Verificar si se pasa un ID de producto en la URL
if (isset($_GET['idProveedor'])) {
    $idProveedor = $_GET['idProveedor'];

    // Primero, actualizar el estado del producto a eliminado (soft delete)
    $sqlActualizarProveedor = "UPDATE proveedor SET eliminado = 1 WHERE idProveedor = ?";
    $stmt = $conn->prepare($sqlActualizarProveedor);
    $stmt->bind_param("i", $idProveedor);

    if ($stmt->execute()) {
        echo "Proveedor marcado como eliminado correctamente.";
        // Redirigir a la página de productos después de la eliminación exitosa
        header("Location: proveedor.php");
        exit; // Detener la ejecución después de la redirección
    } else {
        echo "Error al marcar el proveedor como eliminado: " . $stmt->error;
    }
} else {
    echo "<p>ID de proveedor no proporcionado.</p>";
}
?>