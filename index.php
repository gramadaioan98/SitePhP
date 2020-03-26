<?php 
session_start();
require __DIR__.'/db-connection.php';
// if (isset($_SESSION['login']) && $_SESSION['login'] === 1) {
//     header('Location: home.php');
// }
$_SESSION['cont'] ='';
$_SESSION['admin']='0';
include __DIR__.'/helpers.php';
// include __DIR__ . '/initprod.php';
 
    $_SESSION['eror']='';
    
include __DIR__.'/navbar.php';

printLogout();
?>

<html>
<head>
<title>   Shop     </title>

 </head>
<body>

<br><br><br><br>
<div class="container">


<?php 

include __DIR__.'/welcome.php';



?>
<br><br><br><br>

</div><br>
<?php 
// echo '<pre>';
// var_dump($_SESSION);
include __DIR__.'/bottom.php';
?>
</body>
</html>