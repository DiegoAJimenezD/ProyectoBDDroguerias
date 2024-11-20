<?php
// Conexión a la base de datos
include('conexion.php');

// Verificar si se pasa un ID de producto en la URL
if (isset($_GET['idInventario'])) {
    $idInventario = $_GET['idInventario'];

    // Primero, actualizar el estado del producto a eliminado (soft delete)
    $sqlActualizarInventario = "UPDATE inventario SET eliminado = 1 WHERE idInventario = ?";
    $stmt = $conn->prepare($sqlActualizarInventario);
    $stmt->bind_param("i", $idInventario);

    if ($stmt->execute()) {
        echo "Inventario marcado como eliminado correctamente.";
        // Redirigir a la página de productos después de la eliminación exitosa
        header("Location: inventario.php");
        exit; // Detener la ejecución después de la redirección
    } else {
        echo "Error al marcar el inventario como eliminado: " . $stmt->error;
    }
} else {
    echo "<p>ID de inventario no proporcionado.</p>";
}
?>