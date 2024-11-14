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
    <?php
include 'conexion.php';  // Conexión a la base de datos

// Consulta para obtener los productos de la categoría 'Cosméticos' y su stock
$sql = "SELECT p.idProducto, p.nombre, p.precio, p.imagen, i.cantidadStock 
        FROM producto p
        JOIN categoriaproducto cp ON p.categoriaProducto = cp.idCategoria
        JOIN inventario i ON p.idProducto = i.idProducto
        WHERE cp.nombre = 'Cosméticos'";  // Asegúrate de que el nombre de la categoría sea correcto en la base de datos

$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Mostrar los productos
    while($row = $result->fetch_assoc()) {
        echo '<div class="card product">';
        echo '<img src="' . $row['imagen'] . '" alt="Producto ' . $row['nombre'] . '">';
        echo '<h5>' . $row['nombre'] . '</h5>';
        echo '<p>$' . number_format($row['precio'], 0, ',', '.') . '</p>';
        echo '<p><strong>Stock disponible: ' . $row['cantidadStock'] . '</strong></p>';
        echo '<button>Comprar</button>';
        echo '</div>';
    }
} else {
    echo "<p>No hay productos disponibles en esta categoría.</p>";
}

// Cerrar la conexión
$conn->close();
?>

    </div>
</div>

<?php
include 'componentes\footer.php';
?>

</body>
</html>
