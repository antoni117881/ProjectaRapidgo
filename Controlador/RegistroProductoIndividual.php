<?php
require_once __DIR__. '/../Modelo/Productoss.php';
require_once __DIR__. '/../Modelo/BDDConection.php';

$conection = DB::getInstance();
$productoModelo = new ProductoModelo($conection);

// Obtener el ID del producto desde la solicitud POST
$idProducto = isset($_POST['idProducto']) ? (int)$_POST['idProducto'] : 0;

echo "ID del producto recibido: " . $idProducto . "<br>"; // Para depuración

if ($idProducto > 0) {
    $producto = $productoModelo->obtenerProductoPorId($idProducto);
    if (!$producto) {
        die("Producto no encontrado. ID buscado: " . $idProducto);
        echo $producto['ID'];
    }
} else {
    die("ID de producto no válido.");
}

?> 