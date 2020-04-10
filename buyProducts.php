
<link href="buyProducts.css" type="text/css" rel="stylesheet">

<?php
session_start();
require __DIR__.'/db-connection.php';
include __DIR__.'/navbar.php';


?><br><br><br><br>
<?php
if(isset($_SESSION['cont']) && $_SESSION['cont'] === '') 
{
        header('Location: home.php');
}
if(empty($_SESSION['cart']))
{
   
    header('Location: shoppingCart.php');
}
if(!empty($_SESSION['cart']))
{
    $cos=$_SESSION['cart'];
}
$id=$_SESSION['id'];

if(!isset($_POST['voucher']))
    header("Location:shoppingCart.php");


$voucher=$_POST['voucher'];


if(!empty($voucher))
{

$querry="SELECT * FROM voucher WHERE user_id=$id AND valoare=$voucher";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$resultsVoucher=$statement->fetchAll();

if(empty($resultsVoucher))
{
$_SESSION['voucher']='Nu ai acest voucher';
header('Location:shoppingCart.php');
die();
}

}
$_SESSION['idvoucher']=$voucher;






foreach($cos as $item)
{
    $a[$item]=0;
}
$stringulmeu='';
foreach($cos as $item)
{
    $a[$item]++;
    $stringulmeu=$stringulmeu.','.$item;
}
$stringulmeu=substr($stringulmeu,-strlen($stringulmeu)+1);

if(!empty($_SESSION['cart'])){
$querry="SELECT * FROM products WHERE idP IN ($stringulmeu)";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$results=$statement->fetchAll();
$cart=$results;}

?>

<div class="container">
<center>
    <div class="container-bar">
<hr class="hr1"><hr class="hr2"><hr class="hr2">

<h2 class="bar"> <a href="shoppingCart.php">Cosul meu</a></h2>
<h3 class="bar"><a href="buyProducts.php"> Detalii comanda</a></h3>
<h4 class="bar"> Sumar comanda</h4>
<h5 class="bar"> Comanda plasata</h5>

</div></center><center>
<h1 style="color:red;font-size:18px;"><?php echo $_SESSION['erroareComanda'];?> </h1></center>
<h1> Detalii comanda</h1>

<div class="detalii">
    <form method="POST" action="SumarComanda.php">
<h2>Modul livrarii:</h2>

<h3> Momentan livrare prin curier</h3>
<hr>
<h2>Persoana de contact:</h2>
<h4>
<?php  echo $_SESSION['nume'].' '.$_SESSION['prenume'] ?>
</h4>
<hr>
<h2>Adresa de livrare:</h2>
<input class="adresa" type="text" name="Adresa" placeholder="Ex: Jud.: SV mun.: com.: Strada: nr: bl: ap:....."><br>

<div class='livrare'>
<input type="radio" value="rapida" name="livrare" > Livrare rapida aprox 1-2 zile
</div>

<div class='livrare'>
<input type="radio" value="normala" name="livrare"> Livrare normala aprox 3-5 zile
</div>
<h2>Numar de telefon:</h2>
<input class="telefon" type="text" name="telefon" placeholder="07********"><br>
<hr>
<h2>Produse: </h2>

<?php 
$produse=$_SESSION['cart'];
?>

<?php foreach($cart as $produs)
{?><div class="Produse">
    <img src="<?php echo $produs['image'];?>">
   <h2> <?php echo $produs['nameP'].' x'.$a[$produs['idP']]?> </h2> <br>

  <?php $priceDiscount=$produs['price']*(($produs['discount'])/100);
    $priceDiscount=$produs['price']-$priceDiscount;
?>
   <h6>Pret: <?php echo $priceDiscount*$a[$produs['idP']];?> Lei </h6>
   </div>
<?php }?>
<br><br>
<hr>
<center>
<h2> Plata se face la curier! </h2> </center>
<hr>

<?php
    $sum=0;
foreach($cart as $produs) 
{
    $priceDiscount=$produs['price']*(($produs['discount'])/100);
    $priceDiscount=$produs['price']-$priceDiscount;
    $sum=$sum+$priceDiscount*$a[$produs['idP']];    
 }
 $transport='';
 if($sum<=300)
    {
     $sum=$sum+14;
    $transport="Cost livrare: 14 lei";
    }
else
{
    $transport="Cost livrare: Gratuit";
}
 

$sumfin=$sum-intval($voucher);
if($sumfin<0)  
 {
   $sum=intval($voucher);
 }
 ?>

 <div class="Suma">
<h2> Total comanda:</h2> <br>
<h6><?php echo $transport;?> </h6>
<input type="hidden" name="suma" value=<?php echo $sum-intval($voucher);?>>
<h5> Suma totala: <?php echo $sum-intval($voucher);?> Lei</h5><br>
    <?php if(!empty($voucher))
        echo 'Ai adaugat un voucher de: '.$voucher.' Lei';
    ?>
    <br>
<input type="hidden" name="buy" value=1>
<button type="submit" > Pasul urmator </button>
</div>
</form>
<?php 

 ?>

</div>
<br><br>
</div>
<br><br>




<?php 

include __DIR__.'/bottom.php';
?>