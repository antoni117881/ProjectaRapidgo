<?php
session_start();

// Inicializar el carrito si no existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Agregar producto al carrito
if (isset($_POST['agregar'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $imagen = $_POST['imagen'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];

    // Si el producto ya está en el carrito, solo suma la cantidad
    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
    } else {
        $_SESSION['carrito'][$id] = [
            'nombre' => $nombre,
            'imagen' => $imagen,
            'cantidad' => $cantidad,
            'precio' => $precio
        ];
    }
    header('Location: VistaCarrito.php');
    exit();
}

// Eliminar producto del carrito
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    unset($_SESSION['carrito'][$id]);
    header('Location: VistaCarrito.php');
    exit();
}

// Vaciar carrito
if (isset($_GET['vaciar'])) {
    $_SESSION['carrito'] = [];
    header('Location: VistaCarrito.php');
    exit();
}

// Aquí podrías agregar la lógica de "pagar" (por ejemplo, guardar en la base de datos)
?>
