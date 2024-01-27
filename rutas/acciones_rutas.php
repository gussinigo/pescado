<?php 
	include('../conexion.php');
	$link =Conectarse();
	
	$fecha=date("Y-m-d");
	$idrepartidor=$_REQUEST['idrepartidor'];
	$accion=$_GET['accion'];
	
	/*FECHA SABADO A SABADO*/
	$hoy = date('Y-m-d');
	$ts = strtotime($hoy);
	$start = (date('w',$ts) == 0) ? $ts : strtotime('last sunday', $ts);
	$fechaIni = date('Y-m-d',$start);
	$fechaFin = date('Y-m-d',strtotime('next saturday', $start));
	$filtro2 = " and fecha >= '".$fechaIni."' and fecha <= '".$fechaFin."'";
	
	
	if ($accion == 'editar'){
		$contador=0;
		
		foreach ($_POST['idsol'] as $idsol) {
			$ordenacion=$_POST['orden'][$contador];
			$query="update asignacion_rutas set orden='$ordenacion' where idsolicitud=".$idsol;
			
			mysqli_query($link, $query);
					
			$contador++;
		}
		
		header("Location: listado.php?al=1");
	} else if ($accion == 'eliminar'){
		$idsol = $_GET['idsolicitud'];
		//borrar de rutas
		$query="delete from asignacion_rutas where idsolicitud=".$idsol;		
		mysqli_query($link, $query);
		
		//cambiar estatus a solicitado
		$update="update pedidos_cliente set idestatus=1 where idsolicitud=".$idsol;
		mysqli_query($link, $update);
		
		header("Location: listado_rutas.php?al=1");
	}
	
	else{
		$contador=0;
		foreach ($_POST['idsol'] as $idsol) {
			$ordenacion=$_POST['orden'][$contador];
			$query="insert into asignacion_rutas (idsolicitud, idrepartidor, fecha, orden) values ('$idsol','$idrepartidor','$fecha','$ordenacion')";
			mysqli_query($link, $query);
					
					
			$update="update pedidos_cliente set idestatus=4 where idsolicitud=".$idsol;
			mysqli_query($link, $update);
					
			$contador++;
			
			
			
		}
		header("Location: listado_rutas.php?al=1");
		
	}
	
	
	
	
	
	
?>