<?php

session_start();
require __DIR__.'/db-connection.php';

if($_SESSION['admin']==='1')
{
  // echo 'pagina de eroare';
  echo '<br>';
}else
{
header('Location:home.php');
}
include("config.php");

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
 
    // Convert to base64 
    $image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
    $image = 'data:image/'.$imageFileType.';base64,'.$image_base64;
    // Insert record
    $query = "INSERT INTO products (nameP,price,image,stock) VALUE('$_POST[nameP]','$_POST[price]','$target_file','$_POST[stock]')";
 
    $conn->exec($query);
    // Upload file
    move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
  }
  header('Location:Market.php');
}
?>
<style>
body{

  background:rgb(230, 230, 230);
}
.container {
 
  border:10px solid rgb(174, 73, 214);
  width:280px;
  border-radius:20px;
  height:390px;
  background-color:rgb(237, 223, 235);
  font-family: Verdana, Geneva, Tahoma, sans-serif;

  }

  .container input{  
    float:right; 
    margin:15px;
     background-color:rgb(148, 118, 144); 
    color:white;
    font-weight:500;
    }
  .container form h3 {
    float:left;
    margin:15px;
    padding:0px;
    font-size:15px;
  }
</style>
<center>
<div class="container">
  <h2>Adaugare produs!</h2>
<form method="post" action="" enctype='multipart/form-data'>
  <h3>Nume:</h3>
  <input type="text" value="Maxim 22 lietere!" name="nameP"/>  <br>
  <h3>Price:</h3>
  <input type="text" value="" name="price"/>  <br>
  <h3>Image:</h3>
  <input style="border:1px solid; width:250px;" type='file' name='file' /><br>
  
  <h3> Stock:</h3>
  <input type="text" value="" name="stock"/>  <br><br><br>
  <input type='submit' value='Save name' name='but_upload'> <br>
  <input type='reset' value='Reset' > <br>

</form>
</div >
</center>