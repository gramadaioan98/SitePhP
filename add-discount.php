<?php 
session_start();
require __DIR__.'/db-connection.php';
if($_SESSION['admin']!=1)
{
    header('Location:home.php');
    die();
}
var_dump($_POST);
$discount=$_POST['discount'];
$id_produs=$_POST['id_produs'];
$querry="UPDATE `products` SET `discount` = $discount WHERE `products`.`idP` =$id_produs ";
   $statement=$conn->prepare($querry);
   $statement->execute();
    $_SESSION['discount']='Discount schimbat.';
    header('Location:Reducere_produse.php');

?>