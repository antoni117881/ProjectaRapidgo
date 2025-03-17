<?php
// Función para mostrar la página de pago
function mostrarPaginaPago() {
    ?>
    <h1>Página de Pago</h1>
    <form action="procesar_pago.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="tarjeta">Número de Tarjeta:</label>
        <input type="text" id="tarjeta" name="tarjeta" required>
        
        <label for="fecha_expiracion">Fecha de Expiración:</label>
        <input type="text" id="fecha_expiracion" name="fecha_expiracion" required placeholder="MM/AA">
        
        <label for="cvv">CVV:</label>
        <input type="text" id="cvv" name="cvv" required>
        
        <button type="submit">Pagar</button>
    </form>
    <?php
}
?>
