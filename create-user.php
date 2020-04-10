<?php 
session_start();
require __DIR__.'/db-connection.php';

if(empty($_POST['nume']) ||empty($_POST['prenume']) ||empty($_POST['cont'])||empty($_POST['email']) ||empty($_POST['parola'])  )
 { if(empty($_POST['nume']))
 {   
    $_SESSION['eror']='Ai uitat numele!';
  header ('Location:signup.php');
  }
  elseif(empty($_POST['prenume']))
  {   
    $_SESSION['eror']='Ai uitat prenumele!';
  header ('Location:signup.php');
  } 
  elseif(empty($_POST['cont']))
  {   
    $_SESSION['eror']='Ai uitat contul!';
  header ('Location:signup.php');
  }
  elseif(empty($_POST['email']))
  {   
    $_SESSION['eror']='Ai uitat Email-ul!';
  header ('Location:signup.php');
  }
  elseif(empty($_POST['parola']))
  {   
    $_SESSION['eror']='Ai uitat parola!';
  header ('Location:signup.php');
  }
 }
 else
 {$_SESSION['eror']='Cont creat cu succesc!';}
 

  


echo '<pre>';
var_dump($_SESSION);
var_dump($_POST);

$nume=$_POST['nume'];
$prenume=$_POST['prenume'];
$cont=$_POST['cont'];
$email=$_POST['email'];
$parola=$_POST['parola'];
$admin=0;
$hash=password_hash($parola,PASSWORD_BCRYPT);
$query="INSERT INTO users (id,nume,prenume,cont,email,parola,admin,avatar) VALUE  (NULL,'{$nume}','{$prenume}','{$cont}','{$email}','{$hash}',0,'upload/avatar.jpg')";
$conn->exec($query);
header('Location:signup.php');
?>
