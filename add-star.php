<?php 
session_start();
require __DIR__.'/db-connection.php';

var_dump($_GET);

if(empty($_GET))
{
header('Location:home.php');

}

$star=$_GET['star'];
echo $star;
$id_produs=$_GET['id_produs'];
echo $id_produs;
$id_user=$_GET['id_user'];
echo $id_user;

$querry="SELECT * FROM `star` where id_user=$id_user and id_produs=$id_produs";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$results=$statement->fetchAll();
$recenzii=$results;

var_dump($recenzii);
if (!empty($recenzii))
{
    $_SESSION['EroareStele']='Ai adaugat deja recenzie!';
   
    header("Location:ProdusDescriere.php?id=$id_produs");
    die();
}



$querry="INSERT INTO `star` (`id`, `id_produs`, `id_user`, `stars`) VALUES (NULL, $id_produs, $id_user, $star);";
$statement=$conn->prepare($querry);
$statement->execute();

header("Location:ProdusDescriere.php?id=$id_produs");
?>