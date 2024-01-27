<?php 
	/* PASO 3*/
	$lastinsert=mysqli_insert_id($link);
	
	/*PASO 4*/
	$idproveedor=1;
	
	
	$query="select * from pedidos_cliente_detalle pd left join productos p on pd.idproducto=p.idproducto left join pedidos_cliente pc on  pc.idsolicitud=pd.idsolicitud left join clientes c on pc.idcliente=c.idcliente  where p.idproveedor=$idproveedor and pc.idestatus=1";
	
	$result = mysqli_query($link, $query);
	
	while ($row =mysqli_fetch_array($result)){
		$idproducto=$row['idproducto'];
		$cantidad=$row['cantidad'];
		$queryinsert="INSET INTO COMPRAS_DETALLE (idcompra, idproducto, cantidad) VALUES ('$lastinsert','$idproducto','$cantidad',)";
		mysqli_query($link, $queryinsert);
		/*paso 5*/
		$queryedir="update pedidos_cliente_detalle set idestatus=2 where idproducto=".$row['idproudcto'];
		mysqli_query($link, $queryedir)
		
		
		
	}

?>



/* PASO 1 LISTADO*/
select *, (select ps.proveedor from proveedores ps where ps.idproveedor=p.idproveedor) as proveedor from pedidos_cliente_detalle pd left join productos p on pd.idproducto=p.idproducto left join pedidos_cliente pc on  pc.idsolicitud=pd.idsolicitud 
where pc.idestatus=1
group by idproveedor; /* sacas el idproveedor*/


/*PASO 2 DETALLE*/
select * from pedidos_cliente_detalle pd left join productos p on pd.idproducto=p.idproducto left join pedidos_cliente pc on  pc.idsolicitud=pd.idsolicitud left join clientes c on pc.idcliente=c.idcliente where p.idproveedor=1 and pc.idestatus=1;

/*PASO 3 INSERCCION ENCABEZA COMPRAS*/
INSERT INTO COMPRAS (idproveedor, fecha, idestatus ) VALUES ( ); /*OBTIENE LASINSERT ID (idcompra). estatus:1 Y 5*/


/*PASO 4 INSERCCION EN DETALLE COMPRAS. FOR O WHILE*/
INSET INTO COMPRAS_DETALLE (idcompra, idproducto, cantidad) VALUES ();


/*paso 5 edicion de estatus del producto*/
update pedidos_cliente_detalle set idestatus=2 where idproducto=$idproducto /*el que obtienes en el paso 2*/



/*COMPRAS SOLICITADAS*/
select * from compras c left join proveedores p on c.idproveedor=p.idproveedor group by c.idproveedor; /*obtiene idproveedor*/


select * from compras c left join compras_detalle d on c.idcompra=d.idcompra where idproveedor=1;