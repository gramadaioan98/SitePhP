<?php 
session_start();
require __DIR__.'/db-connection.php';
require __DIR__.'/navbar.php';
require __DIR__.'/helpers.php';
printSignUp();
if($_SESSION['admin']!=1)
{
    header('Location:home.php');
}
if(empty( $_SESSION['discount']))
{
    $_SESSION['discount']='';
}


require __DIR__.'/getProduct.php';

// var_dump($produse);
?>

<link href="Reducere_produse.css" rel="stylesheet">
<BR><BR><BR>
<div class="container">


<BR><BR><BR><BR>
<?php 

    foreach($produse as $produs)
    {
    ?>
    <div class="container-product">
           <a href="ProdusDescriere.php?id=<?php echo $produs['idP']?>">
           <div class="link">
                <div class="image"> 
                <center> <img src="<?php echo $produs['image']?>" /> </center> 
                </div>   
               
                <div class="name">  
                <center> <?php echo $produs['nameP']; ?></center>  
                </div>
                <div class="stock"> 
                <h3><center><?php stock($produs['stock']);  ?> </center></h3>
                 </div>
                 <div class="price"> 
                <center>  <h3>  <?php   echo $produs['price'];  ?> lei    </h3> </center>
                <center>  <h3> Discount: <?php   echo $produs['discount'];  ?> %    </h3> </center>
                 </div>
            
             </div>
            </a>   
                
            <form action="add-discount.php" method="POST">
            <center>   
           
            <input type="text" name="discount" placeholder="introdu discountul"> <br> <br>
            <input type="hidden" name="id_produs" value=<?php  echo $produs['idP']?>>
            <button type="submit"> Plaseaza discountul</button>
            </center>
            </form>


        </div>    
    <?php   
    }?>
<BR><BR>
    </div>
    <BR><BR><BR><BR>
</div>
<?php 

require __DIR__.'/bottom.php';
$_SESSION['discount']='';
?>