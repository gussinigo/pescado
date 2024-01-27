<?php 
	
	include('../conexion.php');
	$link = Conectarse();
	$dir = '../';
	
	$repartidor = $_REQUEST['rep'];
										
										
	if($repartidor != ''){
		$rep = " and a.idrepartidor='".$repartidor."' ";
	} else {
		$rep = " ";
	}
	
	
	function diaSemana($date) {
	    return date('w', strtotime($date));
	}
	
	/*$DoW = diaSemana(date('Y-m-d'));
	$fecha = date('Y-m-d');
	$domingo = date('Y-m-d', strtotime('-'.$DoW.' day', strtotime($fecha)));
	$sabado = date('Y-m-d', strtotime('+6 day', strtotime($domingo)));*/
	
	$hoy = date('Y-m-d');
	$ts = strtotime($hoy);
	$start = (date('w',$ts) == 0) ? $ts : strtotime('last sunday', $ts);
	
	$fechaIni = $_REQUEST['fechaini'];
	$fechaFin = $_REQUEST['fechafin'];
	
	if ($fechaIni != '' && $fechaFin != ''){
		$filtro = " and p.fecha  >= '".$fechaIni."' and p.fecha <= '".$fechaFin."'";
	} else {
		
		/*$fechaIni = $domingo;
		$fechaFin = $sabado;*/
		$fechaIni = date('Y-m-d',$start);
		$fechaFin = date('Y-m-d',strtotime('next saturday', $start));
		
		$filtro = " and p.fecha >= '$fechaIni' and p.fecha <= '$fechaFin'";
	}
	
	$qr = "select * from pedidos_cliente p LEFT JOIN asignacion_rutas ar ON p.idsolicitud=ar.idsolicitud left join pedidos_cliente_detalle pd on p.idsolicitud=pd.idsolicitud left join productos pr on pd.idproducto = pr.idproducto left join clientes c on c.idcliente=p.idcliente left join zonas z on c.idzona = z.idzona where p.idestatus <> 7 ".$filtro." group by p.idsolicitud";
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
    <link href="<?php echo $dir; ?>https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="<?php echo $dir; ?>assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo $dir; ?>assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo $dir; ?>assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $dir; ?>assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $dir; ?>assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />
    <link class="main-stylesheet" href="<?php echo $dir; ?>pages/css/pages.css" rel="stylesheet" type="text/css" />
    <!-- Please remove the file below for production: Contains demo classes -->
    <link class="main-stylesheet" href="<?php echo $dir; ?>assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo $dir; ?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
    <?php 
	    if ($_GET['al'] == 1){
		    echo "alert('Registros Actualizados')";
	    }
    ?>
    <script>
	    
	    function fnFiltro(){
		    var fechaIni = $('#start').val();
		    var fechaFin = $('#end').val();
			var repartidor = $('#repartidor').val();
		    
		    window.location.href = "pagos_efectivos.php?fechaini=" + fechaIni + "&fechafin=" + fechaFin + "&rep=" + repartidor;
	    }
	    
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
										Envio de Pagos en Efectivo
		                    		</div>
		                  		</div>
		            		</div>
			                <div class="card-body">
			                    <h3>Aqui se selecionan los pedidos que seran pagados en efectivo.</h3>
			                    <p>En esta seccion se seleccionan y se marcan los pedidos pagados en efectivo.</p>
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
				                <div class="row">
									<div class="col-md-12">
										<div class="col-md-6">
											<div class="form-group-attached">
												<div class="form-group form-group-default">
														<label>Repartidores</label>
														<select class="full-width" data-init-plugin="select2" id="repartidor" name="repartidor">
															<optgroup label="Repartidores">
																<option value="">Ninguno</option>
																<?php
																	$qr1 = "SELECT idrepartidor, repartidor FROM repartidores";
																	$res1 = mysqli_query($link, $qr1);
																	while($row_prov = mysqli_fetch_array($res1)){
																		if($row_prov['idrepartidor'] == $repartidor){
																			$selected = "selected='selected'";
																		} else {
																			$selected = '';
																		}
																?>
																<option value="<?php echo $row_prov['idrepartidor']; ?>" <?php echo $selected; ?>><?php echo $row_prov['repartidor']; ?></option>
																<?php } ?>
															</optgroup>
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
				            </div>
			            </div>
		           </div>
		            <div class="row">
			             <div class="card-body">
							 <div class="pull-right">
								   <div class="col-xs-12">
									 <input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
								   </div>
							 </div>
				             <form name="listado" method="post" action="accion_pagar_efe.php">
						    <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearchVenta">
						      	<thead>
							        <tr>
										<th style="width: 10%;">Zona</th>
										<th style="width: 10%;">Orden</th>
										<th style="width: 20%;">Cliente</th>
										<th style="width: 10%;">Ticket Pedido</th>
										<th>Fecha de Pedido</th>
										<th style="width: 10%;">Total</th>
								        <th style="width: 10%; text-align: center;">Seleccionar</th>
								        <th>Tipo de Pago</th>
							        </tr>
						    	</thead>
								<tbody>
									<?php
										//$qr = "select * from pedidos_cliente p LEFT JOIN asignacion_rutas ar ON p.idsolicitud=ar.idsolicitud left join pedidos_cliente_detalle pd on p.idsolicitud=pd.idsolicitud left join productos pr on pd.idproducto = pr.idproducto left join clientes c on c.idcliente=p.idcliente left join zonas z on c.idzona = z.idzona where p.idestatus <> 7 ".$filtro." group by p.idsolicitud";
										
										$qr = "select p.idsolicitud, a.idasignacion, c.cliente, a.orden, p.idsolicitud, p.fecha, c.sm, c.residencial, r.repartidor, a.idrepartidor, z.zona, p.subtotal from asignacion_rutas a left join pedidos_cliente p on a.idsolicitud=p.idsolicitud left join clientes c on p.idcliente=c.idcliente left join repartidores r on a.idrepartidor = r.idrepartidor left join zonas z on c.idzona = z.idzona where p.idestatus <> 7".$rep." and p.fecha >= '".$fechaIni."' AND p.fecha <= '".$fechaFin."' ORDER BY a.orden ASC";
										$res = mysqli_query($link, $qr);
										
										while ($row = mysqli_fetch_array($res))
										{
									?>
							        <tr>
										<td><?php echo $row['zona']; ?></td>
										<td class="v-align-middle">
											<p>
												<?php echo $row['orden']; ?>
											</p>
										</td>
										<td class="v-align-middle">
											<p>
												<?php echo $row['cliente']; ?>
											</p>
										</td>
										<td class="v-align-middle">
											<p><?php echo $row['idsolicitud']; ?></p>
										</td>
										<td class="v-align-middle">
											<p><?php echo $row['fecha']; ?></p>
										</td>
										<td class="v-align-middle">
											<p>$<?php echo $row['subtotal']; ?></p>
										</td>
								        <td class="v-align-middle" style="text-align: center;">
									        <div class="form-check complete">
						                    	<input type="checkbox" id="checkColorOpt<?php echo $row['idsolicitud'];?>" name="checked[]" value="<?php echo $row['idsolicitud'];?>">
												<label for="checkColorOpt<?php echo $row['idsolicitud'];?>"></label>
						                    </div>
								        </td>
								        <td>
									        <select class="full-width" id="tipo_pago" name="tipo_pago[]" data-init-plugin="select2">
					                        	<optgroup label="Forma de Pago">
					                            <?php
						                        	$qr="select * from tipo_pago";
						                        	$res_qr = mysqli_query($link, $qr);
						                        	while ($row_qr = mysqli_fetch_array($res_qr)){
							                        	if($row_qr['idtipopago'] == $row['idtipopago']){
								                        	$selected = "selected='selected'";
							                        	} else {
								                        	$selected = '';
							                        	}
					                        	?>
													<option value="<?php echo $row_qr['idtipopago']; ?>" <?php echo $selected; ?>><?php echo utf8_encode($row_qr['tipo_pago']); ?></option>
												<?php 
													}
												?>
					                          </optgroup>
					                        </select>
								        </td>
									</tr>
									<?php }?>
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
    <script src="<?php echo $dir; ?>assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo $dir; ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="<?php echo $dir; ?>assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="<?php echo $dir; ?>pages/js/pages.js"></script>
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?php echo $dir; ?>assets/js/scripts.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="<?php echo $dir; ?>assets/js/form_elements.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/js/datatables.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
  </body>
</html>