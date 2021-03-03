<?php

$servername = 'localhost';
$dbname = 'château-de-carte';
$db_username = 'root';
$db_password = '';

try{
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $db_username, $db_password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
catch (PDOException $e){
    echo $e->getMessage();
}
?>
