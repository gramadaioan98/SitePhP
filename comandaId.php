<?php 

session_start();

require __DIR__.'/db-connection.php';
require __DIR__.'/navbar.php';
require __DIR__.'/helpers.php';

printSignUp();

if(empty($_GET))
{
    header('Location:contact.php');
}
if(empty($_GET['p']))
{
    header('Location:contact.php');
}

$id=$_GET['p'];


$querry="SELECT count(*) as cantitate, cm.user_id, cm.com_id as comandaNR, pr.idP, pr.nameP, pr.price, pr.image FROM `produse_comenzi` as pc 
JOIN `comenzi` as cm ON pc.com_id=cm.com_id 
JOIN `products` as pr ON pc.produs_id=pr.idP 
WHERE pc.com_id=$id GROUP BY pr.idP";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$comanda=$statement->fetchAll();

$querry="SELECT suma,com_id,data FROM `comenzi` WHERE com_id='{$id}' ";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$suma=$statement->fetchAll();
// var_dump($comanda);
// var_dump($suma);

?>
<link href="comandaId.css" rel="stylesheet">
<BR><BR><BR>
<div class="container">
<div class="block">
<h1>  Comanda cu nr: <?php echo $suma[0]['com_id']?></h1>

<h1>  Preluata: <?php echo $suma[0]['data'];?></h1>

<h1>  Suma: <?php echo $suma[0]['suma'];?> Lei</h1>
</div>
<?php 
foreach($comanda as $produs)
{ ?>
        
    <div class="produs" >
        <img src="<?php echo $produs['image']?>">
       <h2> <?php echo $produs['nameP'];?> <asd style="color:green;"><?php echo 'x'.$produs['cantitate']?></asd> </h2><br>
         <h3 style="color:red;">Pret per produs: <?php echo $produs['price'];?> Lei</h3>
    </div>

<?php }
?>

<center><a href="contact.php"><button> Intoarcete la cont</button> </a> </center>
<br><BR>
</div>
<BR><BR>
<?php 
// var_dump($comanda);
require __DIR__.'/bottom.php';
?>

