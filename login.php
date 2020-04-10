<?php 
session_start();
include __DIR__.'/helpers.php';
include __DIR__.'/navbar.php';
require __DIR__.'/db-connection.php';
// $server_username='admin';
// $server_password='pass';


// $username=$_POST['username'];
// $password=$_POST['password'];
// $_SESSION['error']='';
// if($server_username===$username && $server_password===$password)
// {
//     $_SESSION['login']=1;
//     header('Location:home.php');
//     $_SESSION['name']='Ionut';
// }
// else
// {
//     $_SESSION['error']='Nume sau parola gresita!';
//     header('Location:index.php');   
   
// }

if(empty($_POST['cont']) || empty($_POST['parola']))
header('Location:index.php');

$cont=$_POST['cont'];
echo $cont;
$parola=$_POST['parola'];
echo $parola;

$querry="SELECT * FROM users WHERE cont='{$cont}'";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$results=$statement->fetchAll();

if(!count($results))
{
    $_SESSION['error']='Nume sau parola gresita!';
    header('Location:index.php');
}
else
{
    $_SESSION['error']='';
 $user=$results[0];
$_SESSION['auth']=true;
$_SESSION['id']=$user['id'];
$_SESSION['nume']=$user['nume'];
$_SESSION['prenume']=$user['prenume'];
$_SESSION['cont']=$user['cont'];
$_SESSION['email']=$user['email'];
$_SESSION['sign']=1;
$_SESSION['admin']=$user['admin'];
$_SESSION['telefon']=$user['telefon'];
$_SESSION['avatar']=$user['avatar'];
header('Location:home.php');
}
echo '<pre>';
var_dump($_SESSION);
if (password_verify($_POST['parola'], $user['parola']))
echo '<BR>parola corecta';
else{
    header('Location:login.php');
    $_SESSION['error']='Nume sau parola gresita!';
}
?>
