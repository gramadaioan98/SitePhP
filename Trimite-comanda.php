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
if($status==0)
{

   $querry="UPDATE `comenzi` SET `status` = '1' WHERE `comenzi`.`com_id` = $id;";
   $statement=$conn->prepare($querry);
   $statement->execute();
   header('Location:ComenziAst.php');
   die();
}
elseif($status==1)
{
    $querry="UPDATE `comenzi` SET `status` = '2' WHERE `comenzi`.`com_id` = $id;";
   $statement=$conn->prepare($querry);
   $statement->execute();
   header('Location:ComenziPro.php');
   die();
}




?>



