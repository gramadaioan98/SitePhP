
<?php 

session_start();
require __DIR__.'/db-connection.php';
require __DIR__.'/navbar.php';
require __DIR__.'/helpers.php';

//  var_dump($_GET);
// var_dump($_SESSION);

if(empty($_GET))
{
header('Location:Market.php');
}

if(empty($_GET['id']))
{
header('Location:Market.php');

}

    if(empty($_SESSION['produsAdaugat']))
    {
    $_SESSION['produsAdaugat']='';    
    }

    if(empty($_GET))
        header('Location:Market.php');
        
    if(empty($_SESSION['EroareRecenzie']))
    {
        $_SESSION['EroareRecenzie']='';
    }
    if(empty($_SESSION['EroareStele']))
    {
        $_SESSION['EroareStele']='';
    }
    

printSignUp();
$id=$_GET['id'];

$querry="SELECT * FROM products WHERE idP='{$id}'";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$results=$statement->fetchAll();
$produs=$results[0];
$id=$produs['idP'];
$nameP=$produs['nameP'];
$price=$produs['price'];
$image=$produs['image'];
$stock=$produs['stock'];
$descriere=$produs['descriere'];
?>
<link href="ProdusDescriere.css" rel="stylesheet">

<BR><BR><BR>
<div class="container">
   
<div class="left">
  <h1>  <?php echo $nameP?> </h1>
<hr class="hr1">
<center><img src="<?php echo $image;?>"></center>
<br><br>
<hr class="hr1">
</div>

<div class="right">
<br> 
    <div class="star">
    <?php 
    
    $querry="SELECT AVG(`stars`)as rating FROM `star` where id_produs=$id GROUP BY id_produs";
    $statement=$conn->prepare($querry);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    $results=$statement->fetchAll();
    $star=$results;
    if(!empty($star))
    $steluta=$star[0]['rating'];
   
    
  
    ?>

    <?php
     if(!empty($star))
     {      // deschide stelele
    if($steluta==5) 
    { ?>
        <img src="images/star2.png">
        <img src="images/star2.png">
        <img src="images/star2.png">
        <img src="images/star2.png">
        <img src="images/star2.png">
    <?php } 
        else 
        if($steluta>=4 && $steluta<5)
        { ?>
            <img src="images/star2.png">
            <img src="images/star2.png">
            <img src="images/star2.png">
            <img src="images/star2.png">
            <img src="images/star3.png">

  <?php   }
        else 
        if($steluta>=3 && $steluta<4)
        { ?>
            <img src="images/star2.png">
            <img src="images/star2.png">
            <img src="images/star2.png">
            <img src="images/star3.png">
            <img src="images/star3.png">

        <?php } 
        
        else 
        if($steluta>=2 && $steluta<3)
        {
        ?>
            <img src="images/star2.png">
            <img src="images/star2.png">
            <img src="images/star3.png">
            <img src="images/star3.png">
            <img src="images/star3.png">



        <?php }       
    else 
    if($steluta>=1 && $steluta<2)
    { ?>
            <img src="images/star2.png">
            <img src="images/star3.png">
            <img src="images/star3.png">
            <img src="images/star3.png">
            <img src="images/star3.png">

    <?php } 
     } 
     else
     {
        ?>
            <img src="images/star3.png">
            <img src="images/star3.png">
            <img src="images/star3.png">
            <img src="images/star3.png">
            <img src="images/star3.png">

   <?php  }
     
     
     //inchide stelele
    ?>

      </div>


 <br> 

 <br> 

 <?php $priceDiscount=$produs['price']*(($produs['discount'])/100);
    $priceDiscount=$produs['price']-$priceDiscount;


        if($produs['discount']!=0)
       {
       ?>
    <h3 style="font-size:20px;   text-decoration: line-through;"> <?php
    echo $price;?> Lei </h3>
<h3 style="font-size:25px;"> Pret nou: <?php
              echo $priceDiscount;?> Lei </h3>

<?php  } 
else
{
?>
 <h3> <?php
    echo $price;?> Lei </h3>

<?php  }?>

        <?php

        if($stock!=0)
       {?> 
        <div class="disponibil"><h4> Stoc disponibil </h4> </div>
        <?php 
         }
        else 
        {
        ?>
        <div class="indisponibil"><h4> Stoc indisponibil </h4> </div>
    <?php 
        }
    
    if($stock<10 && $stock!=0) 
    {
    ?>
    <h2> Grabeste-te ultimele <b style="    font-weight: 600;"><?php echo $stock;?></b> produse in stoc! </h2>
    <?php } 
    ?>
    <h5> Garantie inclusa 24 luni </h5>

    <?php   if($stock!=0){?>
                <div class="Buton">  <center>
                
                 <form action="add-cart-descriere.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $produs['idP'];?>">
                    <img src="images/cart.png">
                    <button class="button" type="submit"> <b>Add to Cart</b></button>
                 </form>
                 </center>
                 </div>
                <?php   
                }
                else
                { ?>  
                    <div class="Buton">  <center>
                   
                    <img src="images/cart.png">
                    <button style="
                    background-image: linear-gradient(to right,red,rgb(255, 166, 172));                   
                    
                    " class="button" > <b>Indipsonibil</b></button>
                    
                    </center>
                    </div>
                    <?php
                }
 ?>
<div class="produsSucces"><h4><?php echo $_SESSION['produsAdaugat'];?> </h4> </div>


</div>

<div class="descriere">
<h3><b> Descriere: </b> </h3>
<?php 
echo $descriere;

$idprodus=$_GET['id'];

?>
<hr>
</div>

<div class="AdaugaRecenzie">
        
        <h2> Ai cumparat acest produs? Adauga o recenzie!</h2>
       <h3> <?php echo $_SESSION['EroareRecenzie'];?> </h3>
            <form action="Recenzie.php" method="POST"> 
               <input type="hidden" name="id_produs" value=<?php echo $idprodus?> >
            <textarea placeholder="Recenzie pentru acest produs:" maxlength="250" name="descriere"></textarea>
                <br>
            <button type="submit"> Adauga recenzia </button>
            
            </form>

            <div class="star2">
              
           <h4 style="color:red; font-weight:300; margin:10px;"> <?php echo $_SESSION['EroareStele'];?></h4><br>
           
           <h5>Cate stele merita acest produs? </h5>
           <?php $iduser=$_SESSION['id'];?>
      <a href="add-star.php?star=1&id_produs=<?php echo $idprodus ?>&id_user=<?php echo $iduser?>">  <img class="stea1" src="images/star3.png"> </a>
      <a href="add-star.php?star=2&id_produs=<?php echo $idprodus ?>&id_user=<?php echo $iduser?>">  <img  class="stea2" src="images/star3.png"></a>
      <a href="add-star.php?star=3&id_produs=<?php echo $idprodus ?>&id_user=<?php echo $iduser?>">  <img class="stea3" src="images/star3.png"></a>
      <a href="add-star.php?star=4&id_produs=<?php echo $idprodus ?>&id_user=<?php echo $iduser?>"> <img class="stea4"  src="images/star3.png"></a>
      <a href="add-star.php?star=5&id_produs=<?php echo $idprodus ?>&id_user=<?php echo $iduser?>">  <img class="stea5" src="images/star3.png"></a>
      </div>

</div>

<div class="recenzii">
<hr>
<h3><b> Recenzii: </b> </h3>




<?php 
$produsRecenzie=$_GET['id'];
$querry="SELECT rc.data,rc.id_user, rc.descriere, us.nume, us.prenume,us.avatar FROM `recenzii` as rc
JOIN `users` as us ON rc.id_user=us.id
WHERE rc.id_produs=$produsRecenzie AND rc.accept=1";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$results=$statement->fetchAll();
$recenzii=$results;
// var_dump($recenzii);

foreach($recenzii as $recenzie)
{ ?>
    <div class="recenzie">
    <img src="<?php echo $recenzie['avatar']?>">
        
<br><br>
    <h3> <?php  echo $recenzie['descriere'];?> <br></h3>
  <br>
  <h5> <?php echo $recenzie['nume'].' '.$recenzie['prenume'] ?></h5>
    <h4> Data recenziei: <?php echo $recenzie['data']?> </h4>

</div>
<br><br>
<?php 
}
?>

</div>

<?php if(empty($recenzii))
    { ?>
   
    <div class="img-rec">
    <h1> Nu exista recenzii </h1>
    <img src="images/star.png">
    <img src="images/star.png">
    <img src="images/star.png">
    <img src="images/star.png">
    <img src="images/star.png">
    </div>
 <?php 
    }
 ?>

<BR><BR>
</div>

<BR><BR>
<?php 

$_SESSION['EroareStele']='';
$_SESSION['produsAdaugat']='';
$_SESSION['EroareRecenzie']='';
require __DIR__.'/bottom.php';
?>