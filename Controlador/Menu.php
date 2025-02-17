<?php
require_once __DIR__. '/../Modelo/Productoss.php';
require_once __DIR__. '/../Modelo/BDDConection.php';
$conection = DB::getInstance();

$productoModelo = new ProductoModelo($conection);
$productos = $productoModelo->ProductosInicio();

$rutaMenu = __DIR__ . '/../RegistroMenu.php';
if (file_exists($rutaMenu)) {
    include $rutaMenu;
} else {
    die('Error: No se encuentra el archivo resource_Menu.php');
}