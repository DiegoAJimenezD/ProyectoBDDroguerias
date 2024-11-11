<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos - Cuidado Personal | Droquerías Comfenalco</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>

    <header class="header">
        <h1>Cuidado Personal</h1>
        <p>Encuentra los mejores productos de cuidado personal</p>
    </header>

    <?php
    include 'componentes\navbar.php';
    ?>

    <section class="banner">
        <p>¡Promociones y descuentos en productos seleccionados!</p>
    </section>

    <div class="container">
        <h2 class="text-center">Productos de Cuidado Personal</h2>

        <div class="product-container">
            <div class="card product">
                <img src="images/cuidado1.jpg" alt="Producto Cuidado Personal 1">
                <h5>Crema Corporal Hidratante</h5>
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
                <img src="images/cuidado3.jpg" alt="Producto Cuidado Personal 3">
                <h5>Loción Calmante</h5>
                <p>$22,000</p>
                <button>Comprar</button>
            </div>
            <div class="card product">
                <img src="images/cuidado4.jpg" alt="Producto Cuidado Personal 4">
                <h5>Desodorante Natural</h5>
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
