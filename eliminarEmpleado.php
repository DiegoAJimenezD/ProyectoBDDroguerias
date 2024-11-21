<?php
// Conexión a la base de datos
include('conexion.php');

// Verificar si se pasa un ID de empleado en la URL
if (isset($_GET['idEmpleado'])) {
    $idEmpleado = $_GET['idEmpleado'];

    // Primero, actualizar el estado del empleado a eliminado (soft delete)
    $sqlActualizarEmpleado = "UPDATE empleado SET eliminado = 1 WHERE idEmpleado = ?";
    $stmt = $conn->prepare($sqlActualizarEmpleado);
    $stmt->bind_param("i", $idEmpleado);

    if ($stmt->execute()) {
        // Mostrar un mensaje de éxito
        echo '<div id="successMessage" class="toast success">Empleado marcado como eliminado correctamente.</div>';
        // Redirigir después de un breve retardo para que se vea la alerta
        echo '<script>
                setTimeout(function() {
                    window.location.href = "empleado.php";
                }, 3000); // Redirigir después de 3 segundos
              </script>';
    } else {
        echo '<div id="errorMessage" class="toast error">Error al marcar el empleado como eliminado.</div>';
    }
} else {
    echo "<p>ID de empleado no proporcionado.</p>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleado Eliminado - Droguerías Comfenalco</title>
    <link rel="stylesheet" href="css/stylesEditarC.css">
    <style>
        /* Estilo para el panel de alerta (toast) */
        .toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 16px;
            border-radius: 5px;
            font-size: 16px;
            z-index: 9999;
            opacity: 0;
            transform: translateY(-50px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        /* Estilo para la alerta de éxito */
        .toast.success {
            background-color: #4CAF50; /* Verde para éxito */
        }

        /* Estilo para la alerta de error */
        .toast.error {
            background-color: #f44336; /* Rojo para error */
        }

        /* Mostrar el toast */
        .toast.show {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

<script>
    // Mostrar el mensaje de éxito con un pequeño retardo para que se vea
    window.onload = function() {
        const successMessage = document.getElementById('successMessage');
        const errorMessage = document.getElementById('errorMessage');

        if (successMessage) {
            successMessage.classList.add('show');
        } else if (errorMessage) {
            errorMessage.classList.add('show');
        }
    };
</script>

</body>
</html>