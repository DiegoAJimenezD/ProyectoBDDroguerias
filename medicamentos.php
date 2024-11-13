<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicamentos - Droquerías Comfenalco</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <header class="header">
        <h1>Medicamentos</h1>
        <p>Encuentra los mejores medicamentos para tu salud.</p>
    </header>
    
    <nav class="navbar">
        <div class="navbar-container">
            <a href="index.php" class="navbar-brand">
                <img src="images/logo.png" alt="Logo Droquerías Comfenalco" class="navbar-logo">
            </a>
            <ul class="navbar-nav">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="productos.php">Productos</a></li>
                <li><a href="login.php">Iniciar sesión</a></li>
                <li><a href="registro.php">Registrarse</a></li>
            </ul>
        </div>
    </nav>

    <?php
    include 'componentes\navbar.php';
    ?>


    <section class="banner">
        <p>¡Recupera tu bienestar con nuestros medicamentos de calidad!</p>
    </section>
    

<div class="container my-4">
    <h2 class="text-center">Productos de Medicamentos</h2>
    <div class="product-container">
        <div class="product">
            <img src="vitamina1.jpg" alt="Vitamina C">
            <h5>Vitamina C</h5>
            <p>$15,000</p>
            <button>Comprar</button>
        </div>
        <div class="product">
            <img src="vitamina2.jpg" alt="Multivitamínico">
            <h5>Multivitamínico</h5>
            <p>$25,000</p>
            <button>Comprar</button>
        </div>
        <div class="product">
            <img src="vitamina3.jpg" alt="Vitamina D">
            <h5>Vitamina D</h5>
            <p>$20,000</p>
            <button>Comprar</button>
        </div>
    </div>
</div>

<?php
include 'componentes\footer.php';
?>

</body>
</html>