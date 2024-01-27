<?php 
	
	include("../conexion.php");
	$link=Conectarse();
	
	$mode = $_REQUEST['mode'];
	$sec = $_REQUEST['sec'];
	
	$idusuario = base64_decode($_COOKIE['iu']);
	$fecha_actual = date('Y-m-d');
	
	switch ($mode){
		
		case "insert":
		    
		    switch($sec){
			    case "1":
			    	 	$txtrepartidor = $_POST['txtrepartidor'];
						$txttel = $_POST['txttel'];
						$idzona = $_POST['idzona'];
						
						
						$sql = "insert into repartidores (repartidor,telefono,idzona) values ('".utf8_decode($txtrepartidor)."','".utf8_decode($txttel)."','".$idzona."')";
						$insert = mysqli_query($link, $sql);
						
						if(!$insert){
							echo "2";
						} else {
							echo "1";
						}
			    	 
			         break;
			    
			    case "2":
			    		$txtzona = $_POST['txtzona'];
						$txtdescripcion = $_POST['txtdescripcion'];
						
						$sql = "insert into zonas (zona,descripcion) values ('".utf8_decode($txtzona)."','".utf8_decode($txtdescripcion)."')";
						$insert = mysqli_query($link, $sql);
						
						if(!$insert){
							echo "2";
						} else {
							echo "1";
						}
			    		
			    		
			        break;
			    
		    }
				
				
				
				
		     break;
		
		case "edit":
			
			switch($sec){
			    case "1":
					$txtrepartidor = $_POST['txtrepartidor'];
					$txttel = $_POST['txttel'];
					$idzona = $_POST['idzona'];
					
					$hdnid = $_POST['hdnid'];
					
					$sql = "update repartidores set repartidor = '".utf8_decode($txtrepartidor)."', telefono = '".utf8_decode($txttel)."', idzona='".$idzona."' where idrepartidor = ".$hdnid;
					$update = mysqli_query($link, $sql);
					
					if(!$update){
						echo "2";
					} else {
						echo "1";
					}
					
				break;
				
				case "2":
					$txtzona = $_POST['txtzona'];
					$txtdescripcion = $_POST['txtdescripcion'];
					
					$hdnid = $_POST['hdnid'];
					
					$sql = "update zonas set zona = '".utf8_decode($txtzona)."', descripcion = '".utf8_decode($txtdescripcion)."' where idzona = ".$hdnid;
					$update = mysqli_query($link, $sql);
					
					if(!$update){
						echo "2";
					} else {
						echo "1";
					}
				
				break;
			}
				
		 break;
		
		case "delete":
		    
		    switch($sec){
			    case "1":
				
					$hdnid = $_POST['hdnid'];
					
					
					
					$sql = "delete from repartidores where idrepartidor = ".$hdnid;
					$delete = mysqli_query($link, $sql);
					
					if(!$delete){
						echo "2";
					} else {
						echo "1";
					}
				
				break;
				
				case "2":
					
					$hdnid = $_POST['hdnid'];
					
					$bus = "select count(idrepartidor) as total from repartidores where idzona=".$hdnid;
					$res_bus = mysqli_query($link, $bus);
					$row_bus = mysqli_fetch_array($res_bus);
					
					if ($row_bus['total'] == 0){
						$sql = "delete from zonas where idzona = ".$hdnid;
						$delete = mysqli_query($link, $sql);
						
						if(!$delete){
							echo "2";
						} else {
							echo "1";
						}
					
					} else {
						echo "La zona tiene repartidores asignados...";
					}
					
					
					
				break;
			}
					
								
		  break;
    
    }


	
?>