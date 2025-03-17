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

    public function obtenerRestauranteId($id) {
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

    public function RestaurantesInicio($id = null) {
        if ($id !== null) {
            return $this->obtenerRestauranteId($id); // lógica de restaurantes por id
        }
        return $this->obtenerTodosRestaurantes(); // lógica de obtener restaurantes
    }
}