<?php 
	
	include('../conexion.php');
	$link = Conectarse();
	$dir = '../';
	
	$id = $_REQUEST['id'];
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
			window.location.href = '../pedidos_cliente/pedidos_cliente_detalle.php?id=' + id;  
	    }
	    
	    function fnTicket(id){
			window.location.href = 'ticket.php?id=' + id;
	    }
	    
	    function fnInsertar(id){
		    
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
			        
			        
			        //window.location.href = 'ticket.php?id='+id;
			        window.open('ticket.php?id=' + id, '_blank');
			        
			       
				} else {
					
					$.blockUI({ 
						    baseZ: 20000,
				            message: '<h2><img src="../assets/img/cancel.png"/> Error al procesar la confirmacion..."</h2>' 
				        }); 
				        
				        setTimeout($.unblockUI, 3000); 
					
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
				                    <p>...</p>
				                    
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
																	$qr = "SELECT p.proveedor FROM compras c LEFT JOIN compras_detalle d ON c.idcompra=d.idcompra LEFT JOIN proveedores p ON c.idproveedor=p.idproveedor WHERE c.idproveedor='".$id."'";
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
															        <th>Num. Pedido del Cliente</th>
																    <th>Lista de Productos</th>
																    <th>Cantidad</th>
														        </tr>
													    	</thead>
															<tbody>
																<?php 
																	
																	$qr_tabla = "SELECT c.idcompra, pro.producto, cd.cantidad FROM compras c LEFT JOIN compras_detalle cd ON c.idcompra=cd.idcompra LEFT JOIN proveedores p ON c.idproveedor=p.idproveedor LEFT JOIN productos pro ON pro.idproducto = cd.idproducto WHERE c.idproveedor='".$id."' AND c.idestatus=2";
					
																	$res = mysqli_query($link, $qr_tabla);
																	
																	while($row_tabla = mysqli_fetch_array($res)){
																?>
															    <tr class="">
																    <td class="v-align-middle semi-bold"><?php echo $row_tabla['idcompra']; ?></td>
																    <td class="v-align-middle semi-bold"><?php echo $row_tabla['producto']; ?></td>
																    <td class="v-align-middle semi-bold"><?php echo $row_tabla['cantidad']; ?></td>
																    
																</tr>
																<?php } ?>
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
												<button aria-label="" class="btn btn-complete" id="btnfinalizar" name="btnfinalizar" onclick="fnInsertar('<?php echo $id ?>');">Confirmar</button>
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