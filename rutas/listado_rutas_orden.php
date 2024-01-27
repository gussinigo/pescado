<?php 
	
	include('../conexion.php');
	$link = Conectarse();
	$dir = '../';
	$conta=0;
		foreach ($_POST['checked'] as $idsolicitud) {
		if ($conta == 0) { $or= ' pd.idsolicitud='.$idsolicitud; }
		else {$or.= ' or pd.idsolicitud='.$idsolicitud;}
		
		$conta++;
	}
	$idrepartidor=$_REQUEST['idrepartidor'];
	
	
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
    <?php 
	    if ($_GET['al'] == 1){
		    echo "alert('Registros Actualizados')";
	    }
    ?>
    <script>
	    
	    function fnEnviar(){
		    var modalElem = $('#modalSlideUp');
		    var url = 'pagos_efectivo_detalle.php';
		    
		    $('#paginas').load(url);
		    
		    $('#modalSlideUp').modal('show')
		    modalElem.children('.modal-dialog').removeClass('modal-lg');
	    }
	    
	    function fncloseModal(){
  
			var modalElem = $('#modalSlideUp');
			$('#modalSlideUp').modal('hide')
		    modalElem.children('.modal-dialog').removeClass('modal-lg');
		    
			 
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
			            <div class="col-xl-6 col-lg-6 ">
		            		<div class="card card-transparent">
								<div class="card-header">
									<div class="card-title">
										
		                    		</div>
		                  		</div>
		            		</div>
			                <div class="card-body">
			                    <h3>Paso 3: Asigna un orden escribiendo el numero </h3>
			                    
			                    <br>
			                </div>
		            	</div>
		           </div>
		           
		            <div class="row">
			            
			             <div class="card-body">
				             
				             <form name="listado" method="post" action="acciones_rutas.php">
						    <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
						      	<thead>
							        <tr>
								        <th style="width: 10%;">Orden</th>
							        	<th style="width: 10%;">Ticket Pedido</th>
										<th>Cliente</th>
										<th>Fecha de Pedido</th>
										<!--<th style="width: 10%;">SMZ</th>-->
										<th>Residencial</th>
										
							        </tr>
						    	</thead>
								<tbody>
									<?php 
										$qr = "select * from pedidos_cliente p left join pedidos_cliente_detalle pd on p.idsolicitud=pd.idsolicitud left join productos pr on pd.idproducto = pr.idproducto left join clientes c on c.idcliente=p.idcliente where p.idestatus <>7 and (".$or." ) group by p.idsolicitud";
										
										$res = mysqli_query($link, $qr);
										$contanew=1;		
										while ($row = mysqli_fetch_array($res))
										{
									?>
							        <tr>
								        <td class="v-align-middle">
									        <div class="form-check complete">
						                      <input type="text"  name="orden[]" value="" size="5">
						                     
						                    </div>
								        </td>
										<td class="v-align-middle">
											<p><?php echo $row['idsolicitud']; ?></p>
											<input type="hidden" name="idsol[]" value="<?php echo $row['idsolicitud']; ?>" />
											<input type="hidden" name="idrepartidor" value="<?php echo $idrepartidor; ?>" />
											
										</td>
										<td class="v-align-middle">
											<p>
												<?php echo $row['cliente']; ?>
											</p>
										</td>
										<td class="v-align-middle">
											<p><?php echo $row['fecha']; ?></p>
										</td>
										<!--<td class="v-align-middle">
											<p><?php echo $row['sm']; ?></p>
										</td>-->
										<td class="v-align-middle">
											<p><?php echo $row['residencial']; ?></p>
										</td>
									</tr>
									<?php
										$contanew++;
										 }?>
						    	</tbody>
						    </table>
				             
						</div>
						
			  		</div><!-- START ROW -->
			  		
			  		<div class="row">
			            <div class="card card-default">
			                  	<div class="card-header ">
			                    	<div class="card-title">
			                   		</div>
			                	</div>
				                <div class="card-body">
					              <div class="row">
						                <div class="col-md-10">
							                
						                </div>
					                    <div class="col-md-2">
							                <div class="form-group">
								                <p></p>
								                <button type="submit" aria-label="" class="btn btn-complete" >Enviar <i class="pg-icon"> send</i></button>
									        </div>
					                    </div>
					              </div>
					              
						          </form>
						          
				                </div>
			            </div>
		           </div>
			  		
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