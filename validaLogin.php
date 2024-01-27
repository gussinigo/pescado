<?php

$l=(isset($_REQUEST['log']))? $_REQUEST['log'] : ""; //Determina si una variable está definida y no es NULL.
$p=(isset($_REQUEST['pass']))? $_REQUEST['pass'] : "";


header("Content-Type: text/html;charset=utf-8");

if($l!=""&&$p!="")
	validar($l,$p);
else
	header("Location: index.php");
	//echo "no pasa";
	
	

function validar($log,$pass)
{
	
	include("conexion.php");
     $link=Conectarse(); 
	
	$sql="select idusuario, usuario ,contrasena, nombre, apellidos, idtipo_usuario from usuario where usuario='".$log."' and contrasena='".$pass."'";
		$result= mysqli_query($link,$sql); // Realiza la consulta a la base de datos
		
		
		//echo $sql;
		
	
 	//Devuelve un array que corresponde a la fila recuperada
		$row=mysqli_fetch_array($result);
		$idusuario=base64_encode($row['idusuario']);
		$usuario=base64_encode($row['usuario']);
		$idrol=base64_encode($row['contrasena']);
		$nombre=$row['nombre'];
		$apellidos=$row['apellidos'];
		$idtipo_usuario = base64_encode($row['idtipo_usuario']);
	
	  //Devuelve el número de filas de un conjunto de resultados de una sentencia
		if(mysqli_num_rows($result)>0)
		 {
            
            
	        setcookie('iu',$idusuario,time()+43200,'/');
	        setcookie('us',$usuario,time()+43200,'/');
	        setcookie('nombre',$nombre,time()+43200,'/');
	        setcookie('apellidos',$apellidos,time()+43200,'/');
	        setcookie('tus',$idtipo_usuario,time()+43200,'/');
	            
           
            
            closeConn($link);

            header("Location: home.php");
	     }
	   else
	     { 
		    closeConn($link);
		    
		    
			echo "<script>";
			echo "alert('Username and/or password are incorrect...');";  
			echo "window.location.href='index.php';";
			echo "</script>";
		    
			
		 }
	
	
}
?>
