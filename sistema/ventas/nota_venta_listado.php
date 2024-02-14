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
		$filtro = " and p.fecha  >= '".$fechaIni."' and p.fecha <= '".$fechaFin."'";
	} else {
		//$filtro = " and p.fecha >= '0000-00-00' and p.fecha <= '0000-00-00'";
		$fechaIni = date('Y-m-d',$start);
		$fechaFin = date('Y-m-d',strtotime('next saturday', $start));
		
		$filtro = " and p.fecha  >= '".$fechaIni."' and p.fecha <= '".$fechaFin."'";
		
	}
	
	$qr = "select * from pedidos_cliente p left join pedidos_cliente_detalle pd on p.idsolicitud=pd.idsolicitud left join productos pr on pd.idproducto = pr.idproducto left join clientes c on c.idcliente=p.idcliente where p.idestatus <> 7 ".$filtro." group by p.idsolicitud";
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
    
    <script>
	    
	    function fnFiltro(){
		    var fechaIni = $('#start').val();
		    var fechaFin = $('#end').val();
		    
		    window.location.href = "pagos_efectivos.php?fechaini=" + fechaIni + "&fechafin=" + fechaFin;
	    }
	    
		function fnEditar(id){
		    window.location.href = 'pagos_pedidos_detalle.php?id='+id+'&mode=insert';
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
			            <div class="col-xl-12 col-lg-12 ">
		            		<div class="card card-transparent">
								<div class="card-header">
									<div class="card-title">
										Realizar los pagos correspondientes
		                    		</div>
		                  		</div>
		            		</div>
			                <div class="card-body">
			                    <h3>Aqui se selecionan los pedidos para asignarle el tipo de pago.</h3>
			                    <p>En esta seccion se seleccionan y se marcan los pedidos con los diferentes tipos de pagos.</p>
			                    <br>
			                </div>
		            	</div>
		           	</div>
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
			             <div class="card-body">
						    <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
						      	<thead>
							        <tr>
							        	<th>Ticket Pedido</th>
										<th>Cliente</th>
										<th>Fecha de Pedido</th>
										<th>Total</th>
										<th>Registrar Pago</th>
							        </tr>
						    	</thead>
								<tbody>
									<?php 
										
										while($row = mysqli_fetch_array($res)){
										
									?>
							        <tr>
										<td class="v-align-middle">
											<p><?php echo $row['idsolicitud']; ?></p>
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
											<p>$<?php echo $row['subtotal']; ?></p>
										</td>
										<td class="v-align-middle">
											<button aria-label="" class="btn btn-complete" onclick="fnEditar('<?php echo $row['idsolicitud']; ?>');">Pagar<i class="pg-icon">database</i></button>
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