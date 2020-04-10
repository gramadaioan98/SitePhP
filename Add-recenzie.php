<?php 
session_start();
require __DIR__.'/db-connection.php';

var_dump($_GET);

if(empty($_GET))
{
header('Location:home.php');

}

$id=$_GET['id'];
echo $id;
$querry="UPDATE `recenzii` SET `accept` = '1' WHERE `recenzii`.`id_recenzie` =$id;'";
$statement=$conn->prepare($querry);
$statement->execute();

header('location:admin.php')
?>