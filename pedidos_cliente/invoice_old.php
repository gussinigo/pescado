<?php 
	
	include('../conexion.php');
	$link = Conectarse();
	$dir = '../';
	
	if(!isset($_COOKIE['iu'])) {
		closeConn($link);
	    header("Location: ../index.php"); exit();
	} 
	
	$id = $_REQUEST['id'];
	
	$sql = "select p.*, c.cliente, e.estatus, r.repartidor, z.zona from pedidos_cliente p, clientes c, estatus e, repartidores r, zonas z where  p.idcliente = c.idcliente and p.idestatus = e.idestatus and c.idrepartidor = r.idrepartidor and r.idzona = z.idzona  and p.idsolicitud = ".$id;
	$res = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($res);
	
	
	
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
			          <div class=" container-fluid   container-fixed-lg">
			            <!-- START card -->
			            <div class="card card-default m-t-20">
			              <div class="card-body">
			                <div class="invoice padding-50 sm-padding-10">
			                  <div>
			                    <div class="pull-left">
			                      <img width="235" height="47" alt="" class="invoice-logo" data-src-retina="<?php echo $dir; ?>assets/img/logo_2x.png" data-src="<?php echo $dir; ?>assets/img/logo_2x.png" src="<?php echo $dir; ?>assets/img/logo_2x.png">
			                      <address class="m-t-10">
			                                    El buen pescado
			                                    <br>(998) 123456.
			                                    <br>
			                                </address>
			                    </div>
			                    <div class="pull-right sm-m-t-20">
			                      <h2 class="font-montserrat all-caps hint-text">TICKET DE VENTA</h2>
			                    </div>
			                    <div class="clearfix"></div>
			                  </div>
			                  <br>
			                  <br>
			                  <div class="col-12">
			                    <div class="row">
			                      <div class="col-lg-9 col-sm-height sm-no-padding">
			                        <p class="small no-margin">CLIENTE:</p>
			                        <h5 class="semi-bold m-t-0"><?php echo utf8_encode(strtoupper($row['cliente'])); ?></h5>
			                        
			                      </div>
			                      <div class="col-lg-3 sm-no-padding sm-p-b-20 d-flex align-items-end justify-content-between">
			                        <div>
			                          <div class="font-montserrat bold all-caps">Pedido No:  </div>
			                          <div class="font-montserrat bold all-caps">Fecha :</div>
			                          <div class="clearfix"></div>
			                        </div>
			                        <div class="text-right">
			                          <div class=""><?php echo $row['idsolicitud']; ?></div>
			                          <div class=""><?php echo $row['fecha']; ?></div>
			                          <div class="clearfix"></div>
			                        </div>
			                      </div>
			                    </div>
			                  </div>
			                  <div class="table-responsive table-invoice">
			                    <table class="table m-t-50">
			                      <thead>
			                        <tr>
			                          <th class="">Descripcion</th>
			                          <th class="text-center">Cantidad</th>
			                          <th class="text-center">U.Medida</th>
			                          <th class="text-right">Costo</th>
			                        </tr>
			                      </thead>
			                      <tbody>
				                      <?php 
											
											$qr_det = "select p.*, d.*, c.codigo, c.producto, c.costo_venta, m.umedida from pedidos_cliente p, pedidos_cliente_detalle d, productos c, unidad_medida m where p.idsolicitud = d.idsolicitud and d.idproducto = c.idproducto and d.idmedida = m.idmedida and p.idsolicitud = ".$row['idsolicitud'];
											$res_det = mysqli_query($link, $qr_det);
											
											$subtotal = 0;
											
											while ($row_det = mysqli_fetch_array($res_det)){
												
												if($row_det['idmedida'] == '1'){
													$costo = $row_det['peso'] * $row_det['costo_venta'];
												} else {
													$costo = $row_det['cantidad'] * $row_det['costo_venta'];
												}
													
										?>
			                        <tr>
			                          <td class="">
			                            <p class="text-black"><?php echo utf8_encode($row_det['producto']);?></p>
			                            
			                          </td>
			                          <td class="text-center"><?php echo utf8_encode($row_det['cantidad']);?></td>
			                          <td class="text-center"><?php echo utf8_encode($row_det['umedida']);?></td>
			                          <td class="text-right">$ <?php echo number_format($costo,2,'.',','); ?></td>
			                        </tr>
			                        <?php 
				                           $subtotal = $subtotal + $costo;
				                          
				                        }
			                        ?>
			                        
			                      </tbody>
			                    </table>
			                  </div>
			                  <br>
			                  <br>
			                  <br>
			                  <br>
			                  <br>
			                 
			                  <br>
			                  <br>
			                  <div class="p-l-15 p-r-15">
			                    <div class="row b-a b-grey">
			                      <div class="col-md-2 p-l-15 sm-p-t-15 clearfix sm-p-b-15 d-flex flex-column justify-content-center">
			                        <h5 class="font-montserrat all-caps small no-margin hint-text bold">Subtotal</h5>
			                        <h3 class="no-margin">$ <?php echo number_format($subtotal,2,'.',',');?></h3>
			                      </div>
			                      <div class="col-md-5 clearfix sm-p-b-15 d-flex flex-column justify-content-center">
			                        <h5 class="font-montserrat all-caps small no-margin hint-text bold">IVA</h5>
			                        <?php 
				                        $iva = $subtotal * 0.16;
			                        ?>
			                        <h3 class="no-margin">$ <?php echo number_format($iva,2,'.',','); ?></h3>
			                      </div>
			                      <div class="col-md-5 text-right bg-contrast-higher col-sm-height padding-15 d-flex flex-column justify-content-center align-items-end">
			                        <h5 class="font-montserrat all-caps small no-margin hint-text text-white bold">Total</h5>
			                        <?php
				                        $total = $subtotal + $iva;
			                        ?>
			                        <h1 class="no-margin text-white">$ <?php echo number_format($total,2,'.',','); ?></h1>
			                      </div>
			                    </div>
			                  </div>
			                  <hr>
			                  <p class="small hint-text">Zona: <?php echo utf8_decode($row['zona']); ?></p>
			                  <br/>
			                  <p class="small hint-text">Repartidor: <?php echo utf8_encode($row['repartidor']); ?></p>
			                  <br>
			                  <hr>
			                  
			                </div>
			              </div>
			            </div>
			            <!-- END card -->
			            <div class="row">
					      <div class="col-8">
						      <a href="listado_pedido_cliente.php">
							  	<button aria-label="" class="btn btn-complete pull-right" type="submit">Finalizar</button>
						      </a>
					      </div>
					    </div>
			          </div>
			          <!-- END CONTAINER FLUID -->
		        
		    </div>
			
    
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