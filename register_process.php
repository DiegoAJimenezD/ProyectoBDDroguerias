<?php
// Incluir la conexión a la base de datos
include 'conexion.php';

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener y sanitizar los datos del formulario
    $cedula = $_POST['cedula'];
    $primer_nombre = $_POST['primer_nombre'];
    $segundo_nombre = $_POST['segundo_nombre'];
    $primer_apellido = $_POST['primer_apellido'];
    $segundo_apellido = $_POST['segundo_apellido'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $contrasena = $_POST['password'];
    
    // Opcional: Puedes encriptar la contraseña
    // $contrasena = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Verificar si el email o la cédula ya existen en la base de datos
    $check_sql = "SELECT * FROM cliente WHERE email = '$email' OR cedula = '$cedula'";
    $result_check = $conn->query($check_sql);

    if ($result_check->num_rows > 0) {
        // Si existe un registro con el mismo email o cédula, muestra un mensaje de error
        echo "<script>alert('El correo o cédula ya están registrados.'); window.location.href = 'registro.php';</script>";
    } else {
        // Insertar el nuevo cliente en la base de datos
        $insert_sql = "INSERT INTO cliente (cedula, primernombre, segundonombre, primerApellido, segundoApellido, fechaNacimiento, direccion, email, contrasena) 
                       VALUES ('$cedula', '$primer_nombre', '$segundo_nombre', '$primer_apellido', '$segundo_apellido', '$fecha_nacimiento', '$direccion', '$email', '$contrasena')";
        
        if ($conn->query($insert_sql) === TRUE) {
            // Registro exitoso, redirigir a la página de inicio de sesión
            echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.'); window.location.href = 'login.php';</script>";
        } else {
            // Error al registrar
            echo "<script>alert('Error al registrar el usuario. Inténtalo de nuevo.'); window.location.href = 'registro.php';</script>";
        }
    }
}

// Cerrar conexión
$conn->close();
?>
