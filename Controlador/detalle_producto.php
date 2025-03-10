<?php

$idProducto = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($idProducto > 0) {
    $producto = $productoModelo->obtenerProductoPorId($idProducto);
} else {
    die("ID de producto no válido.");
} 