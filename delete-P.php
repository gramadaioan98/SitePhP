<?php
session_start();
require __DIR__.'/db-connection.php';
if(!empty($_POST['id']) && $_SESSION['admin']==1){
    $id=$_POST['id'];
$querry="DELETE FROM products WHERE  idP='{$id}'";
 
   $conn->query($querry);
}

header('Location:Market.php')

// var_dump($_SESSION);
// echo $_SESSION['admin'];
?>