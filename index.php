<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Droquerías Comfenalco</title>
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
        <p>¡Promociones y descuentos en productos seleccionados!</p>
    </section>

    <div class="container">
        <h2 class="text-center">Categorías Principales</h2>
        <div class="category-container">
            <a href="cosmeticos.php" class="card category">
                <img src="images/cosmeticos.png" alt="Cosméticos">
                <p>Cosméticos</p>
            </a>
            <a href="medicamentos.php" class="card category">
                <img src="images/vitaminas.png" alt="Vitaminas y Suplementos">
                <p>Medicamentos</p>
            </a>
            <a href="cuidadoP.php" class="card category">
                <img src="images/cuidadoP.png" alt="Cuidado Personal">
                <p>Cuidado Personal</p>
            </a>
        </div>

        <h2 class="text-center">Productos Destacados</h2>
        <div class="product-container">
            <div class="card product">
                <img src="producto1.jpg" alt="Producto 1">
                <h5>Multivitamínico</h5>
                <p>$20,000</p>
                <button>Comprar</button>
            </div>
            <div class="card product">
                <img src="producto2.jpg" alt="Producto 2">
                <h5>Crema hidratante</h5>
                <p>$15,000</p>
                <button>Comprar</button>
            </div>
            <div class="card product">
                <img src="producto3.jpg" alt="Producto 3">
                <h5>Repelente</h5>
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
