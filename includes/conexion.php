<?php
session_start();
//primero es la conexion y luego el query
function Conectarse()
{


/*$db_host="198.57.244.39"; 
$db_nombre="prcconta_repositorio";
$db_user="prcconta_usrepo";
$db_pass="hPe4=5@D83Z8"; */

$db_host="192.232.217.125"; 
$db_nombre='elbuenpe_dev';
$db_user="elbuenpe_devuser";
$db_pass="D1g1t4l3g4$$";

  try {
      $conn = new PDO("mysql:host=$db_host;dbname=$db_nombre", $db_user, $db_pass);
      //echo "Connected to $db_nombre at $db_host successfully.";
      
      return $conn;
      
  } catch (PDOException $pe) {
      die("Could not connect to the database $db_nombre :" . $pe->getMessage());
  }

}


?>