<?php 
session_start();
require __DIR__.'/db-connection.php';
var_dump($_GET);
if($_SESSION['admin']!=1)
{

    header('location:home.php');
}
$id=$_GET['id'];
$stock=$_GET['c'];
$querry="SELECT stock  FROM products WHERE idP=$id ";

$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$results=$statement->fetchAll();
$produs=$results;


$totalstock=$produs[0]['stock'];

$totalstock=$totalstock+$stock;

var_dump($produs);
echo $totalstock;

$querry="UPDATE `products` SET `stock` = $totalstock WHERE `products`.`idP` = $id;";
$statement=$conn->prepare($querry);
$statement->execute();


$querry="DELETE FROM `produse_comenzi_anulate` WHERE produs_id=$id";
$statement=$conn->prepare($querry);
$statement->execute();

header('location:Produse_anulate.php');
?>