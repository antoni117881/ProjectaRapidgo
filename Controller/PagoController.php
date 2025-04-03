<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $monto = $_POST['monto'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $metodo = $_POST['metodo'];

    // Validaciones básicas
    if (empty($monto) || empty($nombre) || empty($correo) || empty($metodo)) {
        echo "Todos los campos obligatorios deben llenarse.";
        exit();
    }

    // Simulación del procesamiento de pago
    $mensaje = "Pago de $monto € realizado con éxito mediante $metodo.";

    // Si el método es tarjeta, validar datos extra
    if ($metodo == "tarjeta") {
        $numero = $_POST['numero'];
        $vencimiento = $_POST['vencimiento'];
        $cvv = $_POST['cvv'];

        if (empty($numero) || empty($vencimiento) || empty($cvv)) {
            echo "Debe completar los datos de la tarjeta.";
            exit();
        }

        // Simulación de validación de tarjeta
        if (strlen($cvv) != 3 || !is_numeric($cvv)) {
            echo "CVV inválido.";
            exit();
        }

        $mensaje .= " Tarjeta terminada en " . substr($numero, -4) . ".";
    }

    echo "<h2>$mensaje</h2>";
    echo "<a href='../Vista/pagoView.php'>Volver</a>";
}
?>
