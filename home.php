<?php 
session_start();

if(isset($_SESSION['cont']) && $_SESSION['cont'] === '') 
{
        header('Location: index.php');
}
include __DIR__.'/helpers.php';
printSignUp();
include __DIR__.'/navbar.php';


?>

<html>
<head>
<title>   Shop-Home     </title>
<link href="main.css" rel="stylesheet">
<link href="welcome.css" rel="stylesheet">
<link href="home.css" rel="stylesheet">

 </head>
<body>

<br><br><br><br>
<div class="container">

<center> <div class="home-welcome"><br><br>
        <h3>  Bun venit  <?php echo $_SESSION['nume'];?>!</h3>
     <marquee> <h4>  Iti livram produsele in orice colt al tarii -> In aceasta perioada alege livrarea prin curier!</h4> 
</marquee>      
        <hr style="color:white;width:300px; box-shadow:1px 1px 10px black;">
</div>
<br><br>
</center>
<div class="title-category">
<h1>  -Top categorii-  </h1>

</div>

<?php  include __DIR__.'/topCategory.php';?>

<br><br><div class="banner">
           
           </div>

<?php  include __DIR__.'/producatori.php';?>
<br>
</div>


<?php 

include __DIR__.'/bottom.php';
?>
</body>
</html>