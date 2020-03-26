<br><br><br><br><br>
<?php 

?><center>

</center>

<div class="welcome">  
<div class="welcome-login">
    <center>
<h1>  Bun venit pe magazin! </h1>
<h3> Nu puteti vedea daca nu sunteti logat!</h3>
<br><br>
</center>
<center>
<form method="POST" action="login.php">
<table>
<tr>
    <th>Username </th>
    <th>Password</th>
  </tr>
  <tr>
    <td><input type="text" name="cont"></td>
    <td><input type="password" name="parola"></td>   
</tr>
</table>
<button type="submit"> Login </button>
<p class="error-login"><b>
<?php 
if(isset($_SESSION['error']) )
print_r($_SESSION['error']);
?>
</p></b>
</form>
</center>
</div>
</div>