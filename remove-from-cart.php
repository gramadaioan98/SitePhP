<?php
session_start();
include __DIR__ . '/initprod.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    $cart = $_SESSION['cart'];
    
    foreach($cart as $index => $item) {
        if ($item === $id) {
            array_splice($cart, $index, 1);
            break;
        }
    }
    $_SESSION['cart'] = $cart;
    
}

header('Location: shoppingCart.php');
