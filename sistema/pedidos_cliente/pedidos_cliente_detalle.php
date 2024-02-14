<?php 
	
	include('../conexion.php');
	$link = Conectarse();
	$dir = '../';
	
	if(!isset($_COOKIE['iu'])) {
		closeConn($link);
	    header("Location: ../index.php"); exit();
	} 
	
	$id = $_REQUEST['id'];
	$md = $_REQUEST['md'];
	$pag = $_REQUEST['pag'];
	
	$idprov = $_REQUEST['idprov'];
	$fechaIni = $_REQUEST['fechaini'];
	$fechaFin = $_REQUEST['fechafin'];
	
	if($id == ''){
		$action = "acciones_pedidos_cliente.php?mode=insert";
		$modo = 'insert';
	} else if($md != 'peso') {
		$action = "acciones_pedidos_cliente.php?mode=edit";
		
		$modo = 'edit';
		
		//$sql = "select * from pedidos_cliente where idsolicitud = ".$id;
		$sql = "select p.*, c.cliente, e.estatus from pedidos_cliente p, clientes c, estatus e where  p.idcliente = c.idcliente and p.idestatus = e.idestatus and p.idsolicitud = ".$id;
		$res = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($res);

		
	} else {
		
		$action = "acciones_pedidos_cliente.php?mode=peso";
		
		$modo = 'edit';
		
		//$sql = "select * from pedidos_cliente where idsolicitud = ".$id;
		$sql = "select p.*, c.cliente, e.estatus from pedidos_cliente p, clientes c, estatus e where  p.idcliente = c.idcliente and p.idestatus = e.idestatus and p.idsolicitud = ".$id;
		$res = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($res);
		
	}
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <title><?php echo $modo;?>El Buen Pescado</title>
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link class="main-stylesheet" href="<?php echo $dir; ?>pages/css/pages.css" rel="stylesheet" type="text/css" />
    <!-- Please remove the file below for production: Contains demo classes -->
    <link class="main-stylesheet" href="<?php echo $dir; ?>assets/css/style.css" rel="stylesheet" type="text/css" />
    <style>
	    .trresponsive{ border-bottom: solid !important;
	    }
    </style>
    <script>
	    /*function mostrar(){
		    $("#resultados").css('display','block');
	    }*/
	    
	    function delRow(currElement) {
		     var parentRowIndex = currElement.parentNode.parentNode.rowIndex;
		     document.getElementById("tableWithSearch").deleteRow(parentRowIndex);
		}
		
	    function fnAgregar(){
		    try {
			    if (validaProductos()){
				    var clase = '';
				    var parentRowIndex = '';
				    
				    var modo = $('#hdnmodo').val();
					var idproducto = $('#idproducto').val();
				    var txtcantidad = $('#txtcantidad').val();
				    var idumedida = $('#idumedida').val();
				    
				    var idumedidapeso = '';
				    var txtpeso = '';
				    
				    if(idumedida == '2'){
					    idumedidapeso = '2';
					    txtpeso = txtcantidad;
				    } else if (idumedida == '4') {
				    	idumedidapeso = '4';
					    txtpeso = txtcantidad;
					} else if (idumedida == '5'){
						idumedidapeso = '5';
						txtpeso = txtcantidad / 1000;
				    } else {
					    idumedidapeso = $('#idumedidapeso').val();
						txtpeso = $('#txtpeso').val();
				    }
				    
				    
				    
				    if (idumedidapeso == ''){
					    idumedidapeso = '2';
				    } 
				    
				    var id = idproducto + '-' + idumedida + '-' + idumedidapeso;
					var textoProducto = $('select[id="idproducto"] option:selected').text();
				  	var textoMedida = $('select[id="idumedida"] option:selected').text();
				  	var textoMedidaPeso = $('select[id="idumedidapeso"] option:selected').text();
				  	
				  	if (textoMedidaPeso == 'Seleccione una opcion'){
					  	textoMedidaPeso = '';
				  	}
				  	
				    var filas = document.getElementById("tableWithSearch").rows.length;
				    

				    if (filas == 2){
					    if (modo == 'insert'){
						    clase = document.getElementById("tableWithSearch").rows[1].childNodes[0].childNodes[0].data;
				    
							parentRowIndex = document.getElementById("tableWithSearch").rows[1].rowIndex;
					    }
					    
				    }
				    
				   
				    var x = document.getElementById("tableWithSearch").insertRow(filas);
				    var y = x.insertCell(0);
				    var z = x.insertCell(1);
				    var l = x.insertCell(2);
				    var m = x.insertCell(3);
				    var n = x.insertCell(4);
				    var o = x.insertCell(5); 
				    y.innerHTML = id;
				    z.innerHTML = textoProducto;
				    l.innerHTML = txtcantidad;
				    m.innerHTML = textoMedida;
				    n.innerHTML = '<input type="text" class="form-components" value="'+ txtpeso +'"/>  ' + textoMedidaPeso;
				    o.innerHTML = '<button aria-label="" class="btn btn-danger btn-icon-left m-b-10" type="button" onclick="delRow(this)"><i class="pg-icon">trash_alt</i>Borrar</button>';
				    
				    //$('#idproducto').val('');
				    
				    
				    var toLoad = 'ajax_obtiene_productos.php';
			         $.post(toLoad, function(responseText){
				       
				       $('#idproducto').html(responseText);
				         
			         });
				    
				    $('#txtcantidad').val('');
				    
				    
				    var toLoad = 'ajax_obtiene_umedida.php?tipo=1';
			         $.post(toLoad, function(responseText){
				       
				       $('#idumedida').html(responseText);
				         
			         });
				    
				    $('#txtpeso').val('');
				    
				    var toLoad = 'ajax_obtiene_umedida.php?tipo=2';
			         $.post(toLoad, function(responseText){
				       
				       $('#idumedidapeso').html(responseText);
				         
			         });
			         
			         $('#divPeso').css('display','none');
			         
			         if (clase == 'No data available in table'){
					    document.getElementById("tableWithSearch").deleteRow(parentRowIndex);
				    }
				
				} else {
					alert('Favor de seleccionar un producto, cantidad y unidad de medida...');
				}
			    
		    }
		    catch (err) {
			    alert("Error: " + err.message);
		    }
	    }
	    
	    function validaProductos(){
		    try {
			    var idproducto = $('#idproducto').val();
			    var txtcantidad = $('#txtcantidad').val();
			    var idumedida = $('#idumedida').val();
			    
			    if(idproducto == '') return false;
			    if(txtcantidad == '') return false;
			    if(idumedida == '') return false;
			    
			    return true;
			    
		    }
		    catch (err){
			    alert("Error: " + err.message);
		    }
	    }
	    
	   function obtieneProductos(){
		   try {
			    var cont = 0;
				var valor = '';
				var productos = '';
				
				$('#tableWithSearch tr').each(function() {
					
					//var IDs = $(this).find("td").eq(0).html();
				    var campoID = $(this).find("td").eq(0).html();  
				    var cantidad = $(this).find("td").eq(2).html(); 
				    var peso = $(this).find('input[type="text"]').val();
					
					if(peso == '') peso=0;
				   
				    
				    if (cont >= 1){
					    valor = campoID+"*"+cantidad+"*"+peso;
					    
					   if (cont == 1) {
			    	      productos = valor;
			    	   } else {
			    	      productos = productos + "|" + valor;
			    	   }
					    
				    }
				    
				    cont++;
	
				});
				
				document.getElementById("hdnlistaproductos").value = productos;
				
				
		   }
		   catch (err) {
			   alert("Error: " + err.message);
		   }
			
			

			
		} 
		
		function fnGuardar(){
			try {
				if(validaDatos()){
					
					var hdnpag = $('#hdnpag').val();
					var fechaini = $('#hdnfechaini').val();
				    var fechafin = $('#hdnfechafin').val();
				    var idproveedor = $('#hdnidproveedor').val();
					
					var idcliente = $('#idcliente').val();
					
				    obtieneProductos();
				    
				    var hdnlistaproductos = $('#hdnlistaproductos').val();
				    
				    var hdnid = $('#hdnid').val();
		    
				    $.blockUI({ 
					    baseZ: 20000,
			            message: '<h2><img src="../assets/img/loading.gif" width="80px" height="80px"/>Procesando...</h2>' 
			        });
				     
				     jQuery.post("<?php echo $action; ?>", {
								idcliente:idcliente,
								hdnlistaproductos:hdnlistaproductos,
								hdnid:hdnid
							}, function(data, textStatus){

								$.unblockUI();
								if(data >= 1){
									$.blockUI({ 
									    baseZ: 20000,
							            message: '<h2><img src="../assets/img/check.png"/> Registro guardado correctamente...</h2>' 
							        }); 
							        
							        setTimeout($.unblockUI, 2000); 
							        
							        if(hdnpag == '2'){
								        
								        window.location.href = "../pedidos_proveedor/pedido_detalle.php?id="+idproveedor+"&fechaini=" + fechaini + "&fechafin=" + fechafin;
								        
							        } else {
								       window.open('invoice.php?id=' + data, '_blank');
									   window.location.href = 'pedidos_cliente_detalle.php';   
							        }
							       
								}
								else if(data == 0){
									   
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
					}).fail(function() {
						$.blockUI({ 
							baseZ: 20000,
							message: '<h2><img src="../assets/img/cancel.png"/> Error al guardar el registro...</h2>' 
						}); 
						
						setTimeout($.unblockUI, 3000); 
						
					  });
				}
			}
			catch (err) {
				alert("Error: " + err.message);
			}
		}
		
		function validaDatos(){
			try {
				//var total = document.getElementById("tableWithSearch").rows.length;
				//var clase  = '';
				var idcliente = $('#idcliente').val();
				
				/*if (total == 2){
					clase = document.getElementById("tableWithSearch").rows[1].childNodes[0].childNodes[0].data;
					
					if(clase == 'No data available in table') return false;
				}*/
				
				if(idcliente == '') return false;
				
				
				return true;
		
			}
			catch (err) {
				alert("Error: " + err.message);
			}
		}
		
		function fnmostrar(){
			var idumedida = $('#idumedida').val();
			
		
			
			if(idumedida == '2' || idumedida == '4' || idumedida == '5'){
				$('#divPeso').css('display','none');
			} else {
				$('#divPeso').css('display','block');
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
		<div class="header">
			<?php include('../header.php') ?>
		</div>
		<!-- END HEADER -->
		<!-- BODY -->
		
		 <!-- START CONTAINER FLUID -->
		<div class="page-content-wrapper ">
        <!-- START PAGE CONTENT -->
        	<div class="content ">
			<!-- START CONTAINER FLUID -->
				<div class="container-fluid container-fixed-lg">
					<div class="row">
		            	<div class="col-xl-12 col-lg-12 ">
							<div class="card card-transparent">
								<div class="card-header">
									<div class="card-title">
											Acerca de Pedidos de Clientes
			                    		</div>
									
									
									
		                  		</div>
				                <div class="card-body">
				                    <h3>En esta sección es donde registraremos los pedidos que se ordenan por parte del cliente.</h3>
				                    <p>Aquí empezaremos por seleccionar al cliente del cual sera el pedido<br>
					                luego llenaremos las secciones con la información del producto que ordeno </b>
					                subsecuentemente le daremos al botón agregar que rellenara nuestra tabla</p>
				                </div>
		                	</div>
		              	</div>
		              	<div class="col-xl-12 col-lg-12">
							<h3 class="mw-80" style="float: left">ESTATUS: <?php if($id != '') { echo utf8_encode(strtoupper($row['estatus']));} else { echo 'SOLICITADO';} ?></h3><h3 class="mw-80" style="float: right; ">PEDIDO: <?php if($id != '') { echo utf8_encode($row['idsolicitud']);} else { echo 'NUEVO';}  ?></h3>
						</div>
						<div class="col-xl-12 col-lg-12 ">
				            <div class="row m-t-10">
				            	
					            <div class="card">
									<div class="card-header ">
										<div class="card-title">Paso #1
										</div>
									</div>
									<div class="card-body">
											<input type="hidden" id="hdnid" name="hdnid" value="<?php echo $id; ?>" />
											<input type="hidden" id="hdnmodo" name="hdnmodo" value="<?php echo $modo; ?>"/>
											<input type="hidden" id="hdnpag" name="hdnpag" value="<?php echo $pag; ?>" />
											<input type="hidden" id="hdnfechaini" name="hdnfechaini" value="<?php echo $fechaIni; ?>" />
									    	<input type="hidden" id="hdnfechafin" name="hdnfechafin" value="<?php echo $fechaFin; ?>" />
									    	<input type="hidden" id="hdnidproveedor" name="hdnidproveedor" value="<?php echo $idprov ?>">
											<div class="col-lg-12">
												<div class="row">
													<h3 class="mw-80">Cliente</h3>
													<div class="col-md-12">
														<div class="form-group form-group-default required">
													    	<div class="form-group ">
														        <label>Cliente</label>
										                        <select class="full-width" data-init-plugin="select2" id="idcliente" name="idcliente">
											                      <option value="">Seleccione una opcion</option>
										                          <optgroup label="cliente">
										                            <?php
												                        	$qr="select * from clientes";
												                        	$res_qr = mysqli_query($link, $qr);
												                        	while ($row_qr = mysqli_fetch_array($res_qr)){
													                        	if($row_qr['idcliente'] == $row['idcliente']){
														                        	$selected = "selected='selected'";
													                        	} else {
														                        	$selected = '';
													                        	}
											                        	?>
																			<option value="<?php echo $row_qr['idcliente']; ?>" <?php echo $selected; ?>><?php echo utf8_encode($row_qr['cliente']); ?></option>
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
					            </div>
					           
				                <div class="card">
									<div class="card-header ">
										<div class="card-title">Paso #2
										</div>
									</div>
									<div class="card-body">
										
											<input type="hidden" id="hdnlistaproductos" name="hdnlistaproductos" />
											<div class="col-lg-12">
												<div class="row">
													<div class="col-lg-12">
													 	<h3 class="mw-80">Selecciona Producto</h3>
													    <div class="form-group-attached">
														    <div class="form-group form-group-default">
														    	<label>Producto</label>
									                        	<select class="full-width" data-init-plugin="select2" id="idproducto" name="idproducto">
										                        	<option value="">Seleccione una opcion</option>
										                        	<optgroup label="Producto">
										                        	<option value="nombre"></option>
										                        		<?php
												                        	$qr2="select * from productos";
												                        	$res_qr2 = mysqli_query($link, $qr2);
												                        	while ($row_qr2 = mysqli_fetch_array($res_qr2)){
											                        	?>
																			<option value="<?php echo $row_qr2['idproducto']; ?>" ><?php echo $row_qr2['codigo'].' - '.utf8_encode($row_qr2['producto']); ?></option>
																		<?php 
																			}
																		?>
																	</optgroup>
									                        	</select>
															</div>
															<div class="row clearfix">
																<div class="col-md-6">
															    	<div class="form-group form-group-default">
															        	<label>Cantidad</label>
																		<input type="text" class="form-control" id="txtcantidad" name="txtcantidad" placeholder="Cantidad" required>
															    	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group form-group-default">
																    	<label>Unidad de Medida</label>
											                        	<select class="full-width" data-init-plugin="select2" id="idumedida" name="idumedida" onchange="fnmostrar();">
												                        	<option value="">Seleccione una opcion</option>
												                        	<optgroup label="U. Medida">
												                        		<?php
														                        	$qr3="select * from unidad_medida";
														                        	$res_qr3 = mysqli_query($link, $qr3);
														                        	while ($row_qr3 = mysqli_fetch_array($res_qr3)){
													                        	?>
																					<option value="<?php echo $row_qr3['idmedida']; ?>" ><?php echo utf8_encode($row_qr3['umedida']); ?></option>
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
												<div class="row" >
													<div class="col-lg-12" >
													 	
													    <div class="form-group-attached">
														 <div id="divPeso" style="display: none;">
														   <h3 class="mw-80">Peso Real</h3> 
															<div class="row clearfix">
																<div class="col-md-6">
															    	<div class="form-group form-group-default">
															        	<label>PESO</label>
																		<input type="text" class="form-control" id="txtpeso" name="txtpeso" placeholder="Cantidad" required>
															    	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group form-group-default">
																    	<label>Unidad de Medida</label>
											                        	<select class="full-width" data-init-plugin="select2" id="idumedidapeso" name="idumedidapeso">
												                        	<option value="">Seleccione una opcion</option>
												                        	<optgroup label="U. Medida">
												                        		<?php
														                        	$qr4="select * from unidad_medida where idmedida != 1";
														                        	$res_qr4 = mysqli_query($link, $qr4);
														                        	while ($row_qr4 = mysqli_fetch_array($res_qr4)){
													                        	?>
																					<option value="<?php echo $row_qr4['idmedida']; ?>" ><?php echo utf8_encode($row_qr4['umedida']); ?></option>
																				<?php 
																					}
																				?>
												                        	</optgroup>
											                        	</select>
																	</div>
																</div>
																
															</div>
														 </div>
															
															<div class="form-group form-group-default">
																<button style="width: 100% !important" aria-label="" type="button" class="btn btn-success" onclick="fnAgregar();">Agregar</button>
															</div>
													    </div>
												    </div>
												</div>
												<div class="row" id="resultados">   
												    <div class="col-lg-12" >
										                <!-- START card -->
										                <div class="card card-transparent">
										                	<div class="card-header ">
										                    	<div class="card-title">Tabla de solicitud	
										                    	</div>
										                    <div class="tools">
										                	</div>
										                </div>
										                <div class="card-body">
										                    <div class="table-responsive">
																<table class="table table-hover demo-table-search table-responsive-block" id="tableWithSearch">
															      	<thead>
																        <tr>
																        	<th>Id</th>
																			<th>Producto</th>
																			<th>Solicitado</th>
																			<th>U. Medida</th>
																			<th>PESO REAL</th>
																			<th>Eliminar</th>
																        </tr>
															    	</thead>
																	<tbody>
																		<?php 
																			if($id != ''){
																				$qr_det = "select p.*, d.*, c.codigo, c.producto, m.umedida, (select o.umedida from unidad_medida o where o.idmedida = d.peso_idmedida ) as umedida_peso, d.idestatus as estatus_producto from pedidos_cliente p, pedidos_cliente_detalle d, productos c, unidad_medida m where p.idsolicitud = d.idsolicitud and d.idproducto = c.idproducto and d.idmedida = m.idmedida and p.idsolicitud = ".$row['idsolicitud'];
																				$res_det = mysqli_query($link, $qr_det);
																				
																				
																				while ($row_det = mysqli_fetch_array($res_det)){
																					
																		?>
																				<tr class="trresponsive">
																					<td class="v-align-middle"><?php echo str_replace(' ','',$row_det['idproducto']).'-'.str_replace(' ','',$row_det['idmedida']).'-'.str_replace(' ','',$row_det['peso_idmedida']);?></td>
																					<td class="v-align-middle">
																						<?php echo utf8_encode($row_det['codigo']).' - '.utf8_encode($row_det['producto']); ?>
																					</td>
																					<td class="v-align-middle">
																						<?php echo $row_det['cantidad']; ?>
																					</td>
																					<td class="v-align-middle">
																						<?php echo utf8_encode($row_det['umedida']); ?>
																					</td>
																					<td class="v-align-middle">
																						<input type="text" class="form-components" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"  value="<?php echo $row_det['peso']; ?>"/>  <?php echo $row_det['umedida_peso']; ?>
																					</td>
																					<td class="v-align-middle">
																						<?php 
																							if ($row_det['estatus_producto'] == '1'){
																						?>
																						<button aria-label="" class="btn btn-danger btn-icon-left m-b-10" type="button" onclick="delRow(this)"><i class="pg-icon">trash_alt</i>Borrar</button>
																						<?php 
																							}
																						?>
																					</td>
																				</tr>
																		<?php
																				}
																			}
																		?>
																        
															    	</tbody>
															    </table>
															</div>
														</div>
										                <!-- END card -->
										            </div>
										        </div>
											</div>
										    <br>
										    <div class="row">
										      <div class="col-12">
										        <button aria-label="" class="btn btn-complete pull-right" type="button" onclick="fnGuardar();">Guardar</button>
										      </div>
										    </div>
										
									</div>
								</div>
								<!-- END card -->
							</div>
					        <!-- END CONTAINER FLUID -->
					    </div>
					</div>
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