<?php 
	
	include('../conexion.php');
	$link = Conectarse();
	$dir = '../';
	
	$hoy = date('Y-m-d');
	$ts = strtotime($hoy);
	$start = (date('w',$ts) == 0) ? $ts : strtotime('last sunday', $ts);
	
	$fechaIni = $_REQUEST['fechaini'];
	$fechaFin = $_REQUEST['fechafin'];
	
	if ($fechaIni != '' && $fechaFin != ''){
		$filtro = " and pc.fecha  >= '".$fechaIni."' and pc.fecha <= '".$fechaFin."'";
	} else {
		//$filtro = " and pc.fecha >= '0000-00-00' and pc.fecha <= '0000-00-00'";
		$fechaIni = date('Y-m-d',$start);
		$fechaFin = date('Y-m-d',strtotime('next saturday', $start));
		$filtro = " and pc.fecha  >= '".$fechaIni."' and pc.fecha <= '".$fechaFin."'";
	}
	
	$sql = "select  pv.idproveedor,pv.proveedor, count(pc.idsolicitud) as num_pedidos from pedidos_cliente pc, pedidos_cliente_detalle pd, productos p, proveedores pv where pc.idsolicitud = pd.idsolicitud and pd.idproducto = p.idproducto and p.idproveedor = pv.idproveedor ".$filtro." and pd.idestatus=1
group by proveedor ASC";
	
	$res_sql = mysqli_query($link, $sql);
	
	
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
    
    <link href="../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
    
    <script>
	    
	    function fnFiltro(){
		    var fechaIni = $('#start').val();
		    var fechaFin = $('#end').val();
		    
		    window.location.href = "listado_pedidos.php?fechaini=" + fechaIni + "&fechafin=" + fechaFin;
	    }
	    
	    function fndetalle(idprov){
		    var fechaIni = $('#start').val();
		    var fechaFin = $('#end').val();
		    
		    window.location.href = "pedido_detalle.php?id="+idprov+"&fechaini="+fechaIni+"&fechafin="+fechaFin;
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
		                	
				                <div class="card-body">
					            	<div class="row">
						            	<div class="col-md-8">
							                <div class="input-daterange input-group" id="datepicker-range">
								              <label>Fecha Inicio: </label>&nbsp;
						                      <input type="text" class="form-control" name="start" id="start" value="<?php echo $fechaIni; ?>"/>
						                      <div class="input-group-append ">
						                        <span class="input-group-text"><i class="pg-icon">calendar</i></span>
						                      </div>
						                      &nbsp;&nbsp;&nbsp;
						                      <label>Fecha Fin: </label>&nbsp;
						                      <input type="text" class="form-control" name="end" id="end" value="<?php echo $fechaFin; ?>" />
						                      <div class="input-group-append ">
						                        <span class="input-group-text"><i class="pg-icon">calendar</i></span>
						                      </div>
						                      &nbsp;&nbsp;&nbsp;
						                      <div class="form-group">
								                <button aria-label="" onclick="fnFiltro();" class="btn btn-complete" type="button">Buscar<i class="pg-icon">search</i></button>
									        </div>
						                    </div>
						                </div>
						            </div>
					                
					            </div>
			            </div>
		           </div>
		            <div class="row">
			            <div class="card card-transparent">
						  	<div class="card-header col-5">
						    	<div class="card-title">PEDIDOS A PROVEEDOR</div>
						    </div>
						    <div class="pull-right col-5">
						    	<div class="col-xs-12">
						        	<input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
						    	</div>
						    </div>
						    <div class="clearfix"></div>
						</div>
			            <div class="card-body">
						    <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearchAsc">
						      	<thead>
							        <tr>
										<th>Proveedor</th>
										<th>Total Pedidos</th>
										<th>Ticket</th>
										<!--<th>Estatus</th>-->
							        </tr>
						    	</thead>
								<tbody>
									<?php 
									
										while($row = mysqli_fetch_array($res_sql)){
									?>
							        <tr>
								        <td class="v-align-middle">
											<p><?php echo utf8_encode($row['proveedor']); ?></p>
										</td>
										<td class="v-align-middle">
											<p><?php echo $row['num_pedidos'] ?></p>
										</td>
										<td class='v-align-middle'>
											<button aria-label='' onclick="fndetalle('<?php echo $row['idproveedor']; ?>');" class='btn btn-complete' onclick=''>Confirmacion<i class='pg-icon'>pencil</i></button>
										</td>
										<?php 
												
											/*if($row['idestatus'] == 1){
												echo 	"<td class='v-align-middle'>
															<a href='pedido_detalle.php?id=".$row['idproveedor']."'>
																<button aria-label='' class='btn btn-complete' onclick=''>Confirmacion<i class='pg-icon'>pencil</i></button>
															</a>
														</td>";
												echo 	"<td class='v-align-middle'>
															<p class='text-danger'>Pendiente</p>
														</td>";
											} else {
												
												echo 	"<td class='v-align-middle'>
															<a href=''>
																<button aria-label='' class='btn btn-complete' disabled='disabled'>Confirmacion<i class='pg-icon'>pencil</i></button>
															</a>
														</td>";
												echo 	"<td class='v-align-middle'>
															<p class='text-success'>Confirmado</p>
														</td>";
												
											}*/
											
										?>
										
										
									</tr>
									<?php } ?>
						    	</tbody>
						    </table>
						</div>
						
			  		</div><!-- START ROW -->
	        	</div><!-- START CONTAINER FLUID -->
			</div><!-- page content -->
		
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
    
    <script src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="../assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    
    <script src="<?php echo $dir; ?>pages/js/pages.js"></script>
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?php echo $dir; ?>assets/js/scripts.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?php echo $dir; ?>assets/js/datatables.js" type="text/javascript"></script>
    <script src="../assets/js/form_elements.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
    </body>
</html>