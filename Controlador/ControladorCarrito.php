<?php
session_start();

header('Content-Type: application/json');

// Verificar si el carrito existe
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Función para enviar respuesta JSON
function enviarRespuesta($success, $mensaje = '') {
    echo json_encode([
        'success' => $success,
        'mensaje' => $mensaje
    ]);
    exit;
}

// Actualizar cantidad de producto
if (isset($_POST['actualizar_cantidad'])) {
    $id = $_POST['id'];
    $delta = intval($_POST['delta']);
    
    if (isset($_SESSION['carrito'][$id])) {
        $nuevaCantidad = $_SESSION['carrito'][$id]['cantidad'] + $delta;
        
        if ($nuevaCantidad > 0) {
            $_SESSION['carrito'][$id]['cantidad'] = $nuevaCantidad;
            enviarRespuesta(true, 'Cantidad actualizada');
        } else {
            unset($_SESSION['carrito'][$id]);
            enviarRespuesta(true, 'Producto eliminado');
        }
    }
    
    enviarRespuesta(false, 'Producto no encontrado');
}

// Eliminar producto
if (isset($_POST['eliminar_producto'])) {
    $id = $_POST['id'];
    
    if (isset($_SESSION['carrito'][$id])) {
        unset($_SESSION['carrito'][$id]);
        enviarRespuesta(true, 'Producto eliminado');
    }
    
    enviarRespuesta(false, 'Producto no encontrado');
}

// Vaciar carrito
if (isset($_POST['vaciar_carrito'])) {
    $_SESSION['carrito'] = [];
    enviarRespuesta(true, 'Carrito vaciado');
}

// Agregar producto al carrito
if (isset($_POST['add_to_cart'])) {
    $producto_id = $_POST['producto_id'];
    $producto_nombre = $_POST['producto_nombre'];
    $producto_precio = $_POST['producto_precio'];
    $producto_imagen = $_POST['producto_imagen'];
    $cantidad = isset($_POST['cantidad']) ? intval($_POST['cantidad']) : 1;

    // Inicializar el carrito si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Si el producto ya está en el carrito, actualizar la cantidad
    if (isset($_SESSION['carrito'][$producto_id])) {
        $_SESSION['carrito'][$producto_id]['cantidad'] += $cantidad;
    } else {
        // Si no está en el carrito, agregarlo
        $_SESSION['carrito'][$producto_id] = [
            'nombre' => $producto_nombre,
            'precio' => $producto_precio,
            'imagen' => $producto_imagen,
            'cantidad' => $cantidad
        ];
    }

    enviarRespuesta(true, 'Producto agregado al carrito');
}

// Si no se especificó ninguna acción
enviarRespuesta(false, 'Acción no válida');
