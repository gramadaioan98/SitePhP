        <?php 
        session_start();
        include __DIR__.'/helpers.php';
        // include __DIR__.'/initprod.php';
        require __DIR__.'/db-connection.php';
        require __DIR__.'/getProduct.php';
        printSignUp();
  
        
        if(isset($_SESSION['cont']) && $_SESSION['cont'] === '') 
        {
                header('Location: index.php');
        }
        

        ?>
        
        <html>
        <head>
        <title>   Shop     </title>
        <link href="main.css" rel="stylesheet">
        <link href="product.css" rel="stylesheet">
        </head>
        <body>
        <?php include __DIR__.'/navbar.php';?>
        <br><br><br>
<div class="container">
        
        
        <center>
        <h7> Produse de top:</h7> <BR><BR><BR></center>
     
     
        <div class="banner1">
          
           </div>
       
        
    <div class="admin"
    <?php 
    if($_SESSION['admin']==1){
    ?> 
    style="display:block;" 
    <?php }?>
   
     > 
    <?php if($_SESSION['admin']==1){?>
      <center> <a 
     style="
     font-size:20px; 
     text-decoration:none;
     color:white;
     border:1px solid;
     background-color:black;
     border-radius:5px;
     padding:5px;
     position:relative;
     top:10px;
     "
     href="upload.php"> Adauga produse! </a> 
    </center>
   <?php }?>
    </div>
    <div class="container-product-prim">
            <BR><BR><BR>

       

    
<?php 

    foreach($produse as $produs)
    {
    ?>
    <div class="container-product">
                <div class="image"> 
                <center> <img src="<?php echo $produs['image']?>" /> </center> 
                </div>   
                <?php if($_SESSION['admin']==1)
                {   
                include __DIR__.'/delProduct.php';
                }
                ?>
                <div class="name">  
                <center> <?php echo $produs['nameP']; ?></center>  
                </div>
                <div class="stock"> 
                <h3><center><?php stock($produs['stock']) ?> </center></h3>
                 </div>
                 <div class="price"> 
                <center>  <h3>  <?php   echo $produs['price'];  ?> lei    </h3> </center>
                 </div>
                 <?php   if($produs['stock']!=0){?>
                <div class="Buton">  <center>
                
                 <form action="add-cart.php" method="POST">
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
                    <form >
                    <img src="images/cart.png">
                    <button style="
                    background-image: linear-gradient(to right,red,rgb(255, 166, 172));                   
                    
                    " class="button" type="submit"> <b>Indipsonibil</b></button>
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
    <div class="banner">
           
           </div>


    </div>
<?php include __DIR__.'/bottom.php';?>
</body>
</html>

