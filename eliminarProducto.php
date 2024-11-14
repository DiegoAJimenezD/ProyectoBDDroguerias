<?php
// Conexión a la base de datos
include('conexion.php');

// Verificar si se pasa un ID de producto en la URL
if (isset($_GET['idProducto'])) {
    $idProducto = $_GET['idProducto'];

    // Primero, actualizar el estado del producto a eliminado (soft delete)
    $sqlActualizarProducto = "UPDATE producto SET eliminado = 1 WHERE idProducto = ?";
    $stmt = $conn->prepare($sqlActualizarProducto);
    $stmt->bind_param("i", $idProducto);

    if ($stmt->execute()) {
        echo "Producto marcado como eliminado correctamente.";
        // Redirigir a la página de productos después de la eliminación exitosa
        header("Location: productos.php");
        exit; // Detener la ejecución después de la redirección
    } else {
        echo "Error al marcar el producto como eliminado: " . $stmt->error;
    }
} else {
    echo "<p>ID de producto no proporcionado.</p>";
}
?>