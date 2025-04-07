<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar</title>
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
    </style>
</head>
<body>

    <form method="POST" action="/ProjectaRapidgo/Controlador/PagoController.php" class="pago-form">

        <h2>Formulario de Pago</h2>
        
        <label for="monto">Monto a pagar:</label>
        <input type="number" name="monto" id="monto" required>
        
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>
        
        <label for="correo">Correo Electrónico:</label>
        <input type="email" name="correo" id="correo" required>
        
        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion">
        
        <label for="metodo">Método de Pago:</label>
        <select name="metodo" id="metodo" onchange="mostrarDatosPago()">
            <option value="">Seleccione un método</option>
            <option value="tarjeta">Tarjeta de Crédito/Débito</option>
            <option value="paypal">PayPal</option>
            <option value="transferencia">Transferencia Bancaria</option>
        </select>
        
        <div id="datosPagoDiv" class="hidden">
            <label for="numero">Número de Tarjeta:</label>
            <input type="text" name="numero" id="numero">
            
            <label for="vencimiento">Fecha de Vencimiento:</label>
            <input type="text" name="vencimiento" id="vencimiento" placeholder="MM/AA">
            
            <label for="cvv">CVV:</label>
            <input type="text" name="cvv" id="cvv">
        </div>

        <button type="submit">Pagar</button>
    </form>

    <script>
        function mostrarDatosPago() {
            const metodo = document.getElementById("metodo").value;
            const datosPagoDiv = document.getElementById("datosPagoDiv");
            
            if (metodo === "tarjeta") {
                datosPagoDiv.classList.remove("hidden");
            } else {
                datosPagoDiv.classList.add("hidden");
            }
        }
            
        document.querySelector('.pago-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Previene el envío para verificar datos
        console.log("Formulario enviado con datos:", new FormData(this));
        this.submit(); // Descomenta si quieres permitir el envío después de verificar
    });
 </script>

</body>
</html>