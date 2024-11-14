<?php
// Conexión a la base de datos
include('conexion.php');

// Verificar si se pasa un ID de producto en la URL
if (isset($_GET['idProducto'])) {
    $idProducto = $_GET['idProducto'];

    // Eliminar primero los registros relacionados en la tabla inventario
    $sqlEliminarInventario = "DELETE FROM inventario WHERE idProducto = ?";
    $stmt = $conn->prepare($sqlEliminarInventario);
    $stmt->bind_param("i", $idProducto);

    if ($stmt->execute()) {
        echo "Registros de inventario eliminados correctamente.<br>";
    } else {
        echo "Error al eliminar los registros de inventario: " . $stmt->error;
    }

    // Ahora eliminar el producto
    $sqlEliminarProducto = "DELETE FROM producto WHERE idProducto = ?";
    $stmt2 = $conn->prepare($sqlEliminarProducto);
    $stmt2->bind_param("i", $idProducto);

    if ($stmt2->execute()) {
        echo "Producto eliminado correctamente.";
        // Redirigir a la página de productos después de la eliminación exitosa
        header("Location: productos.php");
        exit; // Detener la ejecución después de la redirección
    } else {
        echo "Error al eliminar el producto: " . $stmt2->error;
    }
} else {
    echo "<p>ID de producto no proporcionado.</p>";
}
?>