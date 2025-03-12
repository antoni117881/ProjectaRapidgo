<?php
class CestaController {
    private $modelo;

    public function __construct($db) {
        $this->modelo = new Cesta($db);
    }

    public function mostrarCesta($usuario_id) {
        $productos = $this->modelo->obtenerCesta($usuario_id);
        require 'views/cesta.php';
    }

    public function agregar($usuario_id, $producto_id, $cantidad = 1) {
        $this->modelo->agregarProducto($usuario_id, $producto_id, $cantidad);
        header("Location: /cesta");
    }

    public function eliminar($usuario_id, $producto_id) {
        $this->modelo->eliminarProducto($usuario_id, $producto_id);
        header("Location: /cesta");
    }

    public function vaciar($usuario_id) {
        $this->modelo->vaciarCesta($usuario_id);
        header("Location: /cesta");
    }
}
