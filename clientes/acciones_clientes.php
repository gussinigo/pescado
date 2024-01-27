<?php 
	
	include("../conexion.php");
	$link=Conectarse();
	
	$mode = $_REQUEST['mode'];
	
	$idusuario = base64_decode($_COOKIE['iu']);
	$fecha_actual = date('Y-m-d');
	
	switch ($mode){
		
		case "insert":
				$txtcliente = $_POST['txtcliente'];
				$txtsmz = $_POST['txtsmz'];
				$txtmza = $_POST['txtmza'];
				$txtcalle = $_POST['txtcalle'];
				$txtlote = $_POST['txtlote'];
				$txttel = $_POST['txttel'];
				//$idrepartidor = $_POST['idrepartidor'];
				$txtlat = $_POST['txtlat'];
				$txtlong = $_POST['txtlong'];
				$cumpleanios = $_POST['cumpleanios'];
				$txtresidencial = $_POST['txtresidencial'];
				$txtreferido = $_POST['txtreferido'];
				$idzona = $_POST['idzona'];
				
				$sql = "insert into clientes (cliente,sm,mza,calle,lote,telefono,lat,lng,type,fecha_cumpleanios,residencial,referido,idzona) values ('".utf8_decode($txtcliente)."','".utf8_decode($txtsmz)."','".utf8_decode($txtmza)."','".utf8_decode($txtcalle)."','".utf8_decode($txtlote)."','".utf8_decode($txttel)."','".$txtlat."','".$txtlong."','restaurant','".$cumpleanios."','".utf8_decode($txtresidencial)."','".utf8_decode($txtreferido)."','".$idzona."')";
				$insert = mysqli_query($link, $sql);
				
				if(!$insert){
					echo "2";
				} else {
					echo "1";
				}
				
				
				
		     break;
		
		case "edit":
				$txtcliente = $_POST['txtcliente'];
				$txtsmz = $_POST['txtsmz'];
				$txtmza = $_POST['txtmza'];
				$txtcalle = $_POST['txtcalle'];
				$txtlote = $_POST['txtlote'];
				$txttel = $_POST['txttel'];
				$idrepartidor = $_POST['idrepartidor'];
				$txtlat = $_POST['txtlat'];
				$txtlong = $_POST['txtlong'];
				$cumpleanios = $_POST['cumpleanios'];
				$txtresidencial = $_POST['txtresidencial'];
				$txtreferido = $_POST['txtreferido'];
				$idzona = $_POST['idzona'];
				
				$hdnid = $_POST['hdnid'];
				
				$sql = "update clientes set cliente = '".utf8_decode($txtcliente)."', sm = '".utf8_decode($txtsmz)."', mza = '".utf8_decode($txtmza)."', calle = '".utf8_decode($txtcalle)."', lote = '".utf8_decode($txtlote)."', telefono = '".utf8_decode($txttel)."', lat = '".$txtlat."', lng = '".$txtlong."', fecha_cumpleanios = '".$cumpleanios."', residencial = '".utf8_decode($txtresidencial)."', referido = '".utf8_decode($txtreferido)."', idzona = '".$idzona."' where idcliente = ".$hdnid;
				$update = mysqli_query($link, $sql);
				
			
				
				
				if(!$update){
					echo "2";
				} else {
					echo "1";
				}
				
		     break;
		
		case "delete":
				
				$hdnid = $_POST['hdnid'];
				
				$bus = "select count(idsolicitud) as total from pedidos_cliente where idcliente = ".$hdnid;
				$res_bus = mysqli_query($link, $bus);
				$row_bus = mysqli_fetch_array($res_bus);
				
				if ($row_bus['total'] == 0){
					$sql = "delete from clientes where idcliente = ".$hdnid;
					$delete = mysqli_query($link, $sql);
					
					if(!$delete){
						echo "2";
					} else {
						echo "1";
					}
					
				} else {
					echo "Existen pedidos ligados a este cliente...";
				}
				
		     break;
    
    }


	
?>