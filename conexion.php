<?php

function Conectarse()
{ 
$dbhost="localhost";

/*$db_nombre='ginigo_buenPescadoDev';
$db_user="ginigo_pescado";
$db_pass="elBuenPescado";*/

$db_nombre='elbuenpe_main';
$db_user="elbuenpe_maite";
$db_pass="3lbu3np3sc4d0";

$link = mysqli_connect($dbhost, $db_user, $db_pass, $db_nombre);
return $link;
}

function closeConn($link) {
   //mysql_close($link);
    mysqli_close($link);
}


?>