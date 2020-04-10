<?php 
session_start();
require __DIR__.'/db-connection.php';
require __DIR__.'/helpers.php';
require __DIR__.'/navbar.php';
printSignUp();
?>

<link href="buyProducts.css" type="text/css" rel="stylesheet">

<br><BR><BR><BR>
<div class="container">

<div class="succes">
<div class="succes-h2">
<h2> Iti multumim ca ai cumparat de la noi!<h2>
</div>
<div class="succes-h3">
<h3> Sa te bucuri de produsele cumparate!</h3>
</div>
<div class="succes-h4">
<h4> O zi cat mai productiva!</h4>
</div>


<a href="market.php"><button> Intoarcete in magazin!</button> </a>
<div class="smoke">
<img src="images/smoke.png">
</div>
</div>
</div>
<BR><BR>
<?php 
if(empty($_SESSION['succes']))
{
    header('Location:home.php');
}
$_SESSION['succes']='';
$_SESSION['cart']=[];

require __DIR__.'/bottom.php';
?>
