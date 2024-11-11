<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos | Droquerías Comfenalco</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <header class="header">
        <h1>Droquerías Comfenalco</h1>
        <p>Todo lo que necesitas para tu salud y bienestar</p>
    </header>

    <?php
    include 'componentes\navbar.php';
    ?>

    <section class="banner">
        <p>¡Lo que necesitas está aquí! Productos seleccionados con cuidado.</p>
    </section>
    

    <div class="container">
        <h2 class="text-center">Productos Destacados</h2>
        <div class="product-container">
            <div class="card product">
                <img src="images/medicamento1.jpg" alt="Producto Medicamento 1">
                <h5>Multivitamínico</h5>
                <p>$20,000</p>
                <button>Comprar</button>
            </div>
            <div class="card product">
                <img src="images/medicamento2.jpg" alt="Producto Medicamento 2">
                <h5>Antibiótico</h5>
                <p>$15,000</p>
                <button>Comprar</button>
            </div>
            <div class="card product">
                <img src="images/cuidado1.jpg" alt="Producto Cuidado Personal 1">
                <h5>Crema Hidratante</h5>
                <p>$25,000</p>
                <button>Comprar</button>
            </div>
            <div class="card product">
                <img src="images/cuidado2.jpg" alt="Producto Cuidado Personal 2">
                <h5>Shampoo Suave</h5>
                <p>$18,000</p>
                <button>Comprar</button>
            </div>
            <div class="card product">
                <img src="images/cosmetico1.jpg" alt="Producto Cosmético 1">
                <h5>Base de Maquillaje</h5>
                <p>$30,000</p>
                <button>Comprar</button>
            </div>
            <div class="card product">
                <img src="images/cosmetico2.jpg" alt="Producto Cosmético 2">
                <h5>Labial Hidratante</h5>
                <p>$12,000</p>
                <button>Comprar</button>
            </div>
        </div>
    </div>

    <?php
    include 'componentes\footer.php';
    ?>


</body>

</html>
