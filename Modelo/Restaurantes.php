<?php
class RestaurantesModelo {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerTodosRestaurantes() {
        try {
            $consulta = $this->db->prepare("SELECT DISTINCT * FROM restaurantes");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerTodosRestaurantes " . $e->getMessage());
            return false;
        }
    }

    public function obtenerRestauranteId() {
        try {
            $consulta = $this->db->prepare("SELECT * FROM restaurantes WHERE ID = :id");
            $consulta->bindParam(':id', $id, PDO::PARAM_INT);
            $consulta->execute();
            print($consulta->fetch(PDO::FETCH_ASSOC));
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerRestauranteId: " . $e->getMessage());
            return false;
        }
    }

    public function RestaurantesInicio() {
        return $this->obtenerTodosRestaurantes();//logica de obtener restauranetes
        return $this->obtenerRestauranteId($id); // logica de restaurantes por id
    }
}