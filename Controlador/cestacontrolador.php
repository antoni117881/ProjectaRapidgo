<?php
require_once __DIR__ . '/../Modelo/BDDConection.php';

session_start();

class CestaController {
    private $modelo;

    public function __construct($db) {
        $this->modelo = new Cesta($db);
    }

    public function mostrarCesta() {
        if (!isset($_SESSION['usuario_id'])) {
            echo "Debes iniciar sesión para ver la cesta.";
            header("Location: login.php"); // Redirigir a la página de inicio de sesión
            exit();
        }

        $usuario_id = $_SESSION['usuario_id'];
        $productos = $this->modelo->obtenerCesta($usuario_id);

        // Mostrar los productos en la cesta
        if (!empty($productos)) {
            foreach ($productos as $producto) {
                echo "Producto ID: " . $producto['producto_id'] . " - Cantidad: " . $producto['cantidad'] . "<br>";
            }
        } else {
            echo "La cesta está vacía.";
        }
    }

    public function mostrarCesta1() {
        // Simulación de productos en la cesta
        $productos = [
            ['producto_id' => 1, 'cantidad' => 2],
            ['producto_id' => 2, 'cantidad' => 1],
        ];

        foreach ($productos as $producto) {
            echo "Producto ID: " . $producto['producto_id'] . " - Cantidad: " . $producto['cantidad'] . "<br>";
        }
    }
}
?>
