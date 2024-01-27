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
    <link class="main-stylesheet" href="<?php echo $dir; ?>pages/css/pages.css" rel="stylesheet" type="text/css" />
    <!-- Please remove the file below for production: Contains demo classes -->
    <link class="main-stylesheet" href="<?php echo $dir; ?>assets/css/style.css" rel="stylesheet" type="text/css" />
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
		<!-- START PAGE CONTENT WRAPPER -->
      <div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        <div class="content ">
          	<!-- START CONTAINER FLUID -->
			<div class=" container-fluid   container-fixed-lg bg-white">
				<!-- START card -->
				<div class="card card-transparent">
				  	<div class="card-header ">
				    	<div class="card-title">PEDIDOS A PROVEEDOR</div>
				    </div>
				    <div class="pull-right">
				      <div class="col-xs-12">
				        <input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
				      </div>
				    </div>
				    <div class="clearfix"></div>
				</div>
				  <div class="card-body">
				    <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
				      	<thead>
					        <tr>
					        	<th>Ticket Pedido</th>
								<th>Listado de productos</th>
								<th>Fecha de Pedido</th>
								<th>Editar</th>
								<th>Borrar</th>
								<th>Ticket</th>
					        </tr>
				    	</thead>
						<tbody>
					        <tr>
								<td class="v-align-middle">
									<p>Pedido 11</p>
								</td>
								<td class="v-align-middle">
									<p>
										-Mero
										-Camaron
									</p>
								</td>
								<td class="v-align-middle">
									<p>05/08/2020</p>
								</td>
								<td class="v-align-middle">
									<a href="pedido_detalle.php">
									<button aria-label="" class="btn btn-complete" onclick="">Editar<i class="pg-icon">pencil</i></button>
									</a>
								</td>
								<td class="v-align-middle">
									
									<button aria-label="" class="btn btn-danger">Borrar<i class="pg-icon">trash_alt</i></button>
								</td>
								<td class="v-align-middle">
									<a href="invoice.php">
									<button aria-label="" class="btn btn-default">Ticket<i class="pg-icon">printer</i></button>
									</a>
								</td>
							</tr>
							<tr>
								<td class="v-align-middle">
									<p>Pedido 12</p>
								</td>
								<td class="v-align-middle">
									<p>
										-Mero
										-Jaiba
									</p>
								</td>
								<td class="v-align-middle">
									<p>06/08/2020</p>
								</td>
								<td class="v-align-middle">
									<a href="pedido_detalle.php">
									<button aria-label="" class="btn btn-complete" onclick="">Editar<i class="pg-icon">pencil</i></button>
									</a>
								</td>
								<td class="v-align-middle">
									<button aria-label="" class="btn btn-danger">Borrar<i class="pg-icon">trash_alt</i></button>
								</td>
								<td class="v-align-middle">
									<a href="invoice.php">
									<button aria-label="" class="btn btn-default">Ticket<i class="pg-icon">printer</i></button>
									</a>
								</td>
							</tr>
							<tr>
								<td class="v-align-middle">
									<p>Pedido 13</p>
								</td>
								<td class="v-align-middle">
									<p>
										-Pulpo
										-Camaron
									</p>
								</td>
								<td class="v-align-middle">
									<p>65/08/2020</p>
								</td>
								<td class="v-align-middle">
									<a href="pedido_detalle.php">
									<button aria-label="" class="btn btn-complete" onclick="">Editar<i class="pg-icon">pencil</i></button>
									</a>
								</td>
								<td class="v-align-middle">
									<button aria-label="" class="btn btn-danger">Borrar<i class="pg-icon">trash_alt</i></button>
								</td>
								<td class="v-align-middle">
									<a href="invoice.php">
									<button aria-label="" class="btn btn-default">Ticket<i class="pg-icon">printer</i></button>
									</a>
								</td>
							</tr>
							
				    	</tbody>
				    </table>
				  </div>
				</div>
				<!-- END card -->
			</div>
			<!-- END CONTAINER FLUID -->
		</div>
        <!-- END PAGE CONTENT -->
        <!-- START COPYRIGHT -->
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
    <!-- END PAGE LEVEL JS -->
    </body>
</html>