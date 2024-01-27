<?php 
	
	include('../conexion.php');
	$link = Conectarse();
	$dir = '../';
	
	if(!isset($_COOKIE['iu'])) {
		closeConn($link);
	    header("Location: ../index.php"); exit();
	} 
	//filtro fecha
	$hoy = date('Y-m-d');
	$ts = strtotime($hoy);
	$start = (date('w',$ts) == 0) ? $ts : strtotime('last sunday', $ts);
	
	$fechaIni = $_REQUEST['fechaini'];
	$fechaFin = $_REQUEST['fechafin'];
	
	
	if ($fechaIni != '' && $fechaFin != ''){
		$filtro2 = " and p.fecha >= '".$fechaIni."' and p.fecha <= '".$fechaFin."'";
	} else {
		$fechaIni = date('Y-m-d',$start);
		$fechaFin = date('Y-m-d',strtotime('next saturday', $start));
		$filtro2 = " and p.fecha >= '".$fechaIni."' and p.fecha <= '".$fechaFin."'";
		//$filtro2 = '';
	}
	
	//Agregamos idestatus igual a 2 para que muestren solo los productos confirmados por el proveedor para evitar modificar algo no confirmado cualquier pedo comunicarse con Guss
	$sql = "select p.*, c.cliente, e.estatus from pedidos_cliente p, clientes c, estatus e where  p.idcliente = c.idcliente and p.idestatus  = e.idestatus and p.idsolicitud in (select distinct idsolicitud from pedidos_cliente_detalle where  peso = 0 and idmedida <> 4)".$filtro2;
	$res = mysqli_query($link, $sql);
	
	
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
    
    <script>
	    
	    function fnEditar(id){
		    window.location.href = 'pedidos_cliente_detalle.php?id=' + id+'&md=peso';
		    
	    }
	    
	    function fnTicket(id){
		     //window.location.href = 'invoice.php?id=' + id;
		     window.open('invoice.php?id=' + id, '_blank');
	    }
	    
	    function fnEliminar(id){
		    try{
			    
			    if(confirm('¿Desea eliminar el registro?')){
					$.blockUI({ 
					    baseZ: 20000,
			            message: '<h2><img src="../assets/img/loading.gif" width="80px" height="80px"/>Procesando...</h2>' 
			        });
			        
			        jQuery.post("acciones_pedidos_cliente.php?mode=delete", {
							hdnid:id
						}, function(data, textStatus){
							$.unblockUI();
							if(data == 1){
								$.blockUI({ 
								    baseZ: 20000,
						            message: '<h2><img src="../assets/img/check.png"/> Registro Eliminado...</h2>' 
						        }); 
						        
						        setTimeout($.unblockUI, 2000); 
						        
						        
						         window.location.href = 'listado_pedido_cliente.php';
						        
						       
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
			            <h3>Se muestra aquí únicamente el listado de pedidos que se enviaron a proveedor y están pendientes de confirmación de peso.</h3>
			            <div class="card card-transparent">
						  	<div class="card-header col-5">
						    	<div class="card-title">PEDIDOS DE CLIENTES</div>
						    </div>
						    <div class="pull-right col-5">
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
										while ($row = mysqli_fetch_array($res)){
									?>
							        <tr>
										<td class="v-align-middle">
											<p>Pedido <?php echo utf8_encode($row['idsolicitud']); ?></p>
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
											<button aria-label="" class="btn btn-default" onclick="fnTicket('<?php echo $row['idsolicitud']; ?>');">Ticket<i class="pg-icon">printer</i></button>
											<!--</a>-->
										</td>
									</tr>
									<?php 
										}
									?>
									
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