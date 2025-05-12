<?php
require_once __DIR__ . '/../Modelo/cestamodelo.php';

function getCartItems() {
    if (isset($_COOKIE['cart'])) {
        $cart = json_decode($_COOKIE['cart'], true);
        var_dump($cart);
        if (is_array($cart)) {
            return $cart;
        }
    }
    return [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);
    $productId = $_POST['ID'];
    if (isset($productId)) {
        addToCart($productId);
    }
}
?>
