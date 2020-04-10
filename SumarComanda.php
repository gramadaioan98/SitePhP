<?php 
session_start();
require __DIR__.'/db-connection.php';
include __DIR__.'/navbar.php';
if(empty($_POST['buy']))
{
    header('Location:home.php');

}
if(empty($_POST['livrare']))
{
    header('Location:buyProducts.php');
    $_SESSION['erroareComanda']='*un camp nu a fost completat';
   
}
else
{
    $_SESSION['erroareComanda']='';
}
?>
<link href="SumarComanda.css" rel="stylesheet">
<br><br><br><br>
<div class="container">
<center>
    <div class="container-bar">
<hr class="hr1"><hr class="hr1"><hr class="hr2">

<h2 class="bar"> <a href="shoppingCart.php">Cosul meu</a></h2>
<h3 class="bar"><a href="buyProducts.php"> Detalii comanda</a></h3>
<h4 class="bar"> Sumar comanda</h4>
<h5 class="bar"> Comanda plasata</h5>
</div></center>
<h2 class="sum"> Sumar comanda </h2>
<div class="detalii">

<div class="left">
<h4>Modalitate livrare</h4>
<h5><b> Livrare prin curier </b> </h5>
<h3><?php echo $_SESSION['nume'].' '.$_SESSION['prenume'].' - '.$_POST['telefon'];?> </h3>
<h3><?php echo($_POST['Adresa'])?> </h3>
</div>
<div class="mid">
<h4>Date facturare</h4>
<h5><b> Persoana fizica </b> </h5>
<h3><?php echo $_SESSION['nume'].' '.$_SESSION['prenume'].' - '.$_POST['telefon'];?> </h3>
<h3><?php echo($_POST['Adresa']);?> </h3>
<h3><?php echo($_SESSION['email'])?> </h3>

</div>
<div class="right">

<h4>Modalitate plata</h4>
<h5 ><b>Ramburs la curier </b></h5>

<h5 style="margin-bottom:15px;" ><b>Timp livrare:</b></h5>
<h3><?php
if($_POST['livrare']==1)
echo "Livrare rapida aprox 1-2 zile ";
else
echo "Livrare rapida aprox 3-5 zile ";

?></h3>
</div>
<br><BR><BR><BR><BR><BR><BR><BR><BR>
<div class="total">
<h2> Total comanda:<?php echo $_POST['suma']?> Lei </h2>

<h3> Prin plasarea comenzii, ești de acord cu Termenii și Condițiile, cu Politicile de Confidențialitate și Utilizare a cookie-urilor și tehnologiilor similare.</h3>
<center>
<form action="Trimite.php" method="POST">
<input type="hidden" value="<?php echo $_POST['Adresa'] ?>" name="Adresa">
<input type="hidden" value="<?php echo $_POST['livrare'] ?>" name="livrare">
<input type="hidden" value="<?php echo $_POST['suma'] ?>" name="suma">
<input type="hidden" value="<?php echo $_POST['telefon'] ?>" name="telefon">
<button type="submit" > Trimite comanda </button> 
</fomr>

</center>


</div>
<BR><BR>

</div>
<BR><BR>






</div>
<BR><BR>

<?php

include __DIR__.'/bottom.php';
?>