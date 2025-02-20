<?php
require_once __DIR__. '/../Modelo/Productoss.php';
require_once __DIR__. '/../Modelo/BDDConection.php';
$conection = DB::getInstance();

$productoModelo = new ProductoModelo($conection);
$productos = $productoModelo->ProductosInicio();

// No incluyas RegistroMenu.php aquí