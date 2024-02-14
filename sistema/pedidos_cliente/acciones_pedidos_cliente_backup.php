<?php 
	
	include("../conexion.php");
	$link=Conectarse();
	
	$mode = $_REQUEST['mode'];
	
	$idusuario = base64_decode($_COOKIE['iu']);
	$fecha_actual = date('Y-m-d');
	
	switch ($mode){
		
		case "insert":
				$idcliente = $_POST['idcliente'];
				$hdnlistaproductos = $_POST['hdnlistaproductos'];
				$return = '';
				
				$sql = "insert into pedidos_cliente (idcliente,fecha,idestatus) values ('".$idcliente."','".$fecha_actual."','1')";
				$insert = mysqli_query($link, $sql);
				
				if(!$insert){
					$return = "0";
				} else {
					$lastID = mysqli_insert_id($link);
					$listadesc = explode("|", $hdnlistaproductos);
					
					$subtotal = 0;
					$costo = 0;
					$iva = 0;
					$total = 0;
				
					for($i=0; $i < count($listadesc); $i++){
						$elementos = explode("*", $listadesc[$i]);
						$ids = explode("-",$elementos[0]);
						
						$idproducto = $ids[0];
						$idumedida = $ids[1];
						$idumedidapeso = $ids[2];
						
						$cantidad = $elementos[1];
						$peso = $elementos[2];
						
						$qr1 = "select costo_venta from productos where idproducto = ".$idproducto;
						$res_qr1 = mysqli_query($link, $qr1);
						$row_qr1 = mysqli_fetch_array($res_qr1);
						
						if($idumedida == '1'){
							$costo = $peso * $row_qr1['costo_venta'];
						} else {
							$costo = $cantidad * $row_qr1['costo_venta'];
						}
						
						$subtotal = $subtotal + $costo;
						
						$qr = "insert into pedidos_cliente_detalle (idsolicitud,idproducto,cantidad,idmedida,peso,peso_idmedida,idestatus) values ('".$lastID."','".$idproducto."','".$cantidad."','".$idumedida."','".$peso."','".$idumedidapeso."','1') ";
						$insert2 = mysqli_query($link, $qr);
						
						if(!$insert2){
							$return = 'Error al insertar el detalle de los productos...';
						}
						
						
					}
					
					$iva = $subtotal * 0.16;
					$total = $subtotal + $iva;
					
					$qr2 = "update pedidos_cliente set subtotal='".$subtotal."', iva='".$iva."', total='".$total."' where idsolicitud = ".$lastID;
					$update2 = mysqli_query($link, $qr2);
					
					if(!$update2){
						$return = 'Error al actualizar los totales de la solicitud...';
					}
					
				}
				
				if($return == ''){
					$return = $lastID;
				}
				
				echo $return;
				

		     break;
		
		case "edit":
				$idcliente = $_POST['idcliente'];
				$hdnlistaproductos = $_POST['hdnlistaproductos'];
				$return = '';
								
				$hdnid = $_POST['hdnid'];
			
				
				$sql = "update pedidos_cliente set idcliente = '".$idcliente."'  where idsolicitud = ".$hdnid;
				$update = mysqli_query($link, $sql);
				
				if(!$update){
					$return = "0";
				} else {
					
					$sql_del = "delete from pedidos_cliente_detalle where idestatus = 1 and idsolicitud = ".$hdnid;
					$delete = mysqli_query($link, $sql_del);
					
					if(!$delete){
						$return = 'Error al actualizar los productos...';
					} else {
						
						$listadesc = explode("|", $hdnlistaproductos);
						
						$subtotal = 0;
						$costo = 0;
						$iva = 0;
						$total = 0;
				
						for($i=0; $i < count($listadesc); $i++){
							$elementos = explode("*", $listadesc[$i]);
							$ids = explode("-",$elementos[0]);
							
							$idproducto = $ids[0];
							$idumedida = $ids[1];
							$idumedidapeso = $ids[2];
							
							$cantidad = $elementos[1];
							$peso = $elementos[2];
							
							$qr1 = "select costo_venta from productos where idproducto = ".$idproducto;
							$res_qr1 = mysqli_query($link, $qr1);
							$row_qr1 = mysqli_fetch_array($res_qr1);
							
							if($idumedida == '1'){
								$costo = $peso * $row_qr1['costo_venta'];
							} else {
								$costo = $cantidad * $row_qr1['costo_venta'];
							}
							
							$subtotal = $subtotal + $costo;
							
							$qr = "insert into pedidos_cliente_detalle (idsolicitud,idproducto,cantidad,idmedida,peso,peso_idmedida,idestatus) values ('".$hdnid."','".$idproducto."','".$cantidad."','".$idumedida."','".$peso."','".$idumedidapeso."','1') ";
							$insert2 = mysqli_query($link, $qr);
							
							if(!$insert2){
								$return = 'Error al insertar el detalle de los productos...';
							}
							
							
						}
						
						$iva = $subtotal * 0.16;
						$total = $subtotal + $iva;
						
						$qr2 = "update pedidos_cliente set subtotal='".$subtotal."', iva='".$iva."', total='".$total."' where idsolicitud = ".$hdnid;
						$update2 = mysqli_query($link, $qr2);
						
						if(!$update2){
							$return = 'Error al actualizar los totales de la solicitud...';
						}
						
						
					}
					
				}
				
				if($return == ''){
					$return = $hdnid;
				}
				
				echo $return;
				
		     break;
		
		case "delete":
				
				$hdnid = $_POST['hdnid'];
				
				
				
				$sql = "delete from pedidos_cliente_detalle where idsolicitud = ".$hdnid;
				$delete = mysqli_query($link, $sql);
				
				if(!$delete){
					echo "2";
				} else {
					
					$sql2 = "delete from pedidos_cliente where idsolicitud = ".$hdnid;
					$delete2 = mysqli_query($link, $sql2);
					
					if(!$delete2){
						echo "2";
					
					} else {
						echo "1";
					}
					
				}
					
								
		     break;
    
    }


	
?>