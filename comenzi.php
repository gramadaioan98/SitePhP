<?php 
session_start();
require __DIR__.'/db-connection.php';
$id=$_SESSION['id'];
echo $id;
$querry="SELECT  cm.com_id,pc.produs_id, pr.nameP,pr.price,pr.image  FROM `comenzi` as cm
JOIN produse_comenzi as pc ON cm.com_id=pc.com_id
JOIN products as pr ON pr.idP=pc.produs_id
 JOIN users as us ON us.id=cm.user_id WHERE us.id=$id";
$statement=$conn->prepare($querry);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$results=$statement->fetchAll();

var_dump($results);
var_dump($_SESSION);








?>