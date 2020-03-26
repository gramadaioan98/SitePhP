<?php
session_start();
include __DIR__ . '/initprod.php';
include __DIR__.'/helpers.php';


    $id = $_POST['id'];

    if (!isset($_SESSION['cart'])) 
        $_SESSION['cart'] = [];
    
    
    $cart = $_SESSION['cart'];
    
    $cart[] = $id;
    $_SESSION['cart'] = $cart;
    
    printSession() ;

    header('Location:Market.php');



?>