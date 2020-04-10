


<?php 
session_start();


$_SESSION['avatar-up']="";

// if (isset($_SESSION['login']) && $_SESSION['login'] === 1) {
//     header('Location: home.php');
// }
require __DIR__.'/db-connection.php';
require __DIR__.'/navbar.php';
require __DIR__.'/helpers.php';
printSignUp();

if(empty( $_SESSION['ErrTelefon']))
{
  $_SESSION['ErrTelefon']='';
}


$querry="SELECT com_id, Produse,suma FROM `comenzii` WHERE id_user='{$_SESSION['id']}' ";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$results1=$statement->fetchAll();
// var_dump($_SESSION)
$id=$_SESSION['id'];

if(isset($_POST['but_upload'])){
  $name = $_FILES['file']['name'];

  $target_dir = "upload/";
  $target_file = $target_dir . basename($_FILES["file"]["name"]);

  // Select file type
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions_arr = array("jpg","jpeg","png","gif");

  // Check extension
  if( in_array($imageFileType,$extensions_arr) ){
 
 
    // Insert record
    $query = "UPDATE `users` SET `avatar` = ' $target_file ' WHERE `users`.`id` = $id; ";
 
    $conn->exec($query);
    // Upload file
    move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
    $_SESSION['avatar-up']="Va rog sa va logati din nou!";
  }

}
?>

<link href="contact.css" rel="stylesheet">
<BR><BR><BR><BR>
<?php 
$querry="SELECT com_id, suma,status,data FROM `comenzi` WHERE user_id='{$id}'";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$comenzi=$statement->fetchAll();
?>


<div class="container"> 

<div class="voucher">
<?php 
$querry="SELECT valoare FROM `voucher` WHERE user_id='{$id}'";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$vouchers=$statement->fetchAll();


foreach($vouchers as $voucher)
{
  if(50==$voucher['valoare'])
  { 
?>
  <img style="width:96px;" src="images/v1.png">
  
<?php  }
   if(100==$voucher['valoare'])
  { 
    ?>
 <img style="width:93px;" src="images/v2.png">
<?php    
  }
   if(200==$voucher['valoare'])
  { 
?>
 <img src="images/v3.png">   
 <?php 
}
   
    

}


?>
</div>





  <h1>Datele dumneavoastra de contact!</h1>
  <div class="avatar">
  <img src="<?php echo $_SESSION['avatar']?>">
  </div>
  <h2><?php  echo $_SESSION['nume'].' '.$_SESSION['prenume']?></h2>


    <div class="formular">
  <form method="post" action="" enctype='multipart/form-data'>  

    <input style=" width:79px;" type='file' name='file' />
    <input type='submit' value='Schimba imaginea' name='but_upload'> 
  </form>
    
    <?php echo $_SESSION['avatar-up']?>
  <h4><?php  echo 'Email: '.$_SESSION['email']?></h4>
  <h5><?php  echo 'Cont: '.$_SESSION['cont']?></h5>
  <h6><?php  echo 'Telefon: +4 0'.$_SESSION['telefon']?></h6>
  </div>




  <div  class="formular-telefon">
  <form method="post" action="telefon.php" >  
    <input type="text" placeholder="Numar nou telefon"  name="telefon">
    <button type='submit' > Schimba nr. </button>
    <h6> <?php echo $_SESSION['ErrTelefon'];?></h6>
  </form>
    </div>


  


  

  <?php 
  
  foreach ($comenzi as $comanda)  
    { ?>
        <div class="comanda">
        <h4> Comanda nr: <?php echo $comanda['com_id']; ?> </h4>
        <h5> Status:
          <?php  if($comanda['status']==0) 
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
                  echo '<asd style="color:green;">Preluata </asd>';
                }
          
          ?>
      
      
      
      </h5>





        <h4> Data: <?php echo $comanda['data']?></h4>
      <h4> Pret: <?php echo $comanda['suma']?> Lei </h4>
    
     <a href="comandaId.php?p=<?php echo $comanda['com_id']?>"> <button> Vezi comanda</button> </a>
     
    
    </div>
 <?php
}  ?>

<br>
</div>  
<br>

<?php 
 $_SESSION['ErrTelefon']='';

require __DIR__.'/bottom.php';?>