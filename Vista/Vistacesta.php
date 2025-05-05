<?php   
require_once __DIR__ . '/../Controlador/cestacontrolador.php';
include __DIR__ . '/Vistaheader.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cesta'])) {
    $_SESSION['cesta'] = [];
}

// Lógica para eliminar productos
if (isset($_GET['eliminar'])) {
    $productoId = $_GET['eliminar'];
    foreach ($_SESSION['cesta'] as $key => $producto) {
        if ($producto['producto_id'] == $productoId) {
            unset($_SESSION['cesta'][$key]);
            break;
        }
    }
    header("Location: Vistacesta.php");
    exit();
}

// Lógica para vaciar la cesta
if (isset($_GET['vaciar'])) {
    $_SESSION['cesta'] = [];
    header("Location: Vistacesta.php");
    exit();
}

// Lógica para añadir productos
if (isset($_POST['producto_id']) && isset($_POST['cantidad'])) {
    $productoId = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];

    $_SESSION['cesta'][] = [
        'producto_id' => $productoId,
        'cantidad' => $cantidad
    ];

    header("Location: Vistacesta.php");
    exit();
}

$productos = $_SESSION['cesta'];

// Supón que tienes una función para obtener un producto por su ID
function obtenerProductoPorId($id) {
    $conn = new mysqli('localhost', 'root', '', 'rapidgobdd');
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $producto = $resultado->fetch_assoc();
    $conn->close();
    return $producto;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cesta de la Compra</title>
    <link rel="stylesheet" href="../Estilos/style.css">
</head>
<body>
    <main class="cesta-container">
        <h2 class="cesta-titulo">Tu Cesta</h2>

        <?php if (empty($productos)): ?>
            <p class="cesta-vacia">No tienes productos en tu cesta.</p>
        <?php else: ?>
            <ul class="cesta-lista">
                <?php foreach ($productos as $producto): 
                    $infoProducto = obtenerProductoPorId($producto['producto_id']);
                    if (!$infoProducto) {
                        echo "<li class='producto-no-encontrado'>Producto no encontrado (ID: " . htmlspecialchars($producto['producto_id']) . ")</li>";
                        continue;
                    }
                ?>
                    <li class="cesta-item">
                        <span class="cesta-nombre"><?= htmlspecialchars($infoProducto['Nombre'] ?? 'Producto sin nombre') ?></span> - 
                        <span class="cesta-precio"><?= htmlspecialchars($infoProducto['PrecioUnidad'] ?? '0.00') ?> €</span> - 
                        <span class="cesta-cantidad">Cantidad: <?= htmlspecialchars($producto['cantidad']) ?></span>
                        <?php if (!empty($infoProducto['imagen'])): ?>
                            <img class="cesta-img" src="<?= htmlspecialchars($infoProducto['imagen']) ?>" alt="Imagen del producto" width="50">
                        <?php endif; ?>
                        <a href="Vistacesta.php?eliminar=<?= htmlspecialchars($producto['producto_id']) ?>" class="btn-eliminar">Eliminar</a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <a href="Vistacesta.php?vaciar=true" class="btn-vaciar">Vaciar Cesta</a>
        <?php endif; ?>

        <div class="botones-cesta">
            <a href="Vistacatalogo.php" class="btn-volver">Volver al catálogo</a>
            <a href="pago.php" class="btn-pagar">Pagar</a>
        </div>
    </main>
</body>
</html>
