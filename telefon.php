<?php 

session_start();
require __DIR__.'/db-connection.php';

var_dump($_POST);
var_dump($_SESSION);
$telefon=$_POST['telefon'];

if(empty($telefon) || $telefon='' || strlen($telefon)!=10)
{
    $_SESSION['ErrTelefon']='Ai scris numarul gresit!';
    header('Location:contact.php');
    die();
}
$id=intval($_SESSION['id']);
$telefon=intval($_POST['telefon']);
$querry="UPDATE users SET telefon ='{$telefon}' where id='{$id}'";
$statement=$conn->prepare($querry);
$statement->execute();

$_SESSION['ErrTelefon']='<h6 style="color:green;">Numar schimbat!</h6>';
 header('Location:contact.php');
?>