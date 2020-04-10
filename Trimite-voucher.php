<?php 
session_start();
require __DIR__.'/db-connection.php';

var_dump($_POST);
$id=$_POST['id'];
$voucher=$_POST['voucher'];

if(empty($id) || empty($voucher))
    {
        $_SESSION['voucherERR']='introdu id sau voucher-ul';
    header("Location:admin.php");
        die();
   }

   $querry="SELECT id FROM `users` where cont=$id";
   $statement=$conn->prepare($querry);
   $statement->execute();
   $statement->setFetchMode(PDO::FETCH_ASSOC);
   $user=$statement->fetchAll();

   if(empty($user))
   {
       $_SESSION['voucherERR']='nu exista acest id';
    header("Location:admin.php");
    die();
   }

$querry="SELECT * FROM `voucher` where user_id=$id and valoare=$voucher";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$results=$statement->fetchAll();

if(!empty($results)){
    $_SESSION['voucherERR']='Are deja acest voucher';
 header("Location:admin.php");
 die();
}



$querry="INSERT INTO `voucher` (`id`, `user_id`, `valoare`) VALUES (NULL, $id, $voucher);";
$statement=$conn->prepare($querry);
$statement->execute();
$_SESSION['voucherERR']='Voucher adaugat!';
header("Location:admin.php");

?>
