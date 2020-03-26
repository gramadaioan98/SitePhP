<?php 
$querry="SELECT * FROM products ";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$results=$statement->fetchAll();
$produse=$results;


?>