<?php   
require_once __DIR__ . '/../Controlador/cestacontrolador.php';
?>

<h2>Tu cesta</h2>
<ul>
<?php include 'Vista/Vistaheader.php';  
echo $producto['ID']; ?>
    <?php foreach ($productos as $producto): ?>
        <li>
            Producto ID: <?= $producto['producto_id'] ?> - Cantidad: <?= $producto['cantidad'] ?>
            <a href="/cesta/eliminar/<?= $producto['producto_id'] ?>">Eliminar</a>
        </li>
    <?php endforeach; ?>
</ul>
<a href="/cesta/vaciar">Vaciar Cesta</a>
<?php
// Iniciar sesión si no se ha iniciado previamente
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si ya tienes productos en la cesta, si no, inicialízala
if (!isset($_SESSION['cesta'])) {
    $_SESSION['cesta'] = [];
}

// Lógica para eliminar productos
if (isset($_GET['eliminar'])) {
    $productoId = $_GET['eliminar'];
    // Eliminar el producto de la cesta
    foreach ($_SESSION['cesta'] as $key => $producto) {
        if ($producto['producto_id'] == $productoId) {
            unset($_SESSION['cesta'][$key]);
        }
    }
    // Redirigir a la misma página para evitar el reenvío de formulario
    header("Location: cesta.php");
    exit();
}

// Lógica para vaciar la cesta
if (isset($_GET['vaciar'])) {
    $_SESSION['cesta'] = []; // Vaciar la cesta
    header("Location: cesta.php");
    exit();
}

// Lógica para mostrar productos en la cesta
$productos = $_SESSION['cesta'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cesta de la Compra</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php include 'Vista/Vistaheader.php'; ?>
    </header>

    <main>
        <h2>Tu Cesta</h2>

        <?php if (empty($productos)): ?>
            <p>No tienes productos en tu cesta.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($productos as $producto): ?>
                    <li>
                        Producto ID: <?= $producto['producto_id'] ?> - Cantidad: <?= $producto['cantidad'] ?>
                        <a href="cesta.php?eliminar=<?= $producto['producto_id'] ?>">Eliminar</a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <a href="cesta.php?vaciar=true">Vaciar Cesta</a>
        <?php endif; ?>

        <br>
        <a href="index.php">Volver al catálogo</a>
    </main>
</body>
</html>
