<?php
// Incluir la conexión a la base de datos
include('conexion.php');

// Comprobar si se ha recibido el parámetro 'cedula'
if (isset($_GET['cedula'])) {
    $cedula = $_GET['cedula'];

    // Preparar la consulta para eliminar el cliente
    $sql = "DELETE FROM cliente WHERE cedula = ?";

    // Preparar la sentencia
    if ($stmt = $conn->prepare($sql)) {
        // Vincular la variable con la sentencia preparada
        $stmt->bind_param('s', $cedula); // 's' indica que es una cadena (string)

        // Ejecutar la sentencia
        if ($stmt->execute()) {
            // Redirigir de vuelta a la página de clientes con un mensaje de éxito
            header('Location: cliente.php?mensaje=Cliente eliminado exitosamente');
            exit();
        } else {
            // Si no se puede ejecutar la consulta, redirigir con un mensaje de error
            header('Location: cliente.php?mensaje=Error al eliminar el cliente');
            exit();
        }

        // Cerrar la sentencia
        $stmt->close();
    } else {
        // Si no se pudo preparar la sentencia, redirigir con mensaje de error
        header('Location: cliente.php?mensaje=Error al preparar la consulta');
        exit();
    }
} else {
    // Si no se recibe la cédula, redirigir con mensaje de error
    header('Location: cliente.php?mensaje=No se especificó la cédula');
    exit();
}

// Cerrar la conexión
$conn->close();
?>
