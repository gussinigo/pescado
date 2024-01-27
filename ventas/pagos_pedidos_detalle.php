<?php 
	
	include('../conexion.php');
	$link = Conectarse();
	$dir = '../';
	
	$id=$_REQUEST['id'];
	$mode=$_REQUEST['mode'];
	
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
    </style>
    <script>
	    function mostrar(){
		    $("#resultados").css('display','block');
	    }
	    
	    function fnGuardar(){
		    
		    var id = '<?php echo $id ?>';
			var tipo_pago = $('#tipo_pago').val();
			var referencia = $('#referencia').val();
			
			$.blockUI({ 
			    baseZ: 20000,
	            message: '<h2><img src="../assets/img/loading.gif" width="80px" height="80px"/>Procesando...</h2>' 
	        });
			
		    jQuery.post("acciones_nota_venta.php?mode=<?php echo $mode ?>", {
				id:id,
				tipo_pago:tipo_pago,
				referencia:referencia
			}, function(data, textStatus){
				$.unblockUI();
				if(data == 1){
					$.blockUI({ 
					    baseZ: 20000,
			            message: '<h2><img src="../assets/img/check.png"/> Se ha guardado...</h2>' 
			        }); 
			        
			        setTimeout($.unblockUI, 2000); 
			        
			        
					window.location.href = 'nota_venta_listado.php';
			    } else {
					
					$.blockUI({ 
					    baseZ: 20000,
			            message: '<h2><img src="../assets/img/cancel.png"/> No se pudo procesar la solicitud...</h2>' 
			        }); 
			        
			        setTimeout($.unblockUI, 2000); 
			            
				}
			});
	    }
	    
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
		<div class="header">
			<?php include('../header.php') ?>
		</div>
		<!-- END HEADER -->
		<!-- BODY -->
		
		 <!-- START CONTAINER FLUID -->
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
											Pagos de Pedidos
			                    	</div>
									
		                  		</div>
				                <div class="card-body">
				                    <h3>En esta sección es donde registraremos los pagos de los pedidos que se ordenan por parte del cliente.</h3>
				                    <p>Aquí empezaremos por seleccionar el tipo de pago del pedido<br>
					                luego le daremos al botón guardar para mostrar el ticket</p>
				                </div>
		                	</div>
		              	</div>
						<div class="col-xl-12 col-lg-12 ">
				            <div class="row m-t-10">
				            	
					            <div class="card">
									<div class="card-header ">
										<div class="card-title">
										</div>
									</div>
									<form id="form-project" role="form" autocomplete="off">
										<div class="card-body">
											
											<?php 
												$qr = "select c.cliente, p.idsolicitud, p.subtotal, nv.idtipopago, nv.referencia from pedidos_cliente p left join pedidos_cliente_detalle pd on p.idsolicitud=pd.idsolicitud left join productos pr on pd.idproducto = pr.idproducto left join clientes c on c.idcliente=p.idcliente left join nota_venta nv on nv.idsolicitud=p.idsolicitud where p.idsolicitud= '".$id."'";
												$res = mysqli_query($link, $qr);
														
												$row = mysqli_fetch_array($res);
											?>
											<div class="col-lg-12">
												<div class="row">
												 <div class="col-md-12">
													 <h3 class="mw-80"><?php echo $row['cliente']; ?></h3>
													<p>Pedido <?php echo $row['idsolicitud']; ?> - Total: $<?php echo $row['subtotal']; ?></p>
												 </div>
												</div>
												<div class="row">
													<div class="col-md-6">
														<div class="form-group form-group-default required">
													    	<div class="form-group ">
														        <label>Forma de Pago</label>
										                        <select class="full-width" id="tipo_pago" data-init-plugin="select2">
										                        	<optgroup label="Forma de Pago">
										                            <?php
											                        	$qr="select * from tipo_pago";
											                        	$res_qr = mysqli_query($link, $qr);
											                        	while ($row_qr = mysqli_fetch_array($res_qr)){
												                        	if($row_qr['idtipopago'] == $row['idtipopago']){
													                        	$selected = "selected='selected'";
												                        	} else {
													                        	$selected = '';
												                        	}
										                        	?>
																		<option value="<?php echo $row_qr['idtipopago']; ?>" <?php echo $selected; ?>><?php echo utf8_encode($row_qr['tipo_pago']); ?></option>
																	<?php 
																		}
																	?>
										                          </optgroup>
										                        </select>
													    	</div>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-group-default">
													    	<div class="form-group ">
														        <label>Referencia</label>
										                        <input type="text" class="form-control" id="referencia" placeholder="Referencia" value="<?php echo $row['referencia']; ?>" required>
													    	</div>
														</div>
													</div>
												</div>
											</div>
										</div>
						            </div>
					           
					                <div class="card">
										<div class="card-header ">
											<div class="card-title">
											</div>
										</div>
										<div class="card-body">
											<div class="col-lg-12">
												<div class="row" id="resultados">   
												    <div class="col-lg-12" >
										                <!-- START card -->
										                <div class="card card-transparent">
										                	<div class="card-header ">
										                    	<div class="card-title">Tabla de solicitud	
										                    	</div>
										                    <div class="tools">
										                	</div>
										                </div>
										                <div class="card-body">
										                    <div class="table-responsive">
																<table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
															      	<thead>
																        <tr>
																        	<th>Codigo</th>
																			<th>Producto</th>
																			<th>Solicitado</th>
																			<th>U. Medida</th>
																			<th>PESO REAL</th>
																			<th>Total</th>
																        </tr>
															    	</thead>
																	<tbody>
																		<?php
																			
																			$qr = "select pr.codigo, pr.producto, pd.cantidad, um.umedida, pd.peso, pd.peso*pr.costo_venta as total from pedidos_cliente p left join pedidos_cliente_detalle pd on p.idsolicitud=pd.idsolicitud left join productos pr on pd.idproducto = pr.idproducto left join clientes c on c.idcliente=p.idcliente left join unidad_medida um on um.idmedida=pd.idmedida where p.idsolicitud = '".$id."'";
																			
																			$res = mysqli_query($link, $qr);
																			while($row = mysqli_fetch_array($res)){
																			
																		?>
																        <tr class="trresponsive">
																			<td class="v-align-middle">
																				<p><?php echo $row['codigo']; ?></p>
																			</td>
																			<td class="v-align-middle">
																				<p><?php echo $row['producto']; ?></p>
																			</td>
																			<td class="v-align-middle">
																				<p><?php echo $row['cantidad']; ?></p>
																			</td>
																			<td class="v-align-middle">
																				<p><?php echo $row['umedida']; ?></p>
																			</td>
																			<td class="v-align-middle">
																				<p><?php echo $row['peso']; ?></p>
																			</td>
																			<td class="v-align-middle">
																				<p><?php echo $row['total']; ?></p>
																			</td>
																		</tr>
																		<?php
																			}
																		?>
															    	</tbody>
															    </table>
															</div>
														</div>
										                <!-- END card -->
										            </div>
										        </div>
											</div>
										    <br>
										    <div class="row">
										    	<div class="col-12">
										        	<button aria-label="" class="btn btn-complete pull-right" type="button" onclick="fnGuardar();">Guardar</button>
										    	</div>
										    </div>
										</div>
									</form>
								</div>
								<!-- END card -->
							</div>
					        <!-- END CONTAINER FLUID -->
					    </div>
					</div>
				</div>
		    </div>
		</div>    
    
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