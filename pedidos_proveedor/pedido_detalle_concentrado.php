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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
	    
	    function fnAtras(){
		    var fechaini = $('#hdnfechaini').val();
		    var fechafin = $('#hdnfechafin').val();
		    var idproveedor = $('#hdnidproveedor').val();
		    
		    window.location.href = "pedido_detalle.php?id="+idproveedor+"&fechaini=" + fechaini + "&fechafin=" + fechafin;
	    }
	    
	    function fnConfirmar(){
		    try {
			 
			 	var fechaini = $('#hdnfechaini').val();
			    var fechafin = $('#hdnfechafin').val();
			    var idproveedor = $('#hdnidproveedor').val();
			    
			    if(confirm("Desea confirmar el pedido al proveedor?")){
				    $.blockUI({ 
					    baseZ: 20000,
			            message: '<h2><img src="../assets/img/loading.gif" width="80px" height="80px"/>Procesando...</h2>' 
			        });
			        
			        jQuery.post("acciones_pedidos_proveedor.php?mode=insert", {
								fechaini:fechaini,
								fechafin:fechafin,
								idproveedor:idproveedor
							}, function(data, textStatus){

								$.unblockUI();
								if(data >= 1){
									$.blockUI({ 
									    baseZ: 20000,
							            message: '<h2><img src="../assets/img/check.png"/> Compra confirmada correctamente...</h2>' 
							        }); 
							        
							        setTimeout($.unblockUI, 2000); 
							        
							        
							         
							         window.open('pedido_tipo_ticket.php?id=' + idproveedor + '&idcompra=' + data, '_blank');
									 window.location.href = 'listado_pedidos.php?fechaini=' + fechaini + '&fechafin=' + fechafin;
							       
								}
								else if(data == 0){
									   
									   $.blockUI({ 
										    baseZ: 20000,
								            message: '<h2><img src="../assets/img/cancel.png"/> Error al confirmar la compra...</h2>' 
								        }); 
								        
								        setTimeout($.unblockUI, 2000); 
								        
		
								        
								} else {
										$.blockUI({ 
										    baseZ: 20000,
								            message: '<h2><img src="../assets/img/cancel.png"/> Error al confirmar la compra...'+ data +'</h2>' 
								        }); 
								        
								        setTimeout($.unblockUI, 3000); 
								        
								}
					});
			        
			    }
			    
		    } catch (err){
			    $.unblockUI();
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
				                    <p>En esta area se confirman el concentrado de productos que se mandaran a comprar con el proveedor seleccionado, solo da click en siguiente si todo es correcto y continuara.</p>
				                    
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
															        <input type="text" class="form-control textcolor" value="<?php echo $row['proveedor']; ?>" disabled="disabled">
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
												<h3 class="mw-80">Concentrado</h3>
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
								                    	<div class="card-title">Concentrado de Productos
								                    	</div>
								                    <div class="tools">
								                	</div>
								                </div>
								                <div class="card-body">
								                    <div class="table-responsive">
									                    <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
													      	<thead>
														        <tr>
																    <th>Lista de Productos</th>
																    <th>Cantidad Total</th>
																    <th>Peso Total</th>
																    <th>Precio Total</th>
														        </tr>
													    	</thead>
															<tbody>
																<?php 
																	
																	$qr_tabla = "select p.producto, SUM(pd.peso) as cantidad_total, um.umedida as peso_total, SUM(p.costo_compra * pd.peso) AS costo_total from pedidos_cliente_detalle pd left join productos p on pd.idproducto=p.idproducto left join pedidos_cliente pc on pc.idsolicitud=pd.idsolicitud left join clientes c on pc.idcliente=c.idcliente left join unidad_medida um on pd.peso_idmedida=um.idmedida where p.idproveedor='".$id."' and pd.idestatus=1 and pc.fecha >= '".$fechaIni."' and pc.fecha <= '".$fechaFin."' GROUP BY p.producto;";
					
																	$res = mysqli_query($link, $qr_tabla);
																	
																	while($row_tabla = mysqli_fetch_array($res)){
																		if ($row_tabla['idmedida']== 4){ $peso='PZA'; } ELSE { $peso='?';}
																?>
															    <tr class="">
																    <td class="v-align-middle semi-bold"><?php echo $row_tabla['producto']; ?></td>
																    
																    <td class="v-align-middle semi-bold"><?php if($row_tabla['cantidad_total'] == 0){ echo '<p class="text-danger">'.$peso.'</p>'; } else { echo $row_tabla['cantidad_total']; }   ?></td>
																    <td class="v-align-middle semi-bold"><?php echo $row_tabla['peso_total']; ?></td>
																    <td class="v-align-middle semi-bold"><?php  echo $row_tabla['costo_total'] ?></td>
																    
																</tr>
																<?php } ?>
																<tr class="">
																	
																	<td></td>
																	<td></td>
																	<td class="v-align-middle bold">TOTAL</td>
																	<?php 
																		$query_total="select SUM(p.costo_compra*pd.peso) AS total
																		from pedidos_cliente_detalle pd left join productos p on pd.idproducto=p.idproducto left join pedidos_cliente pc on pc.idsolicitud=pd.idsolicitud left join clientes c on pc.idcliente=c.idcliente 		left join unidad_medida um on pd.peso_idmedida=um.idmedida 
																		where p.idproveedor='".$id."' and pd.idestatus=1 and pc.fecha >= '".$fechaIni."' and pc.fecha <= '".$fechaFin."'";
																		
																		$restotal=mysqli_query($link,$query_total);
																		$rowtotal=mysqli_fetch_array($restotal);
																	?>
																	<td class="v-align-middle semi-bold"><?php echo number_format($rowtotal['total'],2); ?></td>
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
										    	<!--<form action="acciones_pedidos_proveedor.php?mode=insert" method="POST">-->
											    	<input type="hidden" id="hdnidproveedor" name="hdnidproveedor" value="<?php echo $id ?>">
											    	<input type="hidden" id="hdnfechaini" name="hdnfechaini" value="<?php echo $fechaIni; ?>" />
													<input type="hidden" id="hdnfechafin" name="hdnfechafin" value="<?php echo $fechaFin; ?>" />
											    	<button aria-label="" class="btn btn-info" id="btnatras" name="btnatras" onclick="fnAtras();">Regresar</button>
													<button aria-label="" type="button" onclick="fnConfirmar();" class="btn btn-complete" id="btnfinalizar" name="btnfinalizar">Confirmar</button>
										    	<!--</form>-->
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

    <!-- END PAGE LEVEL JS -->
    </body>
</html>