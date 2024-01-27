<?php 
	
	include("../conexion.php");
	$link=Conectarse();
	
	
	$mode = $_REQUEST['mode'];

switch ($mode){
	
	case "insert":
	
		$idproveedor = $_POST['idproveedor'];
		$fechaini = $_POST['fechaini'];
		$fechafin = $_POST['fechafin'];
		
		$date = date('Y-m-d');
		
		$return = '';
		
		$qr_insert = "INSERT INTO compras (idproveedor,fecha,idestatus,fecha_inicio,fecha_fin) VALUES ('".$idproveedor."','".$date."', 2, '".$fechaini."','".$fechafin."')";
		$insert = mysqli_query($link, $qr_insert);
		
		if(!$insert){
			$return = "0";
		} else {
			
			$lastid=mysqli_insert_id($link);
		
			/*$qr = "select pd.idproducto, pd.cantidad, pd.idsolicitud, pc.idcliente from pedidos_cliente_detalle pd left join productos p on pd.idproducto=p.idproducto left join pedidos_cliente pc on pc.idsolicitud=pd.idsolicitud left join clientes c on pc.idcliente=c.idcliente left join unidad_medida um on pd.peso_idmedida=um.idmedida where p.idproveedor='".$id."' and pd.idestatus=1";*/
			
			$qr = "select  pc.idsolicitud, pc.idcliente,pd.idproducto,pd.cantidad from pedidos_cliente pc, pedidos_cliente_detalle pd, productos p, clientes c, unidad_medida u where pc.idsolicitud = pd.idsolicitud and pd.idproducto = p.idproducto and pc.idcliente = c.idcliente and pd.idmedida = u.idmedida and pc.fecha between '".$fechaini."' and '".$fechafin."' and p.idproveedor='".$idproveedor."'
	and pd.idestatus=1";
					
			$res_qr = mysqli_query($link, $qr);
			
			while($row = mysqli_fetch_array($res_qr)){
			
				$qr_insert = "INSERT INTO compras_detalle (idcompra, idproducto, cantidad, idsolicitud) VALUES ('".$lastid."','".$row['idproducto']."','".$row['cantidad']."','".$row['idsolicitud']."')";
				$insert2 = mysqli_query($link, $qr_insert);
				
				if(!$insert2){
					$return = "Error al insertar el detalle de la compra...";
				}
				
				/*$query_edit_pc="update pedidos_cliente set idestatus=2 where idcliente='".$row['idcliente']."' AND idsolicitud='".$row['idsolicitud']."'";
				mysqli_query($link, $query_edit_pc);*/
				
				$queryedit="update pedidos_cliente_detalle set idestatus=2 where idproducto='".$row['idproducto']."' AND idsolicitud='".$row['idsolicitud']."'";
				mysqli_query($link, $queryedit);
			
			}
			
		}
		
		if($return == ''){
			$return = $lastid;
		}
		
		echo $return;

		//$url = "pedido_tipo_ticket.php?id=".$id."&idcompra=".$lastid;
		//header("Location: ".$url);
		
	break;
}