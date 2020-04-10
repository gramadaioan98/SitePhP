<?php 
session_start();
require __DIR__.'/navbar.php';
require __DIR__.'/db-connection.php';
require __DIR__.'/helpers.php';
printSignUp();

if($_SESSION['admin']!=1)
{
    header('Location:home.php');
}

$querry="SELECT cm.com_id,cm.status,us.nume, us.prenume, us.email, cm.suma,us.telefon FROM `comenzi` as cm 
JOIN `users` as us ON us.id=cm.user_id
WHERE cm.status=1
ORDER BY cm.`status` ASC
";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$results=$statement->fetchAll();
$comenzi=$results;

if(empty($comenzi))
{
    $_SESSION['gol']='nu ai comenzi aici';
    header('Location:admin.php');
}

?>
<link rel="stylesheet" href="ComenziAst.css">

<BR><BR><BR>
<div class="container" style="min-height:500px;">
<BR><BR>
    <center><a href="admin.php">  Inapoi la Admin  </a></center>
<BR><BR>

    <?php 
    foreach($comenzi as $comanda)
    {
    ?>
        <div class="comanda">

        <h2><b>Status:</b> <?php
        
        if($comanda['status']==0) 
                {
                echo 'In proces';
                }
                else
                if($comanda['status']==1)
                {
                  echo 'Procesata';
                }
                else
                if($comanda['status']==2)
                {
                  echo 'Preluata';
                }
        ?> </h2>
          <h2> <b>Suma:</b> <?php echo $comanda['suma'] ?> Lei</h2>
        <h2><b> Nume: </b> <?php echo $comanda['nume'] ?></h2>
        <h2><b> Prenume: </b> <?php echo $comanda['prenume'] ?></h2>
        <h2><b> Email: </b> <?php echo $comanda['email'] ?></h2>
        <h2><b> Telefon:</b> <?php echo $comanda['telefon'] ?> </h2>
        

                <a class="a1" href="Sterge-comanda.php?id=<?php echo $comanda['com_id'];?>"> Sterge </a>
                <a href="Trimite-comanda.php?id=<?php echo $comanda['com_id'];?>&status=<?php echo $comanda['status'];?>"> Trimite </a>
                </div>
    <?php } ?>

</div>

<BR><BR>
<?php 

require __DIR__.'/bottom.php';
?>