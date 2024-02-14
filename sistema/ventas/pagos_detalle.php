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
									<div class="card-header ">
										<div class="card-title">PASO #1
										</div>
									</div>
									<div class="card-body">
										<form id="form-project" role="form" autocomplete="off" novalidate>
											<div class="col-lg-12">
													<div class="col-lg-12">
													 	<h3 class="mw-80">PROOVEDOR</h3>
													    <div class="form-group-attached">
															
														<div class="row clearfix">
															<div class="col-md-6">
															  <div class="form-group form-group-default">
															    <label>Selecciona Proveedor</label>
										                        <select class="full-width" data-init-plugin="select2">
										                        	<optgroup label="proveedor">
																		<option value="elpescador"></option>
																		<option value="elpescador">El Pescador</option>
																		<option value="elpescador">Marinera del 23</option>
										                        	</optgroup>
										                        </select>
															  </div>
															</div>
															
														</div>
														
												    </div>
											    </div>
											    
											    
											</div>
										    <br>
										    
										</form>
									</div>
									<!-- END card -->
								</div>
							</div>
						</div>
						
						
						
						
						
						<div class="col-xl-12 col-lg-12 ">
				            <div class="row m-t-10">
				              <div class="col-xl-12 col-lg-12">
				                <div class="card">
									<div class="card-header ">
										<div class="card-title">PASO #2
										</div>
									</div>
									<div class="card-body">
										<form id="form-project" role="form" autocomplete="off" novalidate action="invoice.php">
											<div class="col-lg-12">
													<div class="col-lg-12">
													 	<h3 class="mw-80">Pedidos pendientes de comprar</h3>
													    <div class="form-group-attached">
															
														
											    </div>
											    
											    <div class="col-lg-12">
									                <!-- START card -->
									                <div class="card card-transparent">
									                	<div class="card-header ">
									                    	<div class="card-title">LISTADO DE PEDIDOS DEL CLIENTE
									                    	</div>
									                    <div class="tools">
									                	</div>
									                </div>
									                <div class="card-body">
									                    <div class="table-responsive">
										                    <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
														      	<thead>
															        <tr>
															        	<th>Pedido</th>
																	    <th>Cliente</th>
																	    
																	    <th>Producto</th>
																	    <th>Cantidad</th>
																	    <th>U. Medida</th>
																	    <th></th>
															        </tr>
														    	</thead>
																<tbody>
															        <tr class="" >
																    <td class="v-align-middle semi-bold">1</td>
																    <td class="v-align-middle">Ruben</td>																    
																    <td class="v-align-middle semi-bold">Mero</td>
																    <td class="v-align-middle semi-bold"><input type="text" class="form-control"  value="10" /></td>
																    <td class="v-align-middle semi-bold">KG</td>
																    <td class="v-align-middle semi-bold">
																	   <div class="form-check form-check-inline switch">
												                        <input type="checkbox" id="pagesSwitch" >
												                        <label for="pagesSwitch">Seleccionar</label>
												                      </div>
																    </td>
																  </tr>
																  <tr class="">
																    <td class="v-align-middle semi-bold">1</td>
																    <td class="v-align-middle"></td>																    
																    <td class="v-align-middle semi-bold">CAMARON</td>
																    <td class="v-align-middle semi-bold"><input type="text" class="form-control"  value="1" /></td>
																    <td class="v-align-middle semi-bold">KG</td>
																    <td class="v-align-middle semi-bold">
																	   <div class="form-check form-check-inline switch">
												                        <input type="checkbox" id="pagesSwitch2" >
												                        <label for="pagesSwitch2">Seleccionar</label>
												                      </div>
																    </td>
																  </tr>
																  <tr class="trresponsive">
																    <td class="v-align-middle semi-bold">1</td>
																    <td class="v-align-middle"></td>																    
																    <td class="v-align-middle semi-bold">PULPO</td>
																    <td class="v-align-middle semi-bold"><input type="text" class="form-control" value=".5" /></td>
																    <td class="v-align-middle semi-bold">KG</td>
																    <td class="v-align-middle semi-bold">
																	   <div class="form-check form-check-inline switch">
												                        <input type="checkbox" id="pagesSwitch" >
												                        <label for="pagesSwitch">Seleccionar</label>
												                      </div>
																    </td>
																  </tr>
																  <tr class="">
																    <td class="v-align-middle semi-bold">2</td>
																    <td class="v-align-middle">GUSTAVO</td>																    
																    <td class="v-align-middle semi-bold">Mero</td>
																    <td class="v-align-middle semi-bold"><input type="text" class="form-control" value="1" /></td>
																    <td class="v-align-middle semi-bold">KG</td>
																    <td class="v-align-middle semi-bold">
																	   <div class="form-check form-check-inline switch">
												                        <input type="checkbox" id="pagesSwitch" >
												                        <label for="pagesSwitch">Seleccionar</label>
												                      </div>
																    </td>
																  </tr>
																  <tr class="trresponsive">
																    <td class="v-align-middle semi-bold">2</td>
																    <td class="v-align-middle"></td>																    
																    <td class="v-align-middle semi-bold">ALMEJA</td>
																    <td class="v-align-middle semi-bold"><input type="text" class="form-control"  value="4" /></td>
																    <td class="v-align-middle semi-bold">KG</td>
																    <td class="v-align-middle semi-bold">
																	   <div class="form-check form-check-inline switch">
												                        <input type="checkbox" id="pagesSwitch" >
												                        <label for="pagesSwitch">Seleccionar</label>
												                      </div>
																    </td>
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
										        <button aria-label="" class="btn btn-complete pull-right" type="submit">Siguiente</button>
										      </div>
										    </div>
										</form>
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