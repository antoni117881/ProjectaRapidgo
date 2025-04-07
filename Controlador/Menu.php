<?php
require_once __DIR__. '/../Modelo/BDDConection.php';
require_once __DIR__. '/../Modelo/Restaurantes.php';
require_once __DIR__. '/../Modelo/Productoss.php';

$conection = DB::getInstance();


$RestaurantesModelo = new RestaurantesModelo($conection);
$restaurantes = $RestaurantesModelo->RestaurantesInicio();
$ProductoModelo = new ProductoModelo($conection);
$prouctos = $ProductoModelo->obtenerTodosProductos();
