<?php 
	
	include('../conexion.php');
	$link = Conectarse();
	$dir = '../';
	
	
	
	$repartidor = $_REQUEST['repartidor'];
	$hoy = date('Y-m-d');
	$ts = strtotime($hoy);
	$start = (date('w',$ts) == 0) ? $ts : strtotime('last sunday', $ts);
	$fechaIni = date('Y-m-d',$start);
	$fechaFin = date('Y-m-d',strtotime('next saturday', $start));
	$filtro2 = " and p.fecha >= '".$fechaIni."' and p.fecha <= '".$fechaFin."'";									
										
	if($repartidor != ''){
		$rep = " and a.idrepartidor='".$repartidor."' ";
	} else {
		$rep = " ";
	}
	
	$qr = "select c.cliente,a.idasignacion, a.orden, p.idsolicitud, p.fecha, c.sm, c.residencial, r.repartidor, a.idrepartidor from asignacion_rutas a left join pedidos_cliente p on a.idsolicitud=p.idsolicitud left join clientes c on p.idcliente=c.idcliente left join repartidores r on a.idrepartidor = r.idrepartidor where p.idestatus=4".$rep.$filtro2." ORDER BY a.orden ASC";
	
	$res = mysqli_query($link, $qr);
	
	
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
    <?php 
		if ($_GET['al'] == 1){
			echo "
			<script>
			alert('Ruta Editada);
			</script>
			";
		}
	?>
    <script>
	   
		function fnEliminar(id){
			let text = "Esto eliminara este pedido de la ruta de este repartido. ¿Estas seguro?";
			  if (confirm(text) == true) {
				window.location.href = 'acciones_rutas.php?idsolicitud=' + id +'&accion=eliminar';
			  } 
			  
		}

		function fnImprimir(id){
		     window.open('pdf_ruta.php?id=' + id, '_blank');
		    
	    }
	    function fnBusar(){
			try{
				
				var idrepartidor = $('#repartidor').val();
				
				window.location.href = 'listado.php?repartidor=' + idrepartidor;
				$("#editruta").css("display", "block");
			}   
			catch (err){
				alert("Error: " + err.message);
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
						<div class="col-xl-6 col-lg-6 ">
							<div class="card card-transparent">
								<div class="card-header">
									<div class="card-title">
										Acerca del Listado de Rutas
		                    		</div>
		                  		</div>
				                <div class="card-body">
				                    <h3>Lo primero sera seleccionar al repartidor del que quieres ver la ruta</h3>
				                    <p>Luego utilizas el boton de imprimir para tener el pdf de la ruta de ese repartidor.</p>
				                </div>
		                	</div>
		              	</div>
			            <div class="card card-default">
		                	<div class="card-header ">
		                    	<div class="card-title">
			                    	Busqueda
		                   		</div>
		                	</div>
		                	
				                <div class="card-body">				              
						            <div class="row">
						            	<div class="col-md-12">
								            <div class="col-md-6">
									            <div class="form-group-attached">
													<div class="form-group form-group-default">
												    		<label>Repartidores</label>
									                        <select class="full-width" data-init-plugin="select2" id="repartidor" name="repartidor" >
									                        	<optgroup label="Repartidores">
									                        		<option value="">Ninguno</option>
																	<?php
																		$qr1 = "SELECT idrepartidor, repartidor FROM repartidores";
																		$res1 = mysqli_query($link, $qr1);
																		while($row_prov = mysqli_fetch_array($res1)){
																			if($row_prov['idrepartidor'] == $repartidor){
																				$selected = "selected='selected'";
																			} else {
																				$selected = '';
																			}
																	?>
																	<option value="<?php echo $row_prov['idrepartidor']; ?>" <?php echo $selected; ?>><?php echo $row_prov['repartidor']; ?></option>
																	<?php } ?>
									                        	</optgroup>
									                        </select>
								                    	</div>
												    </div>
								            	</div>
							            	</div>
						            	</div>
					                </div>
					                <div class="row">
						                <div class="col-md-12">
							                <div class="col-md-6">
								                <div class="form-group">
									                <button aria-label="" class="btn btn-complete" type="button" onclick="fnBusar();">Buscar<i class="pg-icon">search</i></button>
													
													
										        </div>
											
							                </div>
											
						                </div>
					                </div>
					            </div>
			              
			            </div>
		        	</div>
		            <div class="row">
			             <div class="card-body">
							 <form action="acciones_rutas.php?accion=editar" method="post" name="listado">
						    <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
						      	<thead>
							        <tr>
								        <th>Orden</th>
							        	<th>Ticket Pedido</th>
										<th>Fecha</th>
										<!--<th>SMZ</th>-->
										<th>Residencial</th>
										<th>Cliente</th>
										<th>Eliminar de la Ruta</th>
										<!--<th>Imprimir</th>
										<th>Editar</th>
										<th>Borrar</th>-->
							        </tr>
						    	</thead>
								<tbody id="tabla_pagos">
									<?php
	
										if($repartidor!= ''){ 
											while($row = mysqli_fetch_array($res)){
									?>
							        <tr>
										<td class="v-align-middle">
											
											<input type="text"  name="orden[]" value="<?php echo $row['orden']; ?>" size="5">
											<input type="hidden" name="idsol[]" value="<?php echo $row['idsolicitud']; ?>" />
											<input type="hidden" name="idrepartidor" value="<?php echo $idrepartidor; ?>" />
										</td>
										<td class="v-align-middle">
											<p>
												<?php echo $row['idsolicitud']; ?>
											</p>
										</td>
										<td class="v-align-middle">
											<p><?php echo $row['fecha']; ?></p>
										</td>
										<!--<td class="v-align-middle">
											<p><?php echo $row['sm']; ?></p>
										</td>-->
										<td class="v-align-middle">
											<p><?php echo $row['residencial']; ?></p>
										</td>
										<td class="v-align-middle">
											<p><?php echo $row['cliente']; ?></p>
										</td>
										<!--<td class="v-align-middle">
											<button aria-label="" class="btn btn-default" onclick="fnImprimir('<?php echo $row['idrepartidor']; ?>');>Imprimir<i class="pg-icon">printer</i></button>
										</td>
										<td class="v-align-middle">
											<button aria-label="" class="btn btn-complete" onclick="fnEditar('<?php echo $row['idsolicitud']; ?>');">Editar<i class="pg-icon">pencil</i></button>
										</td>-->
										<td class="v-align-middle">
											<button type="button" aria-label="" class="btn btn-danger" onclick="fnEliminar('<?php echo $row['idsolicitud']; ?>');"><i class="pg-icon">trash_alt</i></button>
										</td>
									</tr>
									<?php 
											}
										
										} ?>
						    	</tbody>
						    </table>
							<div class="col-md-6">
								<div class="form-group">
	
								<?php if($repartidor != ''){ ?>
									<button  aria-label="" class="btn btn-success" type="submit"  id="editruta" ">EDITAR<i class="pg-icon"></i></button>
								<?php } ?>	
								</div>
							</div>
						</div>
					</form>
			  		</div><!-- START ROW -->
			  		<?php 
				  		if($repartidor != ''){
					  	echo '<div class="card-body">
						  		<div class="row">
								    <div class="col-md-12">
									    <div class="form-group-attached">
											<div class="form-group form-group-default">
											<a href="http://elbuenpescado.com/rutas/pdf_ruta_conglomerado.php?id='.$repartidor.'" >
												<button aria-label="" class="btn btn-default" style="float: left;" >CONGLOMERADO<i class="pg-icon">printer</i></button>
												</a>
												<button aria-label="" class="btn btn-default" style="float: right;" onclick="fnImprimir('.$repartidor.')">Imprimir<i class="pg-icon">printer</i></button>
											</div>
									    </div>
								    </div>
						  		</div>
							</div>';
					} ?>
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