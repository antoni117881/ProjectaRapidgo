<?php

function addToCart($productId) {
    if (!$productId) {
        echo json_encode(["status" => "error", "message" => "ID de producto no válido"]);
        return;
    }

    $cart = isset($_COOKIE['cart']) ? json_decode($_COOKIE['cart'], true) : [];
    if (!in_array($productId, $cart)) {
        $cart[] = $productId;
    }

    setcookie('cart', json_encode($cart), time() + 3600, '/');
    echo json_encode(["status" => "success", "cart" => $cart]);
}
function getCartItems() {
    if (isset($_COOKIE['cart'])) {
        $cart = json_decode($_COOKIE['cart'], true);
        var_dump($cart); // Verifica qué productos se están recuperando
        if (is_array($cart)) {
            return $cart;
        }
    }
    return []; // Asegúrate de devolver un array vacío si no hay productos
}