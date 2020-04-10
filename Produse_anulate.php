<?php 
session_start();
require __DIR__.'/db-connection.php';
require __DIR__.'/navbar.php';

require __DIR__.'/helpers.php';

printSignUp();

?>

<link href="produse_anulate.css" rel="stylesheet">
<br><BR><BR><BR>
<div class="container" style="min-height:500px;">

<h6> Produse din comenzi anulate </h6>

<?php 

$querry="SELECT pr.nameP,pr.price,pr.image, COUNT(produs_id) as cantitate,produs_id FROM `produse_comenzi_anulate` as pca 
JOIN products as pr ON pr.idP=pca.produs_id
GROUP BY (produs_id)";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$results=$statement->fetchAll();
$produse=$results;


if(empty($produse))
{
    echo'<h4> Nu exista produse anulate </h4>';
}

foreach($produse as $produs)
{
    $id=$produs['produs_id'];
?>

<div class="produs">

<h2>  <?php  echo $produs['nameP']; ?> </h2>
<h3>  <?php  echo $produs['price']; ?> Lei</h3>
<h3>Cantitate pierduta:  <?php  echo $produs['cantitate']; ?> </h3>

<center><img src="<?php echo $produs['image'];  ?>"> </center>
<BR>
<a href="adaugare_produse_pierdute.php?id=<?php echo $id ?>&c=<?php echo $produs['cantitate'] ?>"> Adauga-le inapoi   </a>
<BR><BR><BR>
</div>
<?php
}
?>
<BR><BR><BR>
<center><a class="a1" href="admin.php"> Inapoi la admin </a></center>
<BR><BR>

</div>



<BR><BR>
<?php 


require __DIR__.'/bottom.php';

?>