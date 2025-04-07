<?php
// Configuración de la base de datos
$servername = "localhost"; // Cambia si tu servidor es diferente
$username = "root";        // Usuario de la base de datos
$password = "";            // Contraseña de la base de datos
$dbname = "rapidgobdd";       // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

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

    // Validación del correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "Correo electrónico inválido.";
        exit();
    }

    // Validación del monto
    if ($monto <= 0 || !is_numeric($monto)) {
        echo "El monto debe ser un número positivo.";
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

        // Insertar los datos en la base de datos
        $stmt = $conn->prepare("INSERT INTO pagos (monto, nombre, correo, direccion, metodo, numero, vencimiento, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("dsssssss", $monto, $nombre, $correo, $direccion, $metodo, $numero, $vencimiento, $cvv);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<h2>Pago procesado con éxito.</h2>";
        } else {
            echo "<h2>Hubo un error al procesar el pago.</h2>";
        }

        $stmt->close();
    } else {
        // Insertar datos sin la información de la tarjeta (si no es tarjeta)
        $stmt = $conn->prepare("INSERT INTO pagos (monto, nombre, correo, direccion, metodo) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("dssss", $monto, $nombre, $correo, $direccion, $metodo);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<h2>Pago procesado con éxito.</h2>";
        } else {
            echo "<h2>Hubo un error al procesar el pago.</h2>";
        }

        $stmt->close();
    }

    // Cerrar la conexión
    $conn->close();

    echo "<a href='../Vista/pago.php'>Volver</a>";
}
?>
