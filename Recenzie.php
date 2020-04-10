<?php 

session_start();
require __DIR__.'/db-connection.php';
 var_dump($_SESSION);
 var_dump($_POST); 
$id=$_SESSION['id'];
$id_produs=$_POST['id_produs'];
$descriere=$_POST['descriere'];

// echo $id.' '.$id_produs.' '.$descriere;


$t = date('Y-m-d',time());
$querry="SELECT * FROM `recenzii` where id_user=$id and id_produs=$id_produs";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$results=$statement->fetchAll();
$recenzii=$results;

if (!empty($recenzii))
{
    $_SESSION['EroareRecenzie']='Ai adaugat deja recenzie!';
    header("Location:Produsdescriere.php?id=$id_produs");
}
else
{
    $_SESSION['EroareRecenzie']='Ai adaugat recenzia asteapta confirmare!';
}

 $querry=" INSERT INTO `recenzii` (`id_produs`, `id_user`, `descriere`,`accept`,`data`) VALUES ('{$id_produs}', '{$id}', '{$descriere}','0','{$t}');";
 $conn->exec($querry);

 header("Location:Produsdescriere.php?id=$id_produs");
?>

