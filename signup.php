<?php 
include __DIR__.'/helpers.php';
session_start();
printLogout();
if(isset($_SESSION['cont']) && $_SESSION['cont']!='')
    header('location:home.php');
require __DIR__.'/db-connection.php';

include __DIR__.'/navbar.php';
?>
<br><br><br><br>
<div class="container-signup">
  <center><BR>

<form action="create-user.php" method="POST"><BR><BR>
<h5>Creaza-ti cont! </h5>

<BR>
<h4>Nume:</h4><BR>
<input class="asd" type="text" name="nume"/>
<h4>Prenume:</h4><BR>
<input class="asd" type="text" name="prenume"/>
<h4>Cont:</h4><BR>
<input class="asd" type="text" name="cont"/>
<h4>Email:</h4><BR>
<input class="asd" type="text" name="email"/>
<h4>Parola:</h4><BR>
<input class="asd" type="password" name="parola"/>
<h4><button type="submit">Sign Up</button></h4>
<BR><h2><?php echo $_SESSION['eror']?> </h2>
</form><BR><BR><BR><BR>
</center>
</div>

<?php $_SESSION['eror']='';

include __DIR__.'/bottom.php';

?>