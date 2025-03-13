<?php

include $_SERVER['DOCUMENT_ROOT'] . '/ProjectaRapidgo/Model/pagoModel.php';
include '../Vista/PagoView.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $monto = $_POST['monto'] ?? 0;
    $metodo = $_POST['metodo'] ?? '';
    
    $pago = new PagoModel();
    $resultado = $pago->procesarPago($monto, $metodo);
    
    PagoView::mostrarResultado($resultado);
} else {
    PagoView::mostrarFormulario();
}

?>
