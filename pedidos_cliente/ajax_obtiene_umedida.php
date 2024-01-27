<?php 

include("../conexion.php");
$link=Conectarse();

$tipo = $_REQUEST['tipo'];

if ($tipo == '1'){
	$campos=mysqli_query($link,"SELECT * FROM unidad_medida");
} else {
	$campos=mysqli_query($link,"SELECT * FROM unidad_medida where idmedida != 1");
}


     echo '<option value="">Seleccione una opcion</option>';
     echo '<optgroup label="U. Medida">';
     
while( $row= mysqli_fetch_assoc($campos)){
		echo "<option value='".$row['idmedida']."'>".utf8_encode($row['umedida'])."</option>";
}

	echo '</optgroup>';

closeConn($link);

?>