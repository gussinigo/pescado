<?php 

include("../conexion.php");
$link=Conectarse();


$campos=mysqli_query($link,"SELECT * FROM productos");

     echo '<option value="">Seleccione una opcion</option>';
     echo '<optgroup label="cliente">';
     
while( $row= mysqli_fetch_assoc($campos)){
		echo "<option value='".$row['idproducto']."'>".$row['codigo'].' - '.utf8_encode($row['producto'])."</option>";
}

	echo '</optgroup>';

closeConn($link);

?>