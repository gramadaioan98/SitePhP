<?php 
session_start();
require __DIR__.'/db-connection.php';

var_dump($_GET);

$id=$_GET['id'];
$status=$_GET['status'];

if(empty($id) || empty($status))
{
    header('Location:home.php');
}

if($status==0 || $status==1)
{

    $querry3="SELECT * FROM `comenzi` WHERE `comenzi`.`com_id` =$id";
   $statement3=$conn->prepare($querry3);
   $statement3->execute();
   $statement3->setFetchMode(PDO::FETCH_ASSOC);
   $results=$statement3->fetchAll();
   $comanda=$results;
var_dump($comanda);
$com_id=$comanda[0]['com_id'];
$user_id=$comanda[0]['user_id'];
$suma=$comanda[0]['suma'];
$voucher=$comanda[0]['voucher'];

$querry4="INSERT INTO `comenzi_anulate` (`com_id`, `user_id`, `suma`, `voucher`) VALUES ($com_id, $user_id, $suma, $voucher)";
$statement4=$conn->prepare($querry4);
$statement4->execute();

$querry5="SELECT produs_id FROM `produse_comenzi` WHERE com_id=$id";
$statement5=$conn->prepare($querry5);
   $statement5->execute();
   $statement5->setFetchMode(PDO::FETCH_ASSOC);
   $results=$statement5->fetchAll();
   $produse=$results;

var_dump($produse);

foreach($produse as $produs)
{
        $pr=$produs['produs_id'];
    $querry6="INSERT INTO `produse_comenzi_anulate` (`com_id`, `produs_id`) VALUES ($id, $pr)";
    $statement6=$conn->prepare($querry6);
     $statement6->execute();
}
 

   $querry="DELETE FROM `comenzi` WHERE `comenzi`.`com_id` =$id";
   $statement=$conn->prepare($querry);
   $statement->execute();

   $querry2="DELETE FROM produse_comenzi where com_id=$id";
   $statement2=$conn->prepare($querry2);
   $statement2->execute();
   
   $_SESSION['StergeComanda']="comanda $id anulata";
    header('Location:admin.php');
    die();
}
header('Location:home.php');
?>