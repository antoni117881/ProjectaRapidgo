<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        .pago-form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }
        .pago-form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        .pago-form input[type="number"],
        .pago-form input[type="text"],
        .pago-form input[type="email"],
        .pago-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .pago-form button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .pago-form button:hover {
            background-color: #218838;
        }
        .hidden {
            display: none;
        }
        .resumen-carrito {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .resumen-carrito h3 {
            margin-top: 0;
            color: #333;
        }
        .resumen-carrito p {
            margin: 5px 0;
            color: #666;
        }
    </style>
</head>
<body>
    <?php include 'Vistaheader.php'; ?>

    <?php
    $total = 0;
    if (!empty($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
    }
    ?>

    <div class="resumen-carrito">
        <h3>Resumen del Carrito</h3>
        <p>Total a pagar: $<?php echo number_format($total, 2); ?></p>
    </div>

    <form method="POST" action="/PROJECTARAPIDGO/Controlador/PagoController.php" class="pago-form">
        <h2>Formulario de Pago</h2>
        
        <input type="hidden" name="monto" value="<?php echo $total; ?>">
        
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        
        <label for="correo">Correo Electrónico:</label>
        <input type="email" name="correo" id="correo" required>
        
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" required>
        
        <label for="metodo">Método de Pago:</label>
        <select name="metodo" id="metodo" onchange="mostrarDatosPago()" required>
            <option value="">Seleccione un método</option>
            <option value="tarjeta">Tarjeta de Crédito/Débito</option>
            <option value="paypal">PayPal</option>
            <option value="transferencia">Transferencia Bancaria</option>
        </select>
        
        <div id="datosPagoDiv" class="hidden">
            <label for="numero">Número de Tarjeta:</label>
            <input type="text" name="numero" id="numero" pattern="[0-9]{16}" maxlength="16" placeholder="1234 5678 9012 3456">
            
            <label for="vencimiento">Fecha de Vencimiento:</label>
            <input type="text" name="vencimiento" id="vencimiento" placeholder="MM/AA" pattern="(0[1-9]|1[0-2])\/([0-9]{2})" maxlength="5">
            
            <label for="cvv">CVV:</label>
            <input type="text" name="cvv" id="cvv" pattern="[0-9]{3}" maxlength="3" placeholder="123">
        </div>

        <button type="submit">Pagar $<?php echo number_format($total, 2); ?></button>
    </form>

    <script>
        function mostrarDatosPago() {
            const metodo = document.getElementById("metodo").value;
            const datosPagoDiv = document.getElementById("datosPagoDiv");
            const inputsTarjeta = datosPagoDiv.getElementsByTagName("input");
            
            if (metodo === "tarjeta") {
                datosPagoDiv.classList.remove("hidden");
                for (let input of inputsTarjeta) {
                    input.required = true;
                }
            } else {
                datosPagoDiv.classList.add("hidden");
                for (let input of inputsTarjeta) {
                    input.required = false;
                }
            }
        }
    </script>

    <?php include 'vistafooter.php'; ?>
</body>
</html>