<?php 
	
	include('../conexion.php');
	$link = Conectarse();
	$dir = '../';
	
	if(!isset($_COOKIE['iu'])) {
		closeConn($link);
	    header("Location: ../index.php"); exit();
	} 
	
	$id = $_REQUEST['id'];
	
	if($id == ''){
		$action = "acciones_clientes.php?mode=insert";
		$url = 'mapa.php?id=0';
	} else {
		$action = "acciones_clientes.php?mode=edit";
		
		$sql = "select * from clientes where idcliente = ".$id;
		$res = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($res);
		
		$url = 'mapa.php?id='.$id;  //'&clie='.$row['cliente'].'&dir='.$row['sm'].'&lat='.$row['lat'].'&lng='.$row['lng'].'&type='.$row['type'];
		

		
	}
	
	
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title>El Buen Pescado</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <link rel="apple-touch-icon" href="../assets/img/logo-48x48_c.png">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/logo-48x48_c.png">
    <link rel="apple-touch-icon" sizes="120x120" href="../assets/img/logo-48x48_c@2x.png">
    <link rel="apple-touch-icon" sizes="152x152" href="../assets/img/logo-48x48_c@2x.png">
    <link rel="icon" type="image/x-icon" href="../assets/img/logo-48x48_c.png" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="Meet pages - The simplest and fastest way to build web UI for your dashboard or app." name="description" />
    <meta content="Ace" name="author" />
    <link href="../assets/plugins/pace/pace-theme-flash.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../assets/plugins/jquery-datatable/media/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/jquery-datatable/extensions/FixedColumns/css/dataTables.fixedColumns.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/datatables-responsive/css/datatables.responsive.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link class="main-stylesheet" href="../pages/css/pages.css" rel="stylesheet" type="text/css" />
    <!-- Please remove the file below for production: Contains demo classes -->
    <link class="main-stylesheet" href="../assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
    
    <script>
	    
	    function fnGuardar(){
		    try
		    {
			    if(fnValida()){
			        var txtcliente = $('#txtcliente').val();
				    var txtsmz = $('#txtsmz').val();
				    var txtmza = $('#txtmza').val();
				    var txtcalle = $('#txtcalle').val();
				    var txtlote = $('#txtlote').val();
				    var txttel = $('#txttel').val();
				    //var idrepartidor = $('#idrepartidor').val();
				    var txtlat = $('#txtlat').val();
				    var txtlong = $('#txtlong').val();
				    
				    var cumpleanios = $('#txtcumple').val();
					var txtresidencial = $('#txtresidencial').val();
					var txtreferido = $('#txtreferido').val();
					var idzona = $('#idzona').val();
				    
				    var hdnid = $('#hdnid').val();
		    
				    $.blockUI({ 
					    baseZ: 20000,
			            message: '<h2><img src="../assets/img/loading.gif" width="80px" height="80px"/>Procesando...</h2>' 
			        });
				     
				     jQuery.post("<?php echo $action; ?>", {
								txtcliente:txtcliente,
								txtsmz:txtsmz,
								txtmza:txtmza,
								txtcalle:txtcalle,
								txtlote:txtlote,
								txttel:txttel,
								txtlat:txtlat,
								txtlong:txtlong,
								cumpleanios:cumpleanios,
								txtresidencial:txtresidencial,
								txtreferido:txtreferido,
								idzona:idzona,
								hdnid:hdnid
							}, function(data, textStatus){
								$.unblockUI();
								if(data == 1){
									$.blockUI({ 
									    baseZ: 20000,
							            message: '<h2><img src="../assets/img/check.png"/> Registro guardado correctamente...</h2>' 
							        }); 
							        
							        setTimeout($.unblockUI, 2000); 
							        
							        
							         window.location.href = 'listado_clientes.php';
							        
							       
								}
								else if(data == 2){
									   
									   $.blockUI({ 
										    baseZ: 20000,
								            message: '<h2><img src="../assets/img/cancel.png"/> Error al guardar el registro...</h2>' 
								        }); 
								        
								        setTimeout($.unblockUI, 2000); 
								        
		
								        
								} else {
										$.blockUI({ 
										    baseZ: 20000,
								            message: '<h2><img src="../assets/img/cancel.png"/> Error al guardar el registro...'+ data +'</h2>' 
								        }); 
								        
								        setTimeout($.unblockUI, 3000); 
								        
								}
					});
			    } else {
				    alert('Favor de llenar los campos obligatorios y seleccionar la ubicacion del cliente...');
			    }
			    
		    }
		    catch (err){
			    alert("Error: " + err.message);
			    $.unblockUI();
		    }
	    }
	    
	    function fnValida(){
		    
		    try
		    {
			    var txtcliente = $('#txtcliente').val();
			    //var txtsmz = $('#txtsmz').val();
			    var txtcalle = $('#txtcalle').val();
			    var txttel = $('#txttel').val();
			    //var idrepartidor = $('#idrepartidor').val();
			    var txtlat = $('#txtlat').val();
			    var txtlong = $('#txtlong').val();
			    

			    if(txtcliente == '') return false;
			    //if(txtsmz == '') return false;
			    if(txtcalle == '') return false;
			    if(txttel == '') return false;
			    //if(idrepartidor == '') return false;
			    if(txtlat == '') return false;
			    if(txtlong == '') return false;

			    return true;
		    }
		    catch (err) {
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
        	<div class="content ">
				<!-- START CONTAINER FLUID -->
		        <div class=" container-fluid container-fixed-lg">
			        <div class="row">
		            	<div class="col-xl-6 col-lg-6 ">
		            		<div class="card card-transparent">
								<div class="card-header">
									<div class="card-title">
										Acerca de Capturar Clientes
		                    		</div>
		                  		</div>
		            		</div>
			                <div class="card-body">
			                    <h3>Aqui se registraran los clientes ya sean temporales o constantes.</h3>
			                    <p>Con los clientes aqui registrados sera mas facil armar pedidos</br> 
				                   porque ya tendran una lista armada</p>
			                    <br>
			                </div>
		            	</div>
		            	
						<div class="col-xl-6 col-lg-6 ">
		                <!-- START card -->
		                	<div class="card-body">
				                <!-- START card -->
				                <div class="card">
									<div class="card-header ">
										<div class="card-title">Clientes
										</div>
									</div>
									<div class="card-body">
										<input type="hidden" id="hdnid" name="hdnid" value="<?php echo $id; ?>" />
										 	<h3 class="mw-80">Clientes</h3>
										    <div class="form-group-attached">
										      <div class="form-group form-group-default required">
										        <label>Nombre del Cliente</label>
										        <input type="text" class="form-control" id="txtcliente" name="txtcliente" value="<?php echo utf8_encode($row['cliente']); ?>" placeholder="Nombre del Cliente" required>
										      </div>
										      <div class="row clearfix">
										        <div class="col-md-6">
										          <div class="form-group form-group-default">
								                      <div class="form-group ">
									                    <label>Supermanzana</label>
														<input type="text" class="form-control" id="txtsmz" name="txtsmz" value="<?php echo utf8_encode($row['sm']); ?>" placeholder="SMZ" required>
								                      </div>
										          </div>
										        </div>
										        <div class="col-md-6">
										          <div class="form-group form-group-default">
										            <label>Manzana</label>
										            <input type="text" class="form-control" name="txtmza" id="txtmza" value="<?php echo utf8_encode($row['mza']); ?>" placeholder="MZN">
										          </div>
										        </div>
										      </div>
										    </div>
										    
										    <div class="form-group-attached">
										      <div class="row clearfix">
										        <div class="col-md-12">
										          <div class="form-group form-group-default required">
								                      <div class="form-group ">
									                    <label>Calle</label>
														<input type="text" class="form-control" id="txtcalle" name="txtcalle" value="<?php echo utf8_encode($row['calle']); ?>" placeholder="Calle" required>
								                      </div>
										          </div>
										        </div>
										      </div>
										    </div>
										    
											<div class="form-group-attached">
												<div class="row clearfix">
													<div class="col-md-6">
											          <div class="form-group form-group-default">
											            <label>Lote</label>
											            <input type="text" class="form-control" name="txtlote" id="txtlote" value="<?php echo utf8_encode($row['lote']); ?>" placeholder="Lote">
											          </div>
											        </div>
													<div class="col-md-6">
														<div class="form-group form-group-default required">
															<label>Numero Telefonico</label>
															<input type="text" class="form-control" id="txttel" name="txttel" value="<?php echo utf8_encode($row['telefono']); ?>" placeholder="Numero Telefonico" required>
														</div>
													</div>
												</div>
										    </div>
										    <div class="form-group-attached">
											    <div class="row clearfix">
												   <div class="col-md-6">
														<div class="form-group form-group-default ">
															<label>Cumpleaños</label>
															<input type="text" class="form-control" id="txtcumple" name="txtcumple" value="<?php echo utf8_encode($row['fecha_cumpleanios']); ?>" placeholder="Fecha de Cumpleaños" >
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group form-group-default ">
															<label>Residencial</label>
															<input type="text" class="form-control" id="txtresidencial" name="txtresidencial" value="<?php echo utf8_encode($row['residencial']); ?>" placeholder="Residencial" >
														</div>
													</div>
											    </div>
										    </div>
										    <div class="form-group-attached">
											    <div class="row clearfix">
												    <div class="col-md-12">
														<div class="form-group form-group-default ">
															<label>Referido</label>
															<input type="text" class="form-control" id="txtreferido" name="txtreferido" value="<?php echo utf8_encode($row['referido']); ?>" placeholder="Referido" >
														</div>
													</div>
											    </div>
										    </div>
										    <div class="form-group form-group-default" >
										        <label>Zona</label>
						                        <select class="full-width" data-init-plugin="select2" id="idzona" name="idzona">
							                        <option value="">Seleccione una opcion</option>
						                        	<optgroup label="zona">
														<?php
									                        	$qr="select * from zonas";
									                        	$res_qr = mysqli_query($link, $qr);
									                        	while ($row_qr = mysqli_fetch_array($res_qr)){
										                        	if($row_qr['idzona'] == $row['idzona']){
											                        	$selected = "selected='selected'";
										                        	} else {
											                        	$selected = '';
										                        	}
								                        	?>
								                        	<option value="<?php echo $row_qr['idzona']; ?>" <?php echo $selected; ?>><?php echo utf8_encode($row_qr['zona']); ?></option>
														<?php 
															}
														?>
						                        	</optgroup>
						                        </select>
										      </div>
										    <br>
										    <div class="row">
										      <div class="col-12">
												  	<button aria-label="" class="btn btn-complete pull-right" id="btnguardar" name="btnguardar" onclick="fnGuardar();">Guardar</button>
										      </div>
										    </div>
									</div>
								</div>
		                	</div>
							<!-- END card -->
						</div>
						<div class="col-xl-6 col-lg-6 ">
						    <div class="form-group-attached">
						    	<div class="form-group form-group-default">
							        <!--<div class="map-controls">
							            <div class="pull-left">
							            	<div class="btn-group-vertical" data-toggle="buttons-radio">
												<button aria-label="" id="map-zoom-in" class="btn btn-success btn-xs btn-icon"><i class="pg-icon">add</i>
												</button>
												<button aria-label="" id="map-zoom-out" class="btn btn-success btn-xs btn-icon"><i class="pg-icon">minus</i>
												</button>
							              	</div>
							            </div>
							        </div>-->
							        <!-- Map -->
							        
							        <div class="map-container full-width full-height" >
								        <div id="mapClie" style="width: 600px; height: 450px;"></div>
										<!--<iframe src="http://guss.me/elbuenpescado/mapa/index.php?id=1" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0">
										</iframe>-->
										<!--<div id="map"></div>-->
							        </div>
						    	</div>
							</div>
						</div>
						
						<div class="col-xl-6 col-lg-6 ">
		            		<div class="card card-transparent">
								<div class="card-header">
									<div class="card-title">
										Acerca del Mapa
		                    		</div>
		                  		</div>
		            		</div>
		            		
			                <div class="card-body">
			                    <h3>Selecciona la ubicación:</h3>
			                    <p>Da un click en el lugar donde se ubica el cliente</p>
			                    <input type="hidden" id="txtlat" name="txtlat" value="<?php echo $row['lat']; ?>" />
			                    <input type="hidden" id="txtlong" name="txtlong" value="<?php echo $row['lng']; ?>" />
			                </div>
		            	</div>
						
					</div>
		          <!-- END CONTAINER FLUID -->
		        </div>
	        </div>
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
    
    <script>
   /*   var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
        }
      };
      

        function initMap() {
         var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(21.145893, -86.849564),
          zoom: 15
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('http://guss.me/elbuenpescado/mapa/php.php?id=1', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}*/
    </script>
      
    
    <!-- BEGIN VENDOR JS -->
    <script src="../assets/plugins/pace/pace.min.js" type="text/javascript"></script>
    <!--  A polyfill for browsers that don't support ligatures: remove liga.js if not needed-->
    <script src="../assets/plugins/liga.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="<?php echo $dir; ?>assets/plugins/jquery/jquery.blockUI.js" type="text/javascript"></script>
    <script src="../assets/plugins/modernizr.custom.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/popper/umd/popper.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery/jquery-easy.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-unveil/jquery.unveil.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-ios-list/jquery.ioslist.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-actual/jquery.actual.min.js"></script>
    <script src="../assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="../assets/plugins/classie/classie.js"></script>
    <script src="../assets/plugins/jquery-datatable/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/TableTools/js/dataTables.tableTools.min.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-datatable/media/js/dataTables.bootstrap.js" type="text/javascript"></script>
    <script src="../assets/plugins/jquery-datatable/extensions/Bootstrap/jquery-datatable-bootstrap.js" type="text/javascript"></script>
    <script type="text/javascript" src="../assets/plugins/datatables-responsive/js/datatables.responsive.js"></script>
    <script type="text/javascript" src="../assets/plugins/datatables-responsive/js/lodash.min.js"></script>
    <script src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js" type="text/javascript"></script>
	<script src="../assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
	
	
	
    <!-- END VENDOR JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <!-- BEGIN CORE TEMPLATE JS -->
    <script src="../pages/js/pages.js"></script>
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="../assets/js/scripts.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
    <!-- END CORE TEMPLATE JS -->
    <!-- BEGIN PAGE LEVEL JS -->
    <script src="../assets/js/form_elements.js" type="text/javascript"></script>
    <script src="../assets/js/datatables.js" type="text/javascript"></script>
    <script src="../assets/js/scripts.js" type="text/javascript"></script>
    
     <script>
	    $('#mapClie').load('<?php echo $url; ?>');
    </script>
  
   
    <!-- END PAGE LEVEL JS -->
    </body>
</html>