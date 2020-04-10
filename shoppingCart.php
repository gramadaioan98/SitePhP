    <?php 
    session_start();
    include __DIR__.'/helpers.php';
    include __DIR__.'/navbar.php';
    // include __DIR__ .'/initprod.php';
   require __DIR__.'/db-connection.php';  
   printSignUp();

   if(isset($_SESSION['cont']) && $_SESSION['cont'] === '') 
   {
           header('Location: home.php');
   }
   $cart=[];
    if(isset($_SESSION['cart']))
      { 
         
          $cos=$_SESSION['cart'];
      }
      else
      {
          $cos[]='';
      }

      if(empty($_SESSION['voucher']))
      {
        $_SESSION['voucher']='';
      }

     
      if(empty($_SESSION['Sumamica']))
      {
        $_SESSION['Sumamica']='';
      }

?>

<?php

    
if(!empty($_SESSION['cart'])){
    $stringulmeu='';

    foreach($cos as $item)
   {
        $a[$item]=0;
   }
    foreach($cos as $item)
   {
    $a[$item]++;
       $stringulmeu=$stringulmeu.','.$item;
   }
  
   $stringulmeu=substr($stringulmeu,-strlen($stringulmeu)+1);
   $querry="SELECT * FROM products WHERE idP IN ($stringulmeu)";
   $statement=$conn->prepare($querry);
   $statement->execute();
   $statement->setFetchMode(PDO::FETCH_ASSOC);
   $results=$statement->fetchAll();
   $cart=$results;}
//    var_dump($cart);
  ?>
    
    <html>
    <head>
    <title>   Shop     </title>
    <link href="main.css" rel="stylesheet">
    <link href="welcome.css" rel="stylesheet">
    <link href="cart.css" rel="stylesheet">
    <link href="home.css" rel="stylesheet">
    </head>
    <body>
    <br><br><BR><BR>
    <style>
        .container {
            max-width: 1000px;
                min-height:500px;
            background-color:rgb(219, 238, 255);
            border-radius:5px;
        }
        </style>
<?php 
if(empty($_SESSION['EmptyProdus']))
{
    $_SESSION['EmptyProdus']='';
}
?>

    <div class="container">   
    <BR><BR><BR>
       <?php
        if(!empty($_SESSION['EmptyProdus']))
       { 
           ?>
         <h4 style="
         color:red;
         font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
         font-weight:300;
         text-align:center;
         ">   Nu exista atatea produse la <?php echo $_SESSION['EmptyProdus'];?></h4>
     
      <?php 
       
        } 
       
       ?>
      
        <?php 
        if(!empty($_SESSION['cart']))
        { ?>
        <div class="Shop-sum">
            <br> <br> 
            <h4> Sumar comanda: </h4>
                <?php 
                $sum=0;
                foreach($cart as $produs)
                {
                    
                    $priceDiscount=$produs['price']*(($produs['discount'])/100);
                    $priceDiscount=$produs['price']-$priceDiscount;


                    $sum=$sum+$priceDiscount*$a[$produs['idP']];
                }   ?>

              <h5>Cost produse:  <?php  echo $sum; ?>  Lei</h5>
                
                <?php if($sum<300) 
                {?>
              <h5>Cost livrare si procesare: 14 Lei </h5>
              <h4>       <hr width="200px"  color="gray"></h4>
              <h4> <br> Total: <?php  echo 14+$sum; ?> Lei </h4>
                <?php }
                else
                { ?>

                 <h5>Cost livrare si procesare: 0 Lei </h5>
                <h4> <hr width="200px"  color="gray"></h4>
               
                <h4> <br> Total: <?php  echo $sum; ?> Lei </h4>
                <?php
                }          
                ?>
           
                <form  method="POST"action="buyProducts.php" >
                <h4> 
                <input style="width:160px;margin-left:90px;" type="text" name="voucher" placeholder="Scrie valoarea voucherului" />
                <input type="hidden" name="erroareComanda" value="" />


                   <button style="margin-left:50px;" type="submit" > Continua </button>
              <img src="images/cart.png">
              <?php echo $_SESSION['voucher']; ?>
              </h4> 
               
            </form>
        </div>
            <?php }
           ?>
            <?php 
            if(empty($_SESSION['cart']))
            {
            ?>
           <!-- -----------COS GOL---------------      -->
               <style> .container {background:white;}</style>
               
            <div class="empty-cart"> 
   
               <center>
               <h1> Cos de cumparaturi gol!</h1>
               <form action="Market.php">
                <button type="submit">  Intoarce-te in magazin   </button>
            </form>
               <img src="images/emptycart.png"> 
            </center><?php
            include __DIR__.'/producatori.php';
            ?>
            <div class="banner"> </div>
            <?php
            include __DIR__.'/topcategory.php';   
            ?>
            </div>

            <?php }
            // var_dump($_SESSION['cart']);
            ?>
           <?php if(isset($_SESSION['cart']))
            foreach($cart as $produs)
            {
                // var_dump($a[$produs['idP']])

            ?>
        <div class="Shop-cart">
            <div class="left">
                <div class="Shop-image">
                <img src="<?php echo $produs['image']?>">

                </div>
                
            </div>
            <div class="mid">
                <h2> <?php echo $produs['nameP'].' x'.$a[$produs['idP']]?> </h2>   
                <?php 
 
               if( $produs['stock']==0)
               {
                   echo'  <h3 style="color:red;">Disponibilitate: indisponibil</h3>';
               }
               else
               {
                echo' <h3 style="color:green;"> Disponibilitate: In stoc  </h3>
                <h4>Garantie inclusa: 24 luni</h4>   
                ';
               }
                 ?> 
            </div>
            <div class="right">
                <h2>  <?php 
                

                $priceDiscount=$produs['price']*(($produs['discount'])/100);
                $priceDiscount=$produs['price']-$priceDiscount;
              
              
               
                
                echo $a[$produs['idP']]*$priceDiscount?> Lei  </h2>
              
               
                <form action="remove-from-cart.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $produs['idP']; ?>" />
                    <input type="hidden" name="stock" value="<?php echo  $a[$item]; ?>" />
                    <button type="submit">Remove from cart</button>

                </form>  
            <h5 style="color:red; font-size:15px">   <?php if($produs['discount']!=0)
               echo 'Produs cu discount de: '.$produs['discount'].'%';
                ?>
            </h5>
            </div>         
            </div>
            <?php } ?>

               <br><br>
    </div>    
    <br><br>
<?php 
?>




<?php
//  var_dump($_SESSION);

include __DIR__.'/bottom.php'; 
$_SESSION['Sumamica']='';           
    $_SESSION['voucher']='';
    $_SESSION['EmptyProdus']='';
   $_SESSION['erroareComanda']='';
 
?>
</body>
    </html>