<?php
// Asegúrate de que no haya salida antes de esta línea
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Asegúrate de que la sesión esté iniciada para gestionar el carrito
}

require_once __DIR__. '/../Modelo/Productoss.php';
require_once __DIR__. '/../Modelo/BDDConection.php';

$conection = DB::getInstance();
$productoModelo = new ProductoModelo($conection);

// Obtener el ID del producto desde la solicitud POST
$idProducto = isset($_POST['idProducto']) ? (int)$_POST['idProducto'] : 0;



if (isset($_POST['add_to_cart'])) {
    $producto_id = $_POST['producto_id'];
    $producto_nombre = $_POST['producto_nombre'];
    $producto_precio = $_POST['producto_precio'];
    $producto_imagen = $_POST['producto_imagen'];

    // Inicializa el carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Añade el producto al carrito
    $_SESSION['carrito'][$producto_id] = [
        'nombre' => $producto_nombre,
        'precio' => $producto_precio,
        'imagen' => $producto_imagen,
        'cantidad' => 1 // Puedes ajustar la cantidad según sea necesario
    ];

    // Redirige a la página del carrito
    header('Location: Vistacesta.php');
    exit();
}

if ($idProducto > 0) {
    $producto = $productoModelo->obtenerProductoPorId($idProducto);
    if (!$producto) {
        die("Producto no encontrado. ID buscado: " . $idProducto);
    } else {
        // Aquí deberías añadir el producto a la cesta
         // Asegúrate de que el campo 'nombre' existe
        // Lógica para añadir el producto a la cesta
    }
} else {
    die("ID de producto no válido.");
}

?> 