<?php   
require_once 'Controlador/cestacontrolador.php';

// Inicializar $productos como un array vacío si no está definido
$productos = isset($productos) ? $productos : [];
?>
<h2>Tu cesta</h2>
<ul>
    <?php foreach ($productos as $producto): ?>
        <li>
            Producto ID: <?= $producto['producto_id'] ?> - Cantidad: <?= $producto['cantidad'] ?>
            <a href="/cesta/eliminar/<?= $producto['producto_id'] ?>">Eliminar</a>
        </li>
    <?php endforeach; ?>
</ul>
<a href="/cesta/vaciar">Vaciar Cesta</a>
