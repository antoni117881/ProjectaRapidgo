<?php
require_once __DIR__. '/../Modelo/Productoss.php';
require_once __DIR__. '/../Modelo/BDDConection.php';
require_once __DIR__. '/../Modelo/Restaurantes.php';

$conection = DB::getInstance();
$productoModelo = new ProductoModelo($conection);
$restauranteModelo = new RestaurantesModelo($conection);

// Obtener el ID del restaurante desde la solicitud POST
$idRestaurante = isset($_POST['idRestaurante']) ? (int)$_POST['idRestaurante'] : 0;

if ($idRestaurante > 0) {
    $productos = $productoModelo->obtenerProductosPorRestaurante($idRestaurante);
    $cantidadProductos = count($productos); // Contar productos encontrados
    if (empty($productos)) {
        echo "No se encontraron productos para este restaurante.<br>";
    }
    $restaurante = $restauranteModelo->obtenerRestauranteId($idRestaurante);
} else {
    die("ID de restaurante no válido.");
}



?>
