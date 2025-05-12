<?php

 
function obtenerReseñasPorId($idRestaurante , $con) {
        try {
            $consulta = $con->prepare("SELECT * FROM reseñas WHERE restaurante_id = :idRestaurante");
            $consulta->bindParam(':idRestaurante', $idRestaurante, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerReseñasPorId: " . $e->getMessage());
            return false;
        }
    }

function obtenerIdRestaurantePorNombre($nombreRestaurante, $con) {
    try {
        $consulta = $con->prepare("SELECT id FROM restaurantes WHERE nombre = :nombre");
        $consulta->bindParam(':nombre', $nombreRestaurante, PDO::PARAM_STR);
        $consulta->execute();
        return $consulta->fetchColumn(); // Devuelve el ID del restaurante
    } catch (PDOException $e) {
        error_log("Error en obtenerIdRestaurantePorNombre: " . $e->getMessage());
        return false;
    }
}

function agregarReseña($nombreRestaurante, $descripcion, $estrellas, $con) {
    // Obtener el ID del restaurante
    $idRestaurante = obtenerIdRestaurantePorNombre($nombreRestaurante, $con);
    
    if ($idRestaurante) {
        try {
            // Obtener la fecha actual
            $fechaActual = date('Y-m-d H:i:s'); // Formato de fecha y hora

            $consulta = $con->prepare("INSERT INTO reseñas (descripcion, estrellas, restaurante_id, fecha) VALUES (:descripcion, :estrellas, :restaurante_id, :fecha)");
            $consulta->bindParam(':descripcion', $descripcion, PDO::PARAM_STR);
            $consulta->bindParam(':estrellas', $estrellas, PDO::PARAM_INT);
            $consulta->bindParam(':restaurante_id', $idRestaurante, PDO::PARAM_INT);
            $consulta->bindParam(':fecha', $fechaActual, PDO::PARAM_STR); // Agregar la fecha
            $consulta->execute();
            return true; // Reseña agregada exitosamente
        } catch (PDOException $e) {
            error_log("Error en agregarReseña: " . $e->getMessage());
            return false;
        }
    } else {
        return false; // Restaurante no encontrado
    }
}
