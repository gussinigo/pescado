<?php 
	
	include("../conexion.php");
	$link=Conectarse();
	
	$mode = $_REQUEST['mode'];
	
	$idusuario = base64_decode($_COOKIE['iu']);
	$fecha_actual = date('Y-m-d');
	
	switch ($mode){
		
		case "insert":
				$txtproveedor = $_POST['txtproveedor'];
				$txttel = $_POST['txttel'];
				
				$sql = "insert into proveedores (proveedor,telefono) values ('".utf8_decode($txtproveedor)."','".utf8_decode($txttel)."')";
				$insert = mysqli_query($link, $sql);
				
				if(!$insert){
					echo "2";
				} else {
					echo "1";
				}
				
				
				
		     break;
		
		case "edit":
				$txtproveedor = $_POST['txtproveedor'];
				$txttel = $_POST['txttel'];
				
				$hdnid = $_POST['hdnid'];
				
				$sql = "update proveedores set proveedor = '".utf8_decode($txtproveedor)."', telefono = '".utf8_decode($txttel)."' where idproveedor = ".$hdnid;
				$update = mysqli_query($link, $sql);
				
				if(!$update){
					echo "2";
				} else {
					echo "1";
				}
				
		     break;
		
		case "delete":
				
				$hdnid = $_POST['hdnid'];
				
				$bus = "select count(idproducto) as total from productos where idproveedor = ".$hdnid;
				$res_bus = mysqli_query($link, $bus);
				$row_bus = mysqli_fetch_array($res_bus);
				
				if ($row_bus['total'] == 0){
					$sql = "delete from proveedores where idproveedor = ".$hdnid;
					$delete = mysqli_query($link, $sql);
					
					if(!$delete){
						echo "2";
					} else {
						echo "1";
					}
					
				} else {
					echo "Existen productos ligados a este proveedor...";
				}
				
		     break;
    
    }


	
?>