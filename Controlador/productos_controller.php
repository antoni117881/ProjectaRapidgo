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
} else {
    die("ID de restaurante no válido.");
}

// Verificar si se ha enviado un ID de producto
$idProducto = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($idProducto > 0) {
    // Filtrar el producto específico
    $productoSeleccionado = array_filter($productos, function($producto) use ($idProducto) {
        return $producto['ID'] === $idProducto;
    });
    
    // Redirigir a la página de registro de producto individual
    header("Location: RegistroProductoIndividual.php?id=" . $idProducto);
    exit();
}

?>
