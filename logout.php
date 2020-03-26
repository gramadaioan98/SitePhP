<?php 

session_start();
session_unset();
$_SESSION['auth']=false;
$_SESSION['id']='';
$_SESSION['nume']='';
$_SESSION['prenume']='';
$_SESSION['cont']='';
$_SESSION['email']='';
$_SESSION['sign']=0;
header('Location:index.php');



?>