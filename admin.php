<?php 
session_start();

require __DIR__.'/db-connection.php';
require __DIR__.'/navbar.php';
require __DIR__.'/helpers.php';
printSignUp();
// var_dump($_SESSION);
if( $_SESSION['id']!=19)
{
    header('Location:Market.php');
}

if($_SESSION['admin']!=1 )
{
    header('Location:home.php');
}


if( empty($_SESSION['voucherERR']))
{
    $_SESSION['voucherERR']='';
}
if( empty($_SESSION['StergeComanda']))
{
    $_SESSION['StergeComanda']='';
}

if( empty($_SESSION['gol']))
{
    $_SESSION['gol']='';
}

?>
<link href="admin.css" rel="stylesheet">
<?php 

$querry="SELECT rc.id_recenzie,rc.id_user, rc.descriere, us.nume, us.prenume,us.avatar FROM `recenzii` as rc
JOIN `users` as us ON rc.id_user=us.id
WHERE accept=0";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$results=$statement->fetchAll();
$recenzii=$results;

// var_dump($recenzii);
?>

<BR><BR><BR>
<div class="container" style="min-height:500px;">
<BR><BR>

<div class="voucher">
  <h2>  Adauga voucher</h2>
 
<form method="POST" action="Trimite-voucher.php">

<h2>Ce cont vrei sa primeasca voucher?</h2>
<center><input type="text" name="id"  placeholder="id-ul contului"></center> <br>
<h2>Valoare voucher</h2>
<center>  <select name="voucher">
      <option value="50">50</option>
      <option value="100">100</option>
      <option value="200">200</option>
    </select>
    <br><br>
<button type="submit"> Trimite  </button>
</center>
</form>
<h1> <?php echo $_SESSION['voucherERR'];?>  </h1>
</div>

<div class="gol">
<h1>  <?php echo  $_SESSION['StergeComanda'];?> </h1>
<h1> <?php echo  $_SESSION['gol'] ?> </h1>
</div>
<div class="reducere">
<a href="Reducere_produse.php"> Adauga o reducere  </a>
<a href="ComenziAst.php"> Vezi comenzile in proces  </a>
<a href="ComenziPro.php"> Vezi comenzile procesate  </a>
<a href="Produse_anulate.php"> Produse anulate  </a>
</div>




<div class="recenzii">
    <h2> Recenzii:</h2>
    <?php 
    foreach($recenzii as $recenzie)
    { ?>
<div class="recenzie">
        <h1> Recenzia nr: <?php echo $recenzie['id_recenzie'];?> </h1>
        <h1> Numele: <?php echo $recenzie['nume'].' '.$recenzie['prenume'];?>
        <h1> Id user: <?php echo $recenzie['id_user'];?></h1>
        <hr>
        <h1> Recenzie: <?php echo $recenzie['descriere']; ?> </h1>
        <hr><BR>
        <a href="Delete-recenzie.php?id=<?php echo $recenzie['id_recenzie'];?>"  style=" background-color: rgb(255, 51, 0);">
        Sterge recenzia
    </a>
    <a href="Add-recenzie.php?id=<?php echo $recenzie['id_recenzie'];?>">
        Adauga recenzia
    </a>
    </div>

<?php     }
    ?>

</div>

<?php
    if(empty($_SESSION['voucherERR']))
   { 
       $_SESSION['voucherERR']='';
    }

?>


<BR><BR>
</div>
<BR><BR>
<?php 
$_SESSION['StergeComanda']='';
$_SESSION['gol']='';
$_SESSION['voucherERR']='';


require __DIR__.'/bottom.php';
?>