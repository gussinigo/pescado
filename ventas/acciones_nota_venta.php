<?php 
	
	include('../conexion.php');
	$link = Conectarse();
	$dir = '../';
	
	$mode=$_REQUEST['mode'];
	$idsolicitud=$_REQUEST['id'];
	
	switch($mode){
	
		case 'insert':
			$idsolicitud=$_POST['id'];
			$tipo_pago = $_POST['tipo_pago'];
			$referencia = $_POST['referencia'];
		
			$qr="select p.idsolicitud, p.idcliente, p.fecha, c.idrepartidor, p.iva, p.subtotal, p.total from pedidos_cliente p left join pedidos_cliente_detalle pd on p.idsolicitud=pd.idsolicitud left join productos pr on pd.idproducto = pr.idproducto left join clientes c on c.idcliente=p.idcliente where p.idestatus <> 7 AND p.idsolicitud='".$idsolicitud."' group by p.idsolicitud";
			$res_encabezado = mysqli_query($link, $qr);
			
			$row_encabezado = mysqli_fetch_array($res_encabezado);
			
			//encabezado nota de venta
			$query="insert into nota_venta (idcliente, fecha, idrepartidor, idestatus, subtotal, iva, total, idtipopago, referencia, idsolicitud) values ('".$row_encabezado['idcliente']."', '".$row_encabezado['fecha']."', '".$row_encabezado['idrepartidor']."', 7, '".$row_encabezado['subtotal']."', '".$row_encabezado['iva']."', '".$row_encabezado['total']."', '".$tipo_pago."', '".$referencia."', '".$row_encabezado['idsolicitud']."')";
			$ins = mysqli_query($link, $query);
			
			$idventa=mysqli_insert_id($link);
			
			if(!$ins){
				echo "2";
			} else {
			
				//detalle nota de venta
				$querylist="select pd.idproducto, pd.cantidad, pr.costo_venta, pr.costo_venta*pd.peso as importe from pedidos_cliente p left join pedidos_cliente_detalle pd on p.idsolicitud=pd.idsolicitud left join productos pr on pd.idproducto = pr.idproducto left join clientes c on c.idcliente=p.idcliente where p.idestatus <> 7 and p.idsolicitud='".$idsolicitud."'";
				$resulist=mysqli_query($link, $querylist);
				
				while ($rowlist=mysqli_fetch_array($resulist)){
					
					$queryinserdet="insert into nota_venta_detalle (idventa, idproducto, cantidad, precio_unitario, importe) values ('".$idventa."', '".$rowlist['idproducto']."', '".$rowlist['cantidad']."', '".$rowlist['costo_venta']."', '".$rowlist['importe']."')";
					$res = mysqli_query($link, $queryinserdet);
				
				}
				
				if(!$res){
					echo "3";
				} else {
				
					//actualizacion del pedido encabezado
					$queryped="update pedidos_cliente set idestatus=7 where idsolicitud='".$idsolicitud."'";
					$upd = mysqli_query($link, $queryped);
					
					if(!$upd){
						echo "4";
					} else {
					
					//actualizacion del pedido detalle
					
					$querypeddet="update pedidos_cliente_detalle set idestatus=7 where idsolicitud='".$idsolicitud."'";
					$upd = mysqli_query($link, $querypeddet);
					
						if(!$upd){
							echo "5";
						} else {
							echo "1";
						}
					
					}
				}
			}
		break;
		
		case 'update':
			
			$idsolicitud=$_POST['id'];
			$tipo_pago = $_POST['tipo_pago'];
			$referencia = $_POST['referencia'];
			
			$qr = "UPDATE nota_venta SET idtipopago = '".$tipo_pago."', referencia = '".$referencia."' WHERE idsolicitud ='".$idsolicitud."' ";
			$upd = mysqli_query($link, $qr);
			
			if(!$upd){
				echo "2";
			} else {
				echo "1";
			}
		
		break;
		
		case 'delete':
			
			$idventa=$_POST['id'];
			
			$qr = "SELECT idsolicitud FROM nota_venta WHERE idventa = '".$idventa."'";
			$res = mysqli_query($link, $qr);
			$row = mysqli_fetch_array($res);
			
			//actualizacion del pedido encabezado
			$queryped="update pedidos_cliente set idestatus=6 where idsolicitud='".$row['idsolicitud']."'";
			$upd = mysqli_query($link, $queryped);
			
			if(!$upd){
				echo "2";
			} else {
			
				//actualizacion del pedido detalle
				$querypeddet="update pedidos_cliente_detalle set idestatus=6 where idsolicitud='".$row['idsolicitud']."'";
				$upd = mysqli_query($link, $querypeddet);
				
				if(!$upd){
					echo "3";
				} else {
					
					$qr = "DELETE FROM nota_venta_detalle WHERE idventa = '".$idventa."'";
					$del = mysqli_query($link, $qr);
					
					if(!$del){
						echo "4";
					} else {
						
						$qr = "DELETE FROM nota_venta WHERE idventa = '".$idventa."'";
						$del = mysqli_query($link, $qr);
						
						if(!$del){
							echo "5";
						} else {
							echo "1";
						}
					}
				}
			}
			
		break; 
	
	}
	
?>