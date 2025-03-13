
<?php
require_once 'Modelo/cestamodelo.php';
require_once __DIR__. '/../Modelo/BDDConection.php';

class CestaController {
    private $modelo;

    public function __construct($db) {
        $this->modelo = new Cesta($db);
    }

    public function mostrarCesta() {
        session_start();

        if (!isset($_SESSION['usuario_id'])) {
            echo "Debes iniciar sesión para ver la cesta.";
            exit;
        }

        $usuario_id = $_SESSION['usuario_id'];
        $productos = $this->modelo->obtenerCesta($usuario_id);

        require 'Vista/Vistacesta.php'; // Cargar la vista con los productos
    }
}
