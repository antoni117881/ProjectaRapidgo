<?php
// Asumimos que Cesta.php está en una ruta accesible, por ejemplo, ../model/Cesta.php
// Ajusta la ruta según tu estructura de directorios.
require_once __DIR__ . '/../Modelo/cestamodelo.php'; // O la ruta correcta

// Obtener los productos del carrito
$cartItems = getCartItems(); // Esta es la nueva función

// Si se recibe una acción de eliminar (para procesar antes de mostrar)
// Esto es un ejemplo simplificado. Idealmente, esto se manejaría en un controlador
// o a través de una petición AJAX como la de añadir.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'remove' && isset($_POST['product_id'])) {
    removeFromCart($_POST['product_id']);
    // Redirigir para evitar reenvío del formulario al recargar
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f6fa;
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 30px;
    }

    #cart-list {
        list-style: none;
        padding: 0;
        max-width: 600px;
        margin: 0 auto;
    }

    #cart-list li {
        background-color: #ffffff;
        padding: 15px 20px;
        margin-bottom: 12px;
        border: 1px solid #ddd;
        border-radius: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .btn-Agregar {
        background-color: #e74c3c;
        color: #fff;
        border: none;
        padding: 8px 14px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-Agregar:hover {
        background-color: #c0392b;
    }

    p {
        text-align: center;
        margin-top: 30px;
        font-size: 16px;
    }

    a {
        color: #2980b9;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
<head>
    <title>Cesta de Compras</title>
    <script>
    // La función removeProduct de JavaScript debería hacer una llamada AJAX
    // similar a addToCart para una mejor UX, en lugar de un envío de formulario.
    // Pero si se mantiene el envío de formulario, el PHP de arriba lo manejaría.
    // Por ahora, voy a modificar el botón para que envíe un formulario POST simple.
    function submitRemoveForm(productId) {
        const form = document.getElementById('remove-form-' + productId);
        if (form) {
            form.submit();
        }
    }
    </script>
</head>
<header>
<?php include __DIR__ . "/../Vista/Vistaheader.php"; ?>
</header>
<body>
    <?php
    // Asumo que header.php existe en el mismo directorio que esta vista
    // o ajusta la ruta.
    // include __DIR__. "/header.php";
    echo "<!-- Incluyendo header (simulado) -->";
    ?>
    <h1>Cesta de Compras</h1>
    <ul id="cart-list">
        <?php if (!empty($cartItems)): ?>
            <?php foreach ($cartItems as $productId): ?>
                <li id="product-<?= htmlspecialchars($productId) ?>">
                    Producto ID: <?= htmlspecialchars($productId) ?>
                    
                    <!-- Formulario para eliminar (POST para evitar problemas con GET y re-ejecución) -->
                    <button onclick="removeFromCart(<?php echo $productId; ?>)" class="btn-Agregar">borrar producto</button>
                    
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>La cesta está vacía.</li>
        <?php endif; ?>
    </ul>

    <p><a href="index.php">Seguir comprando</a></p> <!-- Ejemplo de enlace para volver a la tienda -->

    <script>
function removeFromCart(productId) {    
    $.ajax({
        type: "POST",
        url: "?action=borrarcarrito",
        data: { "id_producto": productId },
        success: function(data) {
            console.log(data); // Asegúrate de que la respuesta se esté mostrando en la consola
            location.reload();

        },
        error: function(xhr) {
            alert('Error en la solicitud: ' + xhr.status);
        }
    });
}
</script>
<script
  src="https://code.jquery.com/jquery-3.7.1.js"
  integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
  crossorigin="anonymous"></script>
</body>
</html>
