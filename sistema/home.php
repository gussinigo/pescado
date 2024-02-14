<?php 
	
	include('conexion.php');
	$link = Conectarse();
	$dir='';
	
	if(!isset($_COOKIE['iu'])) {
		closeConn($link);
	    header("Location: index.php"); exit();
	} 
	
	/*$sql = "select p.*, c.cliente, e.estatus from pedidos_cliente p, clientes c, estatus e where  p.idcliente = c.idcliente and p.idestatus = e.idestatus ";
	$res = mysqli_query($link, $sql);*/
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
    <link href="assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="assets/plugins/mapplic/css/mapplic.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/rickshaw/rickshaw.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
    <link href="assets/plugins/jquery-metrojs/MetroJs.css" rel="stylesheet" type="text/css" media="screen" />
    <link class="main-stylesheet" href="pages/css/pages.css" rel="stylesheet" type="text/css" />
    <!-- Please remove the file below for production: Contains demo classes -->
    <link class="main-stylesheet" href="assets/css/style.css" rel="stylesheet" type="text/css" />
    
    <script>
	    
	    function fnEditar(id){
		    window.location.href = 'pedidos_cliente/pedidos_cliente_detalle.php?id=' + id;
		    
	    }
	    
	    function fnTicket(id){
		     //window.location.href = 'invoice.php?id=' + id;
		     window.open('pedidos_cliente/invoice.php?id=' + id, '_blank');
	    }
	    
	    function fnEliminar(id){
		    try{
			    
			    if(confirm('¿Desea eliminar el registro?')){
					$.blockUI({ 
					    baseZ: 20000,
			            message: '<h2><img src="../assets/img/loading.gif" width="80px" height="80px"/>Procesando...</h2>' 
			        });
			        
			        jQuery.post("pedidos_cliente/acciones_pedidos_cliente.php?mode=delete", {
							hdnid:id
						}, function(data, textStatus){
							$.unblockUI();
							if(data == 1){
								$.blockUI({ 
								    baseZ: 20000,
						            message: '<h2><img src="assets/img/check.png"/> Registro Eliminado...</h2>' 
						        }); 
						        
						        setTimeout($.unblockUI, 2000); 
						        
						        
						         window.location.href = 'home.php';
						        
						       
							}
							else if(data == 2){
								   
								   $.blockUI({ 
									    baseZ: 20000,
							            message: '<h2><img src="assets/img/cancel.png"/> Error al eliminar el registro...</h2>' 
							        }); 
							        
							        setTimeout($.unblockUI, 2000); 
	
							        
							} else {
								
								$.blockUI({ 
									    baseZ: 20000,
							            message: '<h2><img src="assets/img/cancel.png"/> Error al eliminar el registro...' + data + '</h2>' 
							        }); 
							        
							        setTimeout($.unblockUI, 3000); 
								
							}
					});
			        
				}
			    
		    }
		    catch (err){
			    alert("Error: " + err.message);
			    $.unblockUI();
		    }
		    
	    }
	    
	</script>
    
  </head>
  <body class="fixed-header dashboard">
    <!-- BEGIN SIDEBPANEL-->
    <nav class="page-sidebar" data-pages="sidebar">
    	<?php include('sidemenu.php') ?>
    </nav>
    <!-- END SIDEBAR -->
    <!-- END SIDEBPANEL-->
    <!-- START PAGE-CONTAINER -->
    <div class="page-container ">
		<!-- START HEADER -->
		<div class="header ">
			<?php include('header.php') ?>
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
			             <!-- col12 -->
		            	<div class="col-lg-12 col-xlg-12">
			            	<!-- row 2 -->
							<div class="row">
						    	<div class="col-sm-4 m-b-10">
							        <div class="ar-1-1">
							          	<!-- START WIDGET widget_plainWidget-->
								        <div class="card e widget widget-6 widget-loader-circle-lg no-margin" style="background: url('assets/img/listos3.jpg'); object-fit: cover; color: white !important">
								            <div class="card-header ">
								              <div class="card-controls">
								                <ul>
								                	<li><a data-toggle="refresh" class="card-refresh" href="#"><i class="card-icon card-icon-refresh-lg-white"></i></a>
													</li>
								                </ul>
								              </div>
								            </div>
								            <div class="card-body">
									            <?php 
										            $hoy = date('Y-m-d');
													$ts = strtotime($hoy);
													$start = (date('w',$ts) == 0) ? $ts : strtotime('last saturday', $ts);
													$fechaIni = date('Y-m-d',$start);
													$fechaFin = date('Y-m-d',strtotime('next saturday', $start));
													$filtro = " fecha >= '".$fechaIni."' and fecha <= '".$fechaFin."'";
													
										            $qr = "SELECT COUNT(idsolicitud) as total_pedidos, fecha FROM pedidos_cliente WHERE ".$filtro;
										            $res_count = mysqli_query($link, $qr);
										            $row_count = mysqli_fetch_array($res_count);
									            ?>
									            <div class="pull-bottom bottom-left bottom-right padding-25">
									                <h1 class="semi-bold"><?php echo $row_count['total_pedidos']; ?></h1>
									                <span class="label font-montserrat fs-11">Pedidos de Clientes</span>
									            </div>
								            </div>
								        </div>
							          	<!-- END WIDGET -->
							        </div>
						    	</div>
						    	
						    	<div class="col-sm-4 m-b-10">
							        <div class="ar-1-1">
							          	<!-- START WIDGET widget_plainWidget-->
								        <div class="card  widget widget-6 widget-loader-circle-lg no-margin" style="background: url('assets/img/listos2.jpg'); object-fit: cover; color: white !important">
								            <div class="card-header ">
								              <div class="card-controls">
								                <ul>
								                	<li><a data-toggle="refresh" class="card-refresh" href="#"><i class="card-icon card-icon-refresh-lg-white"></i></a>
													</li>
								                </ul>
								              </div>
								            </div>
								            <div class="card-body">
									            <?php
										            $hoy = date('Y-m-d');
													$ts = strtotime($hoy);
													$start = (date('w',$ts) == 0) ? $ts : strtotime('last sunday', $ts);
													$fechaIni = date('Y-m-d',$start);
													$fechaFin = date('Y-m-d',strtotime('next saturday', $start));
													$filtro = " fecha >= '".$fechaIni."' and fecha <= '".$fechaFin."'";
										            
										            $qr_compra = "SELECT COUNT(idsolicitud) as num_venta, SUM(subtotal) as total_venta,fecha FROM pedidos_cliente WHERE ".$filtro;
										            $res_compra = mysqli_query($link, $qr_compra);
										            $row_compra = mysqli_fetch_array($res_compra);
									            ?>
									            <div class="pull-bottom bottom-left bottom-right padding-25">
									                <h1 class="semi-bold"><?php echo "$".number_format($row_compra['total_venta'],2); ?></h1>
									                <span class="label font-montserrat fs-11">Venta Total</span>
									                <!--<p class="m-t-20">3 Confirmadas</p>
									                <p class="hint-text m-t-30 no-margin">9 Sin Confirmar</p>-->
									            </div>
								            </div>
								        </div>
							          	<!-- END WIDGET -->
							        </div>
						    	</div>
						    
						    	<div class="col-sm-4 m-b-10">
							        <div class="ar-1-1">
							          	<!-- START WIDGET widget_plainWidget-->
								        <div class="card bg-complete widget widget-6 widget-loader-circle-lg no-margin" style="background: url('assets/img/listos.jpg'); object-fit: cover; color: white !important">
								            <div class="card-header ">
								              <div class="card-controls">
								                <ul>
								                	<li><a data-toggle="refresh" class="card-refresh" href="#"><i class="card-icon card-icon-refresh-lg-white"></i></a>
													</li>
								                </ul>
								              </div>
								            </div>
								            <div class="card-body">
									            <?php 
										            $qr_ganancia = "select SUM(p.costo_compra * pd.peso) AS Costo_total from pedidos_cliente_detalle pd left join productos p on pd.idproducto=p.idproducto left join pedidos_cliente pc on pc.idsolicitud=pd.idsolicitud WHERE pd.idestatus=2 and fecha >= '".$domingo."' AND fecha <= '".$sabado."'";// WHERE idestatus=7 and fecha >= DATE(NOW()) - INTERVAL 7 DAY
										            $res_ganancia = mysqli_query($link, $qr_ganancia);
										            $row_ganancia = mysqli_fetch_array($res_ganancia);
									            ?>
									            <div class="pull-bottom bottom-left bottom-right padding-25">
									                <h1 class="semi-bold"><?php echo "$".number_format($row_ganancia['Costo_total'],2); ?></h1>
									                <span class="label font-montserrat fs-11">Compras Totales</span>
									            </div>
								            </div>
								        </div>
							          	<!-- END WIDGET -->
							        </div> <!-- car-1-1 -->
						    	</div><!-- colsm4 -->
						    </div><!-- row 2 -->
							
		            	</div> <!-- col12 -->
						<!--<div class="row">
						    <div class="container-fluid container-fixed-lg bg-white">
								<!-- START card -->
								<!--<div class="card card-transparent">
								  	<div class="card-header ">
								    	<div class="card-title">Pedidos a proveedor pendientes de actualizar costo
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
												<th>Cliente</th>
												<th>Fecha de Pedido</th>
												<th>Estatus</th>
												<th>Editar</th>
												<th>Borrar</th>
												<th>Ticket</th>
									        </tr>
								    	</thead>
										<tbody>
											<?php 
												//while ($row = mysqli_fetch_array($res)){
											?>
									        <tr>
												<td class="v-align-middle">
													<p> <?php echo utf8_encode($row['idsolicitud']); ?></p>
												</td>
												<td class="v-align-middle">
													<p>
														<?php echo utf8_encode($row['cliente']); ?>
													</p>
												</td>
												<td class="v-align-middle">
													<p><?php echo utf8_encode($row['fecha']); ?></p>
												</td>
												<td class="v-align-middle">
													<p><?php echo utf8_encode($row['estatus']); ?></p>
												</td>
												<td class="v-align-middle">
													<button aria-label="" class="btn btn-complete" id="btneditar" name="btneditar" onclick="fnEditar('<?php echo $row['idsolicitud']; ?>');">Editar<i class="pg-icon">pencil</i></button>
												</td>
												<td class="v-align-middle">
													
													<button aria-label="" class="btn btn-danger" id="btneliminar" name="btneliminar" onclick="fnEliminar('<?php echo $row['idsolicitud']; ?>');">Borrar<i class="pg-icon">trash_alt</i></button>
												</td>
												<td class="v-align-middle">
													<!--<a href="invoice.php">-->
												<!--	<button aria-label="" class="btn btn-default" onclick="fnTicket('<?php echo $row['idsolicitud']; ?>');">Ticket<i class="pg-icon">printer</i></button>
													<!--</a>-->
												<!--</td>
											</tr>
											<?php 
												//}
											?>
											
								    	</tbody>
								    </table>
								</div>
						    </div>
					    </div>-->
			  	</div><!-- START ROW -->
	        </div><!-- START CONTAINER FLUID -->
		</div><!-- page content -->
		
        <!-- END BODY -->
        <!-- END PAGE CONTENT -->
        <!-- START COPYRIGHT -->
        <!-- START CONTAINER FLUID -->
        <!-- START CONTAINER FLUID -->
        <div class=" container-fluid  container-fixed-lg footer">
        	<?php include('footer.php'); ?>
        </div>
        <!-- END COPYRIGHT -->
      </div>
      <!-- END PAGE CONTENT WRAPPER -->
    </div>
    <!-- END PAGE CONTAINER -->
    
    <!-- BEGIN VENDOR JS -->
    <script src="assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <!--  A polyfill for browsers that don't support ligatures: remove liga.js if not needed-->
    <script src="assets/plugins/liga.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="assets/plugins/modernizr.custom.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/plugins/popper/umd/popper.min.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-actual/jquery.actual.min.js"></script>
    <script src="assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script type="text/javascript" src="assets/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="assets/plugins/classie/classie.js"></script>
    <script src="assets/plugins/nvd3/lib/d3.v3.js" type="text/javascript"></script>
    <script src="assets/plugins/nvd3/nv.d3.min.js" type="text/javascript"></script>
    <script src="assets/plugins/nvd3/src/utils.js" type="text/javascript"></script>
    <script src="assets/plugins/nvd3/src/tooltip.js" type="text/javascript"></script>
    <script src="assets/plugins/nvd3/src/interactiveLayer.js" type="text/javascript"></script>
    <script src="assets/plugins/nvd3/src/models/axis.js" type="text/javascript"></script>
    <script src="assets/plugins/nvd3/src/models/line.js" type="text/javascript"></script>
    <script src="assets/plugins/nvd3/src/models/lineWithFocusChart.js" type="text/javascript"></script>
    <script src="assets/plugins/mapplic/js/hammer.min.js"></script>
    <script src="assets/plugins/mapplic/js/jquery.mousewheel.js"></script>
    <script src="assets/plugins/mapplic/js/mapplic.js"></script>
    <script src="assets/plugins/rickshaw/rickshaw.min.js"></script>
    <script src="assets/plugins/jquery-metrojs/MetroJs.min.js" type="text/javascript"></script>
    <script src="assets/plugins/jquery-sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <script src="assets/plugins/skycons/skycons.js" type="text/javascript"></script>
    <script src="assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- END VENDOR JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="pages/js/pages.js"></script>
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="assets/js/scripts.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="assets/js/dashboard.js" type="text/javascript"></script>
    <script src="assets/js/scripts.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
  </body>
</html>