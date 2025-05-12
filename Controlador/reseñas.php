<?php
require_once __DIR__. '/../Modelo/BDDConection.php';
require_once __DIR__.'/../Modelo/Reseñas.php';

// Obtener la instancia de la conexión a la base de datos
$db = DB::getInstance();

// Crear una instancia del modelo de reseñas


if (isset($_POST['idRestaurante'])) {
    $idRestaurante = $_POST['idRestaurante'];
    $reseñas = obtenerReseñasPorId($idRestaurante ,$db);
    
    if ($reseñas) {
        // Incluir la vista y pasar las reseñas
        include __DIR__.'/../Vista/reseñas_vista.php';
        } else {
            echo "No se encontraron reseñas.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreRestaurante = $_POST['nombre_restaurante'];
    $descripcion = $_POST['descripcion'];
    $estrellas = $_POST['estrellas'];

    // Agregar la reseña
    if (agregarReseña($nombreRestaurante, $descripcion, $estrellas, $db)) {
        echo "Reseña agregada exitosamente.";
    } else {
        echo "Error al agregar la reseña. Asegúrate de que el nombre del restaurante sea correcto.";
    }
}
