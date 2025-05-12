<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar'])) {
    if (!isset($_POST['nombre'], $_POST['precio'], $_POST['imagen'])) {
        echo json_encode(['success' => false, 'message' => 'Faltan datos para agregar el producto']);
        exit;
    }

    $nombre = trim($_POST['nombre']);
    $precio = floatval($_POST['precio']);
    $imagen = trim($_POST['imagen']);

    if (empty($nombre) || $precio <= 0 || empty($imagen)) {
        echo json_encode(['success' => false, 'message' => 'Datos del producto no válidos']);
        exit;
    }

    $producto = [
        'name' => $nombre,
        'price' => $precio,
        'image' => $imagen,
        'quantity' => 1
    ];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    $productoExistente = false;

    foreach ($_SESSION['carrito'] as &$item) {
        if ($item['name'] === $producto['name']) {
            $item['quantity'] += 1;
            $productoExistente = true;
            break;
        }
    }

    if (!$productoExistente) {
        $_SESSION['carrito'][] = $producto;
    }

    // Responder con el contenido del carrito actualizado
    echo json_encode([
        'success' => true,
        'carrito' => $_SESSION['carrito']
    ]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar'])) {
    $nombreEliminar = trim($_POST['nombre']);

    if (isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = array_filter($_SESSION['carrito'], function ($item) use ($nombreEliminar) {
            return $item['name'] !== $nombreEliminar;
        });
        $_SESSION['carrito'] = array_values($_SESSION['carrito']); // Reindexar el array
    }

    echo json_encode([
        'success' => true,
        'carrito' => $_SESSION['carrito']
    ]);
    exit;
}
?>
