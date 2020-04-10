<?php 
session_start();
require __DIR__.'/db-connection.php';

// if(empty($_SESSION['cart']))
// header('Location:shoppingCart.php');

$cos=$_SESSION['cart'];
$stringulmeu='';
foreach($cos as $item)
{
   $stringulmeu=$stringulmeu.','.$item;
}
   // INSERT INTO `table` (`product_id`, `order_id`) VALUES ('36', '13'), ('35', '13')
$stringulmeu=substr($stringulmeu,-strlen($stringulmeu)+1);
$strada=$_POST['Adresa'];
echo $stringulmeu;
$id=$_SESSION['id'];
$livrare=$_POST['livrare'];
$suma=$_POST['suma'];
$telefon=$_POST['telefon'];

foreach($cos as $item)
{
   $a[$item]=0;
}
foreach($cos as $item)
{
$querry="SELECT stock,nameP FROM products where idP=$item";
   $statement=$conn->prepare($querry);
   $statement->execute();
   $statement->setFetchMode(PDO::FETCH_ASSOC);
   $results=$statement->fetchAll();
   $produs=$results;
   // var_dump($produs);
   $a[$item]++;
   echo $produs[0]['stock'].'-------';
   $suma1=$produs[0]['stock']-$a[$item];
   echo $produs[0]['nameP'];
   if($suma1<0)
   {
      $_SESSION['EmptyProdus']=$produs[0]['nameP'];
       header('Location:shoppingcart.php');
       die();
   }
   echo '-'.$item.'-';
   echo $a[$item];
   ?> 
   <BR>
 <?php }

echo '-----------------------------<br>';

$cart=$_SESSION['cart'];
foreach($cart as $item)
{
$querry="SELECT stock FROM products where idP=$item";
   $statement=$conn->prepare($querry);
   $statement->execute();
   $statement->setFetchMode(PDO::FETCH_ASSOC);
   $results=$statement->fetchAll();
   $produs=$results;
   // var_dump($produs);


   $suma1=$produs[0]['stock']-1;
  
   $querry1=" UPDATE `products` SET `stock`=$suma1 WHERE `products`.`idP` =$item";
   $statement1=$conn->prepare($querry1);
   $statement1->execute();

 

  
  
}






var_dump($a);

$querry="SELECT MAX(com_id) AS idmax FROM comenzi";
$statement=$conn->prepare($querry);
 $statement->execute();
 $statement->setFetchMode(PDO::FETCH_ASSOC);
 $results=$statement->fetchAll();
 $max=$results;
 
foreach($max as $maxim)
foreach($maxim as $c)
$maxim=++$c;


$valoarea=intval($_SESSION['idvoucher']);
echo $valoarea;
$t = date('Y-m-d',time());
$querry1="INSERT INTO `comenzi` (`com_id`, `user_id`,`suma`,`data`,`voucher`,`status`) VALUES ('{$maxim}', '{$id}','{$suma}','{$t}','{$valoarea}',0)";
$statement1=$conn->prepare($querry1);
$statement1->execute();

foreach($cos as $item)
{
$querry2="INSERT INTO `produse_comenzi` (`com_id`, `produs_id`) VALUES ('{$maxim}', '{$item}')";
 $statement2=$conn->prepare($querry2);
 $statement2->execute();
}



// var_dump($_SESSION);
$querry="DELETE FROM `voucher` WHERE user_id=$id AND valoare=$valoarea ;";
   $statement=$conn->prepare($querry);
   $statement->execute();


   $_SESSION['idvoucher']='';
 $_SESSION['voucher']='';
$_SESSION['succes']='succes';
header('Location:Succes.php');



?>