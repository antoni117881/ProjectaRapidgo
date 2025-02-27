<?php
class ProductoModelo {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }

    public function obtenerTodosProductos() {
        try {
            $consulta = $this->db->prepare("SELECT DISTINCT * FROM productos");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerTodosProductos: " . $e->getMessage());
            return false;
        }
    }

    public function ProductosInicio() {
        return $this->obtenerTodosProductos(); // O cualquier lógica que necesites
    }
}