<?php
session_start();

include __DIR__.'/helpers.php';

if(empty($_POST))
{
header('Location:home.php');
die();
}
    $id = $_POST['id'];

    if (!isset($_SESSION['cart'])) 
        $_SESSION['cart'] = [];
    
    
    $cart = $_SESSION['cart'];
    
    $cart[] = $id;
    $_SESSION['cart'] = $cart;
    
    printSession() ;

    header('Location:Market.php');



?>