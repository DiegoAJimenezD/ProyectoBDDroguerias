

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cosméticos - Droquerías Comfenalco</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header class="header">
    <h1>Cosméticos</h1>
    <p>Encuentra los mejores productos de cuidado para tu piel y belleza.</p>
</header>

<?php
include 'componentes\navbar.php';
?>

<section class="banner">
    <h3>¡Descubre nuestros productos cosméticos y disfruta de tu belleza!</h3>
</section>

<div class="container">
    <h2 class="text-center">Productos Cosméticos</h2>
    <div class="product-container">
        <div class="card product">
            <img src="images/crema_hidratante.jpg" alt="Crema Hidratante">
            <h5>Crema Hidratante</h5>
            <p>$25,000</p>
            <button>Comprar</button>
        </div>
        <div class="card product">
            <img src="images/serum_antiarrugas.jpg" alt="Serum Antiarrugas">
            <h5>Serum Antiarrugas</h5>
            <p>$30,000</p>
            <button>Comprar</button>
        </div>
        <div class="card product">
            <img src="images/máscara_pestañas.jpg" alt="Máscara de Pestañas">
            <h5>Máscara de Pestañas</h5>
            <p>$18,000</p>
            <button>Comprar</button>
        </div>
        <div class="card product">
            <img src="images/labial_rojo.jpg" alt="Labial Rojo">
            <h5>Labial Rojo</h5>
            <p>$12,000</p>
            <button>Comprar</button>
        </div>
        <div class="card product">
            <img src="images/crema_antiselulitis.jpg" alt="Crema Anticelulitis">
            <h5>Crema Anticelulitis</h5>
            <p>$22,000</p>
            <button>Comprar</button>
        </div>
        <div class="card product">
            <img src="images/tonico_piel.jpg" alt="Tónico Facial">
            <h5>Tónico Facial</h5>
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
