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
    public function obtenerProductosId($idRestaurante) {
       
        print "hola ";
        try {
            $consulta = $this->db->prepare("SELECT * FROM productos WHERE RestauranteID = :idRestaurante");
            $consulta->bindParam(':id', $idRestaurante, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerRestauranteId: " . $e->getMessage());
            return false;
        }
    }

    public function ProductosInicio() {
        return $this->obtenerTodosProductos(); // O cualquier lógica que necesites
        return $this->obtenerProductosId();
    }

    // Método para obtener productos por ID de restaurante
    public function obtenerProductosPorRestaurante($idRestaurante) {
        try {
            $consulta = $this->db->prepare("SELECT * FROM productos WHERE RestauranteID = :idRestaurante");
            $consulta->bindParam(':idRestaurante', $idRestaurante, PDO::PARAM_INT);
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerProductosPorRestaurante: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerProductoPorId($idProducto) {
        try {
            $consulta = $this->db->prepare("SELECT * FROM productos WHERE ID = :idProducto");
            $consulta->bindParam(':idProducto', $idProducto, PDO::PARAM_INT);
            $consulta->execute();
            
            $producto = $consulta->fetch(PDO::FETCH_ASSOC);
            if (!$producto) {
                error_log("No se encontró el producto con ID: " . $idProducto);
            } else {
                error_log("Producto encontrado: " . print_r($producto, true)); // Para depuración
            }
            return $producto;
        } catch (PDOException $e) {
            error_log("Error en obtenerProductoPorId: " . $e->getMessage());
            return false;
        }
    }
}