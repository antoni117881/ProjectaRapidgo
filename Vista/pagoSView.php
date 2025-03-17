<?php

class PagoView {
    // ... otros métodos ...

    public function procesarPago($monto, $metodo) {
        // Lógica para procesar el pago
        // Retorna el resultado del procesamiento
        return "Pago de $monto procesado con el método $metodo.";
    }

    public static function mostrarResultado($resultado) {
        echo $resultado;
    }

    public static function mostrarFormulario() {
        // Lógica para mostrar el formulario
    }
}
?> 