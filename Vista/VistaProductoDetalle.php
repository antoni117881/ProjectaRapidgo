<?php
require_once 'Controlador/RegistroProductoIndividual.php';
?>
<html>
<head>
    <title>Detalles del Producto</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include 'Vista/Vistaheader.php'; 
        echo $producto['ID']; ?>
    </header>
    <main>
        <h1>Detalles del Producto</h1>
        <?php if (isset($producto) && !empty($producto)): ?>
            <div class="producto-detalle">
                <img src="<?php echo $producto['Imagen']; ?>" alt="<?php echo $producto['Nombre']; ?>" width='300px' height='300px'/>
                <h2><?php echo $producto['Nombre']; ?></h2>
                <p><?php echo $producto['Descripcion']; ?></p>
                <p>Precio: $<?php echo number_format($producto['PrecioUnidad'], 2); ?></p>
            </div>
        <?php else: ?>
            <p>Producto no encontrado.</p>
        <?php endif; ?>
    </main>
</body>
</html>