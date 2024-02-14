<?php 
	
	include('../conexion.php');
	$link = Conectarse();
	$dir = '../';
	
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo $dir; ?>assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo $dir; ?>assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo $dir; ?>assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $dir; ?>assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $dir; ?>assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />
    <link class="main-stylesheet" href="<?php echo $dir; ?>pages/css/pages.css" rel="stylesheet" type="text/css" />
    <!-- Please remove the file below for production: Contains demo classes -->
    <link class="main-stylesheet" href="<?php echo $dir; ?>assets/css/style.css" rel="stylesheet" type="text/css" />
    
    <link href="../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
    
    <script>
	    
		function fnEditar(id){
		    window.location.href = 'pagos_pedidos_detalle.php?id='+id+'&mode=update';
		}
		
		 function fnEliminar(id){
		    
		    if(confirm('¿Desea eliminar el registro?')){
				$.blockUI({ 
				    baseZ: 20000,
		            message: '<h2><img src="../assets/img/loading.gif" width="80px" height="80px"/>Procesando...</h2>' 
		        });
		        
		        jQuery.post("acciones_nota_venta.php?mode=delete", {
						id:id
					}, function(data, textStatus){
						$.unblockUI();
						if(data == 1){
							$.blockUI({ 
							    baseZ: 20000,
					            message: '<h2><img src="../assets/img/check.png"/> Registro Eliminado...</h2>' 
					        }); 
					        
					        setTimeout($.unblockUI, 2000); 
					        
					        
					         window.location.href = 'listado_pagos.php';
					        
					       
						}
						else if(data == 2){
							   
							   $.blockUI({ 
								    baseZ: 20000,
						            message: '<h2><img src="../assets/img/cancel.png"/> Error al eliminar el registro...</h2>' 
						        }); 
						        
						        setTimeout($.unblockUI, 2000); 

						        
						} else {
							
							$.blockUI({ 
								    baseZ: 20000,
						            message: '<h2><img src="../assets/img/cancel.png"/> Error al eliminar el registro...' + data + '</h2>' 
						        }); 
						        
						        setTimeout($.unblockUI, 3000); 
							
						}
				});
		        
			}
			    
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
		<div class="header ">
			<?php include('../header.php') ?>
		</div>
		<!-- END HEADER -->
		<!-- BODY -->
		<div class="page-content-wrapper ">
	        <!-- START PAGE CONTENT -->
	        <div class="content sm-gutter">
	          <!-- START CONTAINER FLUID -->
			  	<div class="container-fluid padding-25 sm-padding-10">
		            <!-- START ROW -->
					<div class="row">
			            <div class="card card-default">
		                	<div class="card-header ">
		                    	<div class="card-title">
			                    	Busqueda
		                   		</div>
		                	</div>
		                	<form method="post" action="listado_pagos.php">
				                <div class="card-body">
					            	<div class="row">
						            	<div class="col-md-3">
							                <label>Fecha Inicio</label>
								            <div class="input-group date p-l-0">
						                    	<input type="text" class="form-control" id="datepicker-component" name="fechaini">
												<div class="input-group-append">
						                        	<span class="input-group-text"><i class="pg-icon">calendar</i></span>
						                    	</div>
						                    </div>
						                </div>
						                <div class="col-md-3">
							                <label>Fecha Fin</label>
								            <div class="input-group date p-l-0">
						                    	<input type="text" class="form-control" id="datepicker-component" name="fechafin">
												<div class="input-group-append ">
													<span class="input-group-text"><i class="pg-icon">calendar</i></span>
						                    	</div>
						                    </div>
						                </div>
						            </div>
					            	<br/>				              
						            <div class="row">
						            	<div class="col-md-12">
								            <div class="col-md-6">
									            <div class="form-group-attached">
													<div class="form-group form-group-default">
												    		<label>Cliente</label>
									                        <select class="full-width" data-init-plugin="select2" id="cliente" name="cliente">
									                        	<optgroup label="Cliente">
									                        		<option value="">Ninguno</option>
																	<?php
																		$qr = "SELECT idcliente, cliente FROM clientes";
																		$res = mysqli_query($link, $qr);
																		while($row_prov = mysqli_fetch_array($res)){
																	?>
																	<option value="<?php echo $row_prov['idcliente']; ?>"><?php echo $row_prov['cliente']; ?></option>
																	<?php } ?>
									                        	</optgroup>
									                        </select>
								                    	</div>
												    </div>
								            	</div>
							            	</div>
						            	</div>
					                </div>
					                <div class="col-md-6">
						                <div class="form-group">
							                <button aria-label="" class="btn btn-complete" type="submit">Buscar<i class="pg-icon">search</i></button>
								        </div>
				                    </div>
					            </div>
			                </form>
			            </div>
		           </div>
		            <div class="row">
			             <div class="card-body">
						    <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
						      	<thead>
							        <tr>
							        	<th>Ticket Pedido</th>
										<th>Cliente</th>
										<th>Fecha de Pedido</th>
										<th>Total</th>
										<th>Editar</th>
										<th>Borrar</th>
							        </tr>
						    	</thead>
								<tbody id="tabla_pagos">
									<?php
									
									
										$hoy = date('Y-m-d');
										$ts = strtotime($hoy);
										$start = (date('w',$ts) == 0) ? $ts : strtotime('last sunday', $ts);
										
										
										$fechaini = $_POST['fechaini'];
										$fechafin = $_POST['fechafin'];
										$cliente = $_POST['cliente'];
										
										if($fechaini != '' && $fechafin != ''){
											$fechas=" AND nv.fecha BETWEEN '".$fechaini."' AND '".$fechafin."' ";
										} else {
											$fechas=" ";
										}
										
										if($cliente != ''){
											$clie = " AND nv.idcliente = '".$cliente."' ";
										} else {
											$clie = " ";
										}
										
										$qr = "SELECT nv.idventa, c.cliente, nv.fecha, nv.subtotal, nv.idsolicitud FROM nota_venta nv LEFT JOIN nota_venta_detalle nvd ON nv.idventa=nvd.idventa LEFT JOIN clientes c ON nv.idcliente = c.idcliente WHERE nv.idventa >= 1".$fechas.$clie."GROUP BY nv.idventa";
										
										$res = mysqli_query($link, $qr);
												
										while($row = mysqli_fetch_array($res)){
									?>
							        <tr>
										<td class="v-align-middle">
											<p><?php echo $row['idventa']; ?></p>
										</td>
										<td class="v-align-middle">
											<p>
												<?php echo $row['cliente']; ?>
											</p>
										</td>
										<td class="v-align-middle">
											<p><?php echo $row['fecha']; ?></p>
										</td>
										<td class="v-align-middle">
											<p><?php echo '$'.number_format($row['subtotal'],2); ?></p>
										</td>
										<td class="v-align-middle">
											<button aria-label="" class="btn btn-complete" onclick="fnEditar('<?php echo $row['idsolicitud']; ?>');">Editar<i class="pg-icon">pencil</i></button>
										</td>
										<td class="v-align-middle">
											<button aria-label="" class="btn btn-danger" onclick="fnEliminar('<?php echo $row['idventa']; ?>');">Borrar<i class="pg-icon">trash_alt</i></button>
										</td>
									</tr>
									<?php } ?>
						    	</tbody>
						    </table>
						</div>
						
			  		</div><!-- START ROW -->
	        	</div><!-- START CONTAINER FLUID -->
			</div><!-- page content -->
			
			<!-- Modal -->
	          <div class="modal fade slide-up disable-scroll" id="modalSlideUp" tabindex="-1" role="dialog" aria-hidden="false">
	            <div class="modal-dialog ">
	              <div class="modal-content-wrapper">
	                <div class="modal-content" id="paginas">
	                   <!-- Aqui va el contenido de la pagina -->
	                   
	                </div>
	              </div>
	              <!-- /.modal-content -->
	            </div>
	          </div>
			<!-- Modal -->
		
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
    
     <script src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="../assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    
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
     <script src="../assets/js/form_elements.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/js/scripts.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
  </body>
</html>