<?php 
session_start();
// if (isset($_SESSION['login']) && $_SESSION['login'] === 1) {
//     header('Location: home.php');
// }
include __DIR__.'/helpers.php';
include __DIR__ . '/initprod.php';

    
include __DIR__.'/navbar.php';

printSignup();
?>

<html>
<head>
<title>   Shop-contact     </title>
<link href="main.css" type="text/css" rel="stylesheet">
<link href="welcome.css" type="text/css" rel="stylesheet">
 </head>
<body>

<br><br><br><br>
<div class="container">


<?php 






?>


</div><br><br>
<?php 
include __DIR__.'/bottom.php';
?>
</body>
</html>