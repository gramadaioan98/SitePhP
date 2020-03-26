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
?>

<?php



     $stringulmeu='';
     foreach($cos as $item)
    {
        $stringulmeu=$stringulmeu.','.$item;
    }
    $stringulmeu=substr($stringulmeu,-strlen($stringulmeu)+1);

if(!empty($_SESSION['cart'])){
   $querry="SELECT * FROM products WHERE idP IN ($stringulmeu)";
   $statement=$conn->prepare($querry);
   $statement->execute();
   $statement->setFetchMode(PDO::FETCH_ASSOC);
   $results=$statement->fetchAll();
   $cart=$results;}
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

            background-color:rgb(219, 238, 255);
            border-radius:5px;
        }
        </style>
    <div class="container">   
    <BR><BR><BR>
       
          
        <?php if(!empty($_SESSION['cart']))
        { ?>
        <div class="Shop-sum">
            <br> <br> 
            <h4> Sumar comanda: </h4>
                <?php 
                $sum=0;
                foreach($cart as $produs)
                {
                    
                    $sum=$sum+$produs['price'];
                }   ?>

              <h5>Cost produse:  <?php  echo $sum; ?>  Lei</h5>
                
                <?php if($sum<300) 
                {?>
              <h5>Cost livrare si procesare: 14 Lei </h5>
              <h4>       <hr width="200px"  color="gray"></h4>
              <h4> <br><br> Total: <?php  echo 14+$sum; ?> Lei </h4>
                <?php }
                else
                { ?>

                 <h5>Cost livrare si procesare: 0 Lei </h5>
                <h4> <hr width="200px"  color="gray"></h4>
                <h4> <br><br> Total: <?php  echo $sum; ?> Lei </h4>
                <?php
                }          
                ?>
              <h4> 
                   <button > Continua </button>
              <img src="images/cart.png">
            </h4>
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

            <?php }?>
           <?php if(isset($_SESSION['cart']))
            foreach($cart as $produs)
            {
                

            ?>
        <div class="Shop-cart">
            <div class="left">
                <div class="Shop-image">
                <img src="<?php echo $produs['image']?>">

                </div>
                
            </div>
            <div class="mid">
                <h2> <?php echo $produs['nameP']?> </h2>   
                <?php 
 
               if( $produs['stock']===0)
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
                <h2>  <?php echo $produs['price']?> Lei  </h2>
              
            
                <form action="remove-from-cart.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $produs['idP']; ?>" />
                    <button type="submit">Remove from cart</button>
                </form>  
            </div>         
            </div>
            <?php } ?>

               <br><br>
    </div>    
    <br><br>
<?php include __DIR__.'/bottom.php'; ?>
</body>
    </html>