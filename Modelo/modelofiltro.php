<?php
class filtroModelo {
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
public function obtenerTodasCategorias() {
        try {
            $consulta = $this->db->prepare("SELECT  * FROM categorias");
            $consulta->execute();
            return $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en obtenerTodosProductos: " . $e->getMessage());
            return false;
        }
    }
}