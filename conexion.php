<?php

function Conectarse()
{ 
$dbhost="localhost";

/*$db_nombre='ginigo_buenPescadoDev';
$db_user="ginigo_pescado";
$db_pass="elBuenPescado";*/

$db_nombre='elbuenpe_dev';
$db_user="elbuenpe_devuser";
$db_pass="D1g1t4l3g4$$";

$link = mysqli_connect($dbhost, $db_user, $db_pass, $db_nombre);
return $link;
}

function closeConn($link) {
   //mysql_close($link);
    mysqli_close($link);
}


?>