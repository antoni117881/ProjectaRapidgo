<?php
include $_SERVER['DOCUMENT_ROOT'] . '/ProjectaRapidgo/Vista/pagoView.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $monto = $_POST['monto'] ?? 0;
    $metodo = $_POST['metodo'] ?? '';
    
    $pago = new PagoView();
    $resultado = $pago->procesarPago($monto, $metodo);
    
    PagoView::mostrarResultado($resultado);
} else {
    PagoView::mostrarFormulario();
}

?>
