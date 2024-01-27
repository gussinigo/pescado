<?php 
	
	include("../conexion.php");
	$link=Conectarse();
	
	$mode = $_REQUEST['mode'];
	
	$idusuario = base64_decode($_COOKIE['iu']);
	$fecha_actual = date('Y-m-d');
	
	switch ($mode){
		
		case "insert":
				$txtproducto = $_POST['txtproducto'];
				$txtcodigo = $_POST['txtcodigo'];
				$txtcostocompra = $_POST['txtcostocompra'];
				$txtcostoventa = $_POST['txtcostoventa'];
				$idproveedor = $_POST['idproveedor'];
				
				$sql = "insert into productos (codigo,producto,idproveedor,costo_compra,costo_venta) values ('".utf8_decode($txtcodigo)."','".utf8_decode($txtproducto)."','".$idproveedor."','".$txtcostocompra."','".$txtcostoventa."')";
				$insert = mysqli_query($link, $sql);
				
				if(!$insert){
					echo "2";
				} else {
					echo "1";
				}
				
				
				
		     break;
		
		case "edit":
				$txtproducto = $_POST['txtproducto'];
				$txtcodigo = $_POST['txtcodigo'];
				$txtcostocompra = $_POST['txtcostocompra'];
				$txtcostoventa = $_POST['txtcostoventa'];
				$idproveedor = $_POST['idproveedor'];
				
				$hdnid = $_POST['hdnid'];
				
				$sql = "update productos set codigo = '".utf8_decode($txtcodigo)."', producto = '".utf8_decode($txtproducto)."', idproveedor='".$idproveedor."', costo_compra='".$txtcostocompra."', costo_venta='".$txtcostoventa."' where idproducto = ".$hdnid;
				$update = mysqli_query($link, $sql);
				
				if(!$update){
					echo "2";
				} else {
					echo "1";
				}
				
		     break;
		
		case "delete":
				
				$hdnid = $_POST['hdnid'];
				
				
				
				$sql = "delete from productos where idproducto = ".$hdnid;
				$delete = mysqli_query($link, $sql);
				
				if(!$delete){
					echo "2";
				} else {
					echo "1";
				}
					
								
		     break;
    
    }


	
?>