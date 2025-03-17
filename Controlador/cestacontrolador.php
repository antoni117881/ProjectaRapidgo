
<?php
require_once 'Modelo/cestamodelo.php';
require_once __DIR__. '/../Modelo/BDDConection.php';
$idprducto = isset($_POST['ID']) ? (int)$_POST['ID'] : 0;
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
        
        }
        public function mostrarCesta1() {
            // Simulación de productos en la cesta
            $productos = [
                ['producto_id' => 1, 'cantidad' => 2],
                ['producto_id' => 2, 'cantidad' => 1],
            ];
    
        }
    
        
    }
