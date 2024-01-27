<?php 
	
	include('../conexion.php');
	$link = Conectarse();
	$dir = '../';
	
	$id = $_REQUEST['id'];
	$fechaIni = $_REQUEST['fechaini'];
	$fechaFin = $_REQUEST['fechafin'];
	
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>El Buen Pescado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="<?php echo $dir; ?>assets/img/logo-48x48_c.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo $dir; ?>assets/img/logo-48x48_c.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo $dir; ?>assets/img/logo-48x48_c@2x.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo $dir; ?>assets/img/logo-48x48_c@2x.png">
    <link rel="icon" type="image/x-icon" href="<?php echo $dir; ?>assets/img/logo-48x48_c.png" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="Meet pages - The simplest and fastest way to build web UI for your dashboard or app." name="description" />
    <meta content="Ace" name="author" />
    <link href="<?php echo $dir; ?>assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $dir; ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $dir; ?>https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo $dir; ?>assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo $dir; ?>assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo $dir; ?>assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $dir; ?>assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $dir; ?>assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link class="main-stylesheet" href="<?php echo $dir; ?>pages/css/pages.css" rel="stylesheet" type="text/css" />
    <!-- Please remove the file below for production: Contains demo classes -->
    <link class="main-stylesheet" href="<?php echo $dir; ?>assets/css/style.css" rel="stylesheet" type="text/css" />
    <style>
	    .trresponsive{ border-bottom: solid !important;
	    }
	    
	    .textcolor{
		    color: #000 !important;
	    }
	    
    </style>
    
    <script>
	    
	    function fnEditar(id){
		    var fechaini = $('#hdnfechaini').val();
		    var fechafin = $('#hdnfechafin').val();
		    var idproveedor = $('#hdnidproveedor').val();
		    
			window.location.href = '../pedidos_cliente/pedidos_cliente_detalle.php?id=' + id + '&pag=2&idprov=' + idproveedor + '&fechaini=' + fechaini + '&fechafin=' + fechafin;  
	    }
	    
	    function fnTicket(id){
			window.location.href = 'ticket.php?id=' + id;
	    }
	    
	    /*function fnTicket(id){
			window.location.href = 'ticket.php?id=' + id;
	    }*/
	    
	    function fnConcentrado(id,fechaini,fechafin){
			window.location.href = 'pedido_detalle_concentrado.php?id=' + id +"&fechaini="+fechaini+"&fechafin="+fechafin;
	    }
	    
	    function fnAtras(){
		    var fechaini = $('#hdnfechaini').val();
		    var fechafin = $('#hdnfechafin').val();
		    
		    window.location.href = "listado_pedidos.php?fechaini=" + fechaini + "&fechafin=" + fechafin;
	    }
	    
	    /*function fnInsertar(id){
		    
		    jQuery.post("acciones_pedidos_proveedor.php?mode=insert", {
				id:id
			}, function(data, textStatus){
				$.unblockUI();
				if(data == 1){
					$.blockUI({ 
					    baseZ: 20000,
			            message: '<h2><img src="../assets/img/check.png"/>Confirmado</h2>' 
			        }); 
			        
			        setTimeout($.unblockUI, 2000); 
			        
			        
			       
			        window.open('ticket.php?id=' + id, '_blank');
			        window.location.href = 'listado_pedidos.php';
			       
				} else {
					
					$.blockUI({ 
						    baseZ: 20000,
				            message: '<h2><img src="../assets/img/cancel.png"/> Error al procesar la confirmacion..."</h2>' 
				        }); 
				        
				        setTimeout($.unblockUI, 3000); 
					
				}
			});
			
	    }*/
	    
	</script>
    
  </head>
  <body class="fixed-header dashboard">
    <!-- BEGIN SIDEBPANEL-->
    <nav class="page-sidebar" data-pages="sidebar">
    	<?php include('../sidemenu.php') ?>
    </nav>
    <!-- END SIDEBAR -->
    <!-- END SIDEBPANEL-->
    <!-- START PAGE-CONTAINER -->
    <div class="page-container ">
		<!-- START HEADER -->
		<div class="header ">
			<?php include('../header.php') ?>
		</div>
		<!-- END HEADER -->
		<!-- BODY -->
		<div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        	<div class="content ">
				<!-- START CONTAINER FLUID -->
		        <div class="container-fluid container-fixed-lg">
			        <div class="row">
		            	<div class="col-xl-12 col-lg-12 ">
							<div class="card card-transparent">
								<div class="card-header">
									<div class="card-title">
										PEDIDOS A PROVEEDOR
		                    		</div>
		                  		</div>
				                <div class="card-body">
				                    <h3>SECCION PARA REALIZAR LA SOLICITUD DE COMPRA CON EL PROOVEDOR
				                    </h3>
				                    <p>En esta area se confirman los productos que se mandaran a comprar con el proveedor seleccionado, solo da click en siguiente si todo es correcto y continuara.</p>
				                    
				                </div>
		                	</div>
		              	</div>
						<div class="col-xl-12 col-lg-12 ">
				            <div class="row m-t-10">
				              <div class="col-xl-12 col-lg-12">
				                <div class="card">
									<div class="card-body">
										<div class="col-lg-12">
												<div class="col-lg-12">
												 	<h3 class="mw-80">Proveedor</h3>
												    <div class="form-group-attached">
														<div class="row clearfix">
															<div class="col-md-12">
																<?php
																	$qr = "SELECT proveedor FROM proveedores WHERE idproveedor='".$id."'";
																	$respuesta = mysqli_query($link, $qr);
																	
																	$row = mysqli_fetch_array($respuesta);	  
																?>
																<div class="form-group form-group-default">
															        <input type="text" class="form-control textcolor" value="<?php echo utf8_encode($row['proveedor']); ?>" disabled="disabled">
															    </div>
															</div>
														</div>
													</div>
											    </div>
										    </div>
										</div>
									    <br>
									</div>
									<!-- END card -->
								</div>
							</div>
						</div>
						
						<div class="col-xl-12 col-lg-12 ">
				            <div class="row m-t-10">
				              <div class="col-xl-12 col-lg-12">
				                <div class="card">
									<div class="card-body">
										
										<div class="col-lg-12">
											
											<div class="col-lg-12">
												<h3 class="mw-80">Detalles</h3>
											    <div class="form-group-attached">
											</div>
										    <div class="row">
										    	<div class="col-12">
													
										    	</div>
										    </div>
										    <div class="col-lg-12">
								                <!-- START card -->
								                <div class="card card-transparent">
								                	<div class="card-header ">
								                    	<div class="card-title">Compra
								                    	</div>
								                    <div class="tools">
								                	</div>
								                </div>
								                <div class="card-body">
								                    <div class="table-responsive">
									                    <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
													      	<thead>
														        <tr>
															        <th style="width: 10%">Ticket Cliente</th>
															        <th>Cliente</th>
																    <th>Lista de Productos</th>
																    <th>Cantidad</th>
																    <th>U. Medida</th>
																    <th>Peso</th>
																    <th>P.Unitario</th>
																    <th>Importe</th>
																    <!--<th>Editar</th>-->
														        </tr>
													    	</thead>
															<tbody>
																<?php 
																	
																	/*$qr_tabla = "select pd.idsolicitud, c.cliente, p.producto, pd.cantidad, um.umedida, pd.peso, p.costo_compra as unitario, pd.idmedida from pedidos_cliente_detalle pd left join productos p on pd.idproducto=p.idproducto left join pedidos_cliente pc on pc.idsolicitud=pd.idsolicitud left join clientes c on pc.idcliente=c.idcliente left join unidad_medida um on pd.idmedida=um.idmedida where p.idproveedor='".$id."' and pd.idestatus=1";*/
																	$qr_tabla = "select  pc.idsolicitud, c.cliente,p.producto,pd.cantidad, u.umedida,pd.peso, p.costo_compra as unitario from pedidos_cliente pc, pedidos_cliente_detalle pd, productos p, clientes c, unidad_medida u where pc.idsolicitud = pd.idsolicitud and pd.idproducto = p.idproducto and pc.idcliente = c.idcliente and pd.idmedida = u.idmedida and pc.fecha between '".$fechaIni."' and '".$fechaFin."' and p.idproveedor='".$id."' and pd.idestatus=1";
																	//elimine and pd.idestatus=1;
					
																	$res = mysqli_query($link, $qr_tabla);
																	$id_ultimo = '';
																	
																	while($row_tabla = mysqli_fetch_array($res)){
																		if ($row_tabla['idmedida']== 4){ $peso='PZA'; } ELSE { $peso='?';}
																?>
															    <tr class="">
																    <td class="v-align-middle semi-bold"><?php echo $row_tabla['idsolicitud']; ?></td>
																    <td class="v-align-middle semi-bold"><?php echo utf8_encode($row_tabla['cliente']); ?></td>
																    <td class="v-align-middle semi-bold"><?php echo utf8_encode($row_tabla['producto']); ?></td>
																    <td class="v-align-middle semi-bold"><?php echo $row_tabla['cantidad']; ?></td>
																    <td class="v-align-middle semi-bold"><?php echo $row_tabla['umedida']; ?></td>
																    <td class="v-align-middle semi-bold"><?php if($row_tabla['peso'] == 0){ echo '<p class="text-danger">'.$peso.'</p>'; } else { echo $row_tabla['peso']; }   ?></td>
																    <td class="v-align-middle semi-bold"><?php  echo $row_tabla['unitario'] ?></td>
																    <td class="v-align-middle semi-bold"><?php if ($row_tabla['idmedida'] == '4') { echo $row_tabla['unitario']*$row_tabla['cantidad']; } else { echo $row_tabla['unitario']*$row_tabla['peso']; } ?></td>
																    <?php 
																	   // if($id_ultimo != $row_tabla['idsolicitud']){
																    ?>
																    <td class="v-align-middle semi-bold"><button aria-label="" class="btn btn-complete" id="btneditar" name="btneditar" onclick="fnEditar('<?php echo $row_tabla['idsolicitud']; ?>');">Editar<i class="pg-icon">pencil</i></button></td>
																    <?php 
																	       $id_ultimo = $row_tabla['idsolicitud'];
																	  //  } else {
																    ?>
																      <!-- <td class="v-align-middle semi-bold"></td>-->
																    <?php 
																	    //}
																    ?>
																</tr>
																<?php } ?>
																<tr>
																	<?php 
																		$query_total="select SUM(p.costo_compra*pd.peso) total from pedidos_cliente pc, pedidos_cliente_detalle pd, productos p where pc.idsolicitud = pd.idsolicitud  and pd.idproducto = p.idproducto and pc.fecha between  '".$fechaIni."' and '".$fechaFin."' and p.idproveedor='".$id."' and pd.idestatus=1";
																		$restotal=mysqli_query($link,$query_total);
																		$rowtotal=mysqli_fetch_array($restotal);
																	?>
																	<td></td><td></td><td></td><td></td><td></td><td></td>
																	<td class="v-align-middle semi-bold">TOTAL</td>
																	<td class="v-align-middle semi-bold"><?php echo number_format($rowtotal['total'],2); ?></td>
																	<td></td>
																</tr>
													    	</tbody>
													    </table>
														
													</div>
												</div>
								                <!-- END card -->
									            
									        </div>
										</div></div>
									    <br>
									    <div class="row">
									    	<div class="col-12">
										    	<input type="hidden" id="hdnfechaini" name="hdnfechaini" value="<?php echo $fechaIni; ?>" />
										    	<input type="hidden" id="hdnfechafin" name="hdnfechafin" value="<?php echo $fechaFin; ?>" />
										    	<input type="hidden" id="hdnidproveedor" name="hdnidproveedor" value="<?php echo $id ?>">
										    	<button aria-label="" class="btn btn-info" id="btnatras" name="btnatras" onclick="fnAtras();">Regresar</button>
												<button aria-label="" class="btn btn-complete" id="btnfinalizar" name="btnfinalizar" onclick="fnConcentrado('<?php echo $id ?>','<?php echo $fechaIni; ?>','<?php echo $fechaFin; ?>');">Siguiente</button>
									    	</div>
									    </div>
									</div>
									<!-- END card -->
								</div>
							</div>
						</div>
					</div>
		          <!-- END CONTAINER FLUID -->
		        </div>
		    </div>
		</div>
    </div></div>
        <!-- END BODY -->
        <!-- END PAGE CONTENT -->
        <!-- START COPYRIGHT -->
        <!-- START CONTAINER FLUID -->
        <!-- START CONTAINER FLUID -->
        <div class=" container-fluid  container-fixed-lg footer">
        	<?php include('../footer.php'); ?>
        </div>
        <!-- END COPYRIGHT -->
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTAINER -->
    
    <!-- BEGIN VENDOR JS -->
    <script src="<?php echo $dir; ?>assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <!--  A polyfill for browsers that don't support ligatures: remove liga.js if not needed-->
    <script src="<?php echo $dir; ?>assets/plugins/liga.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/plugins/jquery/jquery.blockUI.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/plugins/modernizr.custom.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/plugins/popper/umd/popper.min.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/plugins/jquery-actual/jquery.actual.min.js"></script>
    <script src="<?php echo $dir; ?>assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script type="text/javascript" src="<?php echo $dir; ?>assets/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="<?php echo $dir; ?>assets/plugins/classie/classie.js"></script>
    <script src="<?php echo $dir; ?>assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo $dir; ?>assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
    <script type="text/javascript" src="<?php echo $dir; ?>assets/plugins/datatables-responsive/js/lodash.min.js"></script>
    <!-- END VENDOR JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="<?php echo $dir; ?>pages/js/pages.js"></script>
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?php echo $dir; ?>assets/js/scripts.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?php echo $dir; ?>assets/js/datatables.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/js/scripts.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/js/google_map.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/js/scripts.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
    </body>
</html>