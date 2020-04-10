

<?php 

session_start();
require __DIR__.'/db-connection.php';

var_dump($_GET);
$id=$_GET['id'];

$querry="DELETE FROM `recenzii` WHERE `recenzii`.`id_recenzie` =$id;";
$statement=$conn->prepare($querry);
$statement->execute();
header('location:admin.php')

?>