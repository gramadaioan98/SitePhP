<link href="product.css" rel="stylesheet">
<?php 

require __DIR__.'/db-connection.php';
include __DIR__.'/helpers.php';
$querry="SELECT * FROM products ";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$results=$statement->fetchAll();
$users=$results;



var_dump( $users);
?>
<!-- // echo $results[0]['image'];
// echo $userin['image']; -->

<div class="container-product-prim">
<?php
foreach($users as $user)
{ ?>
    <div class=container-product>
    <div class="image"> <center>
    <img src="<?php echo $user['image']?>"></center>
    </div>
    <div class="name"><center>
    <?php echo $user['nameP'];?></center>
    </div>
    <!-- <div class="stock"> 
                <h3><center><?php echo $user['stock'] ?> </center></h3>
                 </div> --><br>
                 <div class="price"> 
                <center>  <h3>  <?php   echo $user['price'];  ?> lei    </h3> </center>
                 </div>      
                 <?php
                    echo $user['stock'];
                 $stock=Stock1(intval($user['stock']) );
                  if($stock!=0){?>
                <div class="Buton">  <center>
                
                 <form action="add-cart.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $user['idP']?>">
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
                    <form >
                    <img src="images/cart.png">
                    <button style="
 background-image: linear-gradient(to right,red,rgb(255, 166, 172));                   
                    
                    " class="button" type="submit"> <b>Indisponibil</b></button>
                    </form>
                    </center>
                    </div>
                    <?php
                }
                
                ?>

 </div>
  <?php
}?>
</div>
<!-- // foreach ($arrayMare as $randDinArray) {
//     foreach($randDinArray as $ceva) {
//        echo $ceva;
//     }
//  } -->





<!-- <img src="<?php echo $userin['image']?>"> -->