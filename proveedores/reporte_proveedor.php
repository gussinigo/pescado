<?php 

include('../conexion.php');
$link = Conectarse();
$dir = '../';

if(!isset($_COOKIE['iu'])) {
	closeConn($link);
	header("Location: ../index.php"); exit();
}

$fechaIni = $_REQUEST['fechaini'];
$fechaFin = $_REQUEST['fechafin'];
$filtro = "";

if ($fechaIni != '' && $fechaFin != ''){
	$filtro = " AND c.fecha >= '".$fechaIni."' AND c.fecha <= '".$fechaFin."' ";
}

$idproveedor = $_GET['id'];

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

<link href="<?php echo $dir; ?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">

<script>
	
	
	function fnFiltro(){
		var fechaIni = $('#start').val();
		var fechaFin = $('#end').val();
		
		window.location.href = "reporte_cliente.php?id=<?php echo $idproveedor; ?>&fechaini="+fechaIni+"&fechafin="+fechaFin;
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
	<!-- START PAGE CONTENT WRAPPER -->
  <div class="page-content-wrapper ">
	<!-- START PAGE CONTENT -->
	<div class="content ">
		  <!-- START CONTAINER FLUID -->
		<div class=" container-fluid   container-fixed-lg bg-white">
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
			<!-- START card -->
			<div class="card card-transparent">
				  <div class="card-header ">
					<div class="card-title">Listado de Clientes
				</div>
				<div class="clearfix"></div>
			</div>
			  <div class="card-body">
				<table class="table m-t-50" id="tablita">
					  <thead>
						<tr>
							<th>Producto</th>
							<th>Veces Pedida</th>
							<th>Total Comprado</th>
							<th>Total Gastado</th>
							<!--<th>Ticket</th>-->
						</tr>
					</thead>
					<tbody>
						<?php 
							$idsol = "";
							$cont = 0;
							$cont_orden = 1;
							$sql = "SELECT p.producto, COUNT(p.producto) AS veces_pedido, SUM(cd.cantidad) AS total_comprado, um.umedida, SUM(cd.costo_compra) AS total_gastado FROM compras_detalle cd LEFT JOIN compras c ON cd.idcompra = c.idcompra LEFT JOIN productos p ON cd.idproducto = p.idproducto LEFT JOIN proveedores pd ON p.idproveedor = pd.idproveedor LEFT JOIN pedidos_cliente_detalle pcd ON p.idproducto = pcd.idproducto AND  cd.idsolicitud = pcd.idsolicitud LEFT JOIN unidad_medida um ON pcd.peso_idmedida = um.idmedida WHERE pd.idproveedor = '".$idproveedor."' ".$filtro." GROUP BY p.idproducto, pcd.peso_idmedida";
							$res = mysqli_query($link, $sql);
							
							while ($row = mysqli_fetch_array($res)){
								
						?>
						<tr>
							<td class="v-align-middle">
								<p><?php echo $row['producto']; ?></p>
							</td>
							<td class="v-align-middle">
								<p><?php echo $row['veces_pedido']; ?></p>
							</td>
							<td class="v-align-middle">
								<p><?php echo $row['total_comprado']." ".$row['umedida']; ?></p>
							</td>
							<td class="v-align-middle">
								
								<p><?php echo number_format($row['total_gastado'], 2, '.', ','); ?></p>
								
							</td>
							<!--<td class="v-align-middle">
								<button aria-label="" class="btn btn-default" onclick="fnTicket('<?php echo $row['idsolicitud']; ?>');">Ticket<i class="pg-icon">printer</i></button>
							</td>-->
						</tr>
						<?php 
							}
						?>
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
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js" type="text/javascript"></script>

<script src="<?php echo $dir; ?>assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
<script src="<?php echo $dir; ?>assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo $dir; ?>assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo $dir; ?>assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
<script type="text/javascript" src="<?php echo $dir; ?>assets/plugins/datatables-responsive/js/lodash.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js "></script>

<script src="<?php echo $dir; ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="<?php echo $dir; ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo $dir; ?>assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
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
<script src="<?php echo $dir; ?>assets/js/form_elements.js" type="text/javascript"></script>

<!-- END PAGE LEVEL JS -->
<script>
	
	$(document).ready(function() {
		$('#tablita').DataTable( {
			dom: 'Bfrtip',
			buttons: [
				 'excel'
			],
			iDisplayLength: -1,
			order: [[ 0, "asc" ]]
		} );
	} );
	
</script>
</body>
</html>