<?php 
$servername='localhost';
$username='root';
$password='';
try {
    $conn=new PDO("mysql:host=$servername;dbname=market",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    // echo 'conectat';
}
catch(PDOException $e)
{
    echo 'Conectend failed'.$e->getMesage();

}
?>