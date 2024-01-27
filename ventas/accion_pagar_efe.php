<?php 
	include('../conexion.php');
	$link =Conectarse();
	$tipopago=$_REQUEST['tipo_pago'];
	$cont = 0;
	foreach ($_POST['checked'] as $idsolicitud) {
		
		$qr="select p.idsolicitud, p.idcliente, p.fecha, c.idrepartidor, p.iva, p.subtotal, p.total from pedidos_cliente p left join pedidos_cliente_detalle pd on p.idsolicitud=pd.idsolicitud left join productos pr on pd.idproducto = pr.idproducto left join clientes c on c.idcliente=p.idcliente where p.idestatus <> 7 AND p.idsolicitud='".$idsolicitud."' group by p.idsolicitud";
		$res_encabezado = mysqli_query($link, $qr);
		
		$row_encabezado = mysqli_fetch_array($res_encabezado);
		
		//encabezado nota de venta
		$query="insert into nota_venta (idcliente, fecha, idrepartidor, idestatus, subtotal, iva, total, idtipopago, idsolicitud) values ('".$row_encabezado['idcliente']."', '".$row_encabezado['fecha']."', '".$row_encabezado['idrepartidor']."', 7, '".$row_encabezado['subtotal']."', '".$row_encabezado['iva']."', '".$row_encabezado['total']."', '".$tipopago[$cont]."', '".$row_encabezado['idsolicitud']."')";
		mysqli_query($link, $query);
		
		$idventa=mysqli_insert_id($link);//idventa
		
		//detalle nota de venta
		$querylist="select pd.idproducto, pd.cantidad, pr.costo_venta, pr.costo_venta*pd.peso as importe from pedidos_cliente p left join pedidos_cliente_detalle pd on p.idsolicitud=pd.idsolicitud left join productos pr on pd.idproducto = pr.idproducto left join clientes c on c.idcliente=p.idcliente where p.idestatus <> 7 and p.idsolicitud='".$idsolicitud."'";
		$resulist=mysqli_query($link, $querylist);
		
		while ($rowlist=mysqli_fetch_array($resulist)){
			
			$queryinserdet="insert into nota_venta_detalle (idventa, idproducto, cantidad, precio_unitario, importe) values ('".$idventa."', '".$rowlist['idproducto']."', '".$rowlist['cantidad']."', '".$rowlist['costo_venta']."', '".$rowlist['importe']."')";
			mysqli_query($link, $queryinserdet);
			
		}
		
		
		//actualizacion del pedido encabezado
		$queryped="update pedidos_cliente set idestatus=7 where idsolicitud='".$idsolicitud."'";
		mysqli_query($link, $queryped);
		
		//actualizacion del pedido detalle
		
		$querypeddet="update pedidos_cliente_detalle set idestatus=7 where idsolicitud='".$idsolicitud."'";
		mysqli_query($link, $querypeddet);
		
		$cont++;
		
	}
	
	header("Location: pagos_efectivos.php");
?>