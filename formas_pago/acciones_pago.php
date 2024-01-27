<?php 
	
	include("../conexion.php");
	$link=Conectarse();
	
	$mode = $_REQUEST['mode'];
	
	$idusuario = base64_decode($_COOKIE['iu']);
	
	switch ($mode){
		
		case "insert":
				$txtpago = $_POST['txtpago'];
				
				$sql = "insert into tipo_pago (tipo_pago) values ('".utf8_decode($txtpago)."')";
				$insert = mysqli_query($link, $sql);
				
				if(!$insert){
					echo "2";
				} else {
					echo "1";
				}
				
				
				
		     break;
		
		case "edit":
				$txtpago = $_POST['txtpago'];
				
				$hdnid = $_POST['hdnid'];
				
				$sql = "update tipo_pago set tipo_pago = '".utf8_decode($txtpago)."' where idtipopago = ".$hdnid;
				$update = mysqli_query($link, $sql);
				
				
				if(!$update){
					echo "2";
				} else {
					echo "1";
				}
				
		     break;
		
		case "delete":
				
				$hdnid = $_POST['hdnid'];
				
				$bus = "select count(idventa) as total from nota_venta where idtipopago = ".$hdnid;
				$res_bus = mysqli_query($link, $bus);
				$row_bus = mysqli_fetch_array($res_bus);
				
				if ($row_bus['total'] == 0){
					$sql = "delete from tipo_pago where idtipopago = ".$hdnid;
					$delete = mysqli_query($link, $sql);
					
					if(!$delete){
						echo "2";
					} else {
						echo "1";
					}
					
				} else {
					echo "Existe este tipo de pago ligado a pedidos pagados...";
				}
				
		     break;
    
    }


	
?>