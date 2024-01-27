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
    <?php 
	    if ($_GET['al'] == 1){
		    echo "
		    <script>
		    alert('Ruta asignada');
		    </script>
		    ";
	    }
    ?>
    <script>
	    function myFunction() {
		  var x = document.getElementById("enviarbtn");
		  x.style.display = "block";
		}
		function editar() {
			var y = document.getElementById("idrepartidor").value;
			window.location.href ='listado_rutas_orden.php?idrepartidor='+y+'accion=edit';
		 
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
										Asignación de rutas
		                    		</div>
		                  		</div>
		            		</div>
			                <div class="card-body">
			                    <h3>Te mostramos los pedidos solicitados</h3>
			                    
			                    <br>
			                </div>
		            	</div>
		           	</div>
		            <form name="listado" method="post" action="listado_rutas_orden.php">
						<div class="row">
				            <div class="card card-default">
			                  	<div class="card-header ">
			                    	<div class="card-title">
				                    	<p>Paso 1: </p>
				                    	<p>Selecciona el repartidor.</p>
										
			                   		</div>
									   
			                	</div>
				                <div class="card-body">
					              	<div class="row">
						                <div class="col-md-12">
							                <div class="form-group form-group-default">
										        <label>Asigna Repartidor</label>
						                        <select class="full-width" data-init-plugin="select2" id="idrepartidor" name="idrepartidor" onchange="myFunction()">
							                        <option value="">Seleccione un repartidor</option>
						                        	<optgroup label="zona">
														<?php
								                        	$qr="select * from repartidores";
								                        	$res_qr = mysqli_query($link, $qr);
								                        	while ($row_qr = mysqli_fetch_array($res_qr)){
									                        	if($row_qr['idrepartidor'] == $row['idrepartidor']){
										                        	$selected = "selected='selected'";
									                        	} else {
										                        	$selected = '';
									                        	}
								                        ?>
								                        	<option value="<?php echo $row_qr['idrepartidor']; ?>" <?php echo $selected; ?>><?php echo $row_qr['repartidor']; ?></option>
														<?php 
															}
														?>
						                        	</optgroup>
						                        </select>
										     </div>
											
						                </div>
					              	</div> 						          
				                </div>
				            </div>
			           	</div>
			            <div class="row">
				            
				            <div class="card-body">
					            <div class="card-header ">
			                    	<div class="card-title">
				                    	<p>PASO 2: </p>
				                    	<p>Selecciona con la casilla, los pedidos que quieres asignar</p>
			                   		</div>
			                   		<!--<div class="pull-right col-5">
								    	<div class="col-xs-12">
								        	<input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
								    	</div>
								    </div>
								    <div class="clearfix"></div>-->
			                	</div>
					            
							    <table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearchRoute">
							      	<thead>
								        <tr>
									        <th style="width: 10%;"></th>
								        	<th style="width: 10%;">Ticket Pedido</th>
											<th>Cliente</th>
											<th>Fecha de Pedido</th>
											<!--<th style="width: 10%;">SMZ</th>-->
											<th>Residencial</th>
											
											
								        </tr>
							    	</thead>
									<tbody>
										<?php 
											$hoy = date('Y-m-d');
											$ts = strtotime($hoy);
											$start = (date('w',$ts) == 0) ? $ts : strtotime('last sunday', $ts);
											$fechaIni = date('Y-m-d',$start);
											$fechaFin = date('Y-m-d',strtotime('next saturday', $start));
											$filtro2 = " and p.fecha >= '".$fechaIni."' and p.fecha <= '".$fechaFin."'";
											$qr = "select * from pedidos_cliente p left join pedidos_cliente_detalle pd on p.idsolicitud=pd.idsolicitud left join productos pr on pd.idproducto = pr.idproducto left join clientes c on c.idcliente=p.idcliente where p.idestatus <>7 and p.idestatus<>4 and p.idestatus<>5 $filtro2 group by p.idsolicitud";
											$res = mysqli_query($link, $qr);
												
											while ($row = mysqli_fetch_array($res))
											{
										?>
								        <tr>
									        <td class="v-align-middle">
										        <div class="form-check complete">
							                      <input type="checkbox" id="checkColorOpt<?php echo $row['idsolicitud'];?>" name="checked[]" value="<?php echo $row['idsolicitud'];?>">
							                      <label for="checkColorOpt<?php echo $row['idsolicitud'];?>"></label>
							                    </div>
									        </td>
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
											<!--<td class="v-align-middle">
												<p><?php echo $row['sm']; ?></p>
											</td>-->
											<td class="v-align-middle">
												<p><?php echo $row['residencial']; ?></p>
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
							                <div class="form-group" id="enviarbtn" style="display: none">
								                <p></p>
								                <button type="submit" aria-label="" class="btn btn-complete">Enviar <i class="pg-icon"> send</i></button>
									        </div>
					                    </div>
					              	</div>
				                </div>
				            </div>
		           		</div>
			  		</form>
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
    <script>
		var table = $('#tableWithSearchRoute');
		
		$("#listado").on("submit", function(e){
		    //Stop the form submitting
		    e.preventDefault();
		    //Show all the rows
		    table.dataTable("iDisplayLength": -1);
		    //Submit the form now it can see everything
		    $(this).submit();
		});
	    
    </script>
    
  </body>
</html>