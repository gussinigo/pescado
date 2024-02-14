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
		$action = "acciones_proveedores.php?mode=insert";
	} else {
		$action = "acciones_proveedores.php?mode=edit";
		
		$sql = "select * from proveedores where idproveedor = ".$id;
		$res = mysqli_query($link, $sql);
		$row = mysqli_fetch_array($res);
		
	}
	
	
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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link class="main-stylesheet" href="<?php echo $dir; ?>pages/css/pages.css" rel="stylesheet" type="text/css" />
    <!-- Please remove the file below for production: Contains demo classes -->
    <link class="main-stylesheet" href="<?php echo $dir; ?>assets/css/style.css" rel="stylesheet" type="text/css" />
    
    <script>
	    
	    function fnGuardar(){
		    if(fnValida()){
		        var txtproveedor = $('#txtproveedor').val();
				var txttel = $('#txttel').val();
				var hdnid = $('#hdnid').val();
	    
			    $.blockUI({ 
				    baseZ: 20000,
		            message: '<h2><img src="../assets/img/loading.gif" width="80px" height="80px"/>Procesando...</h2>' 
		        });
			     
			     jQuery.post("<?php echo $action; ?>", {
							txtproveedor:txtproveedor,
							txttel:txttel,
							hdnid:hdnid
						}, function(data, textStatus){
							$.unblockUI();
							if(data == 1){
								$.blockUI({ 
								    baseZ: 20000,
						            message: '<h2><img src="../assets/img/check.png"/> Registro guardado correctamente...</h2>' 
						        }); 
						        
						        setTimeout($.unblockUI, 2000); 
						        
						        
						         window.location.href = 'listado_proveedores.php';
						        
						       
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
		    }
	    }
	    
	    function fnValida(){
		    var txtproveedor = $('#txtproveedor').val();
		    var txttel = $('#txttel').val();
		    
		    if(txtproveedor == '') return false;
		    if(txttel == '') return false;
		    
		    return true;
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
		        <div class=" container-fluid   container-fixed-lg">
			        <div class="row">
		            	<div class="col-xl-6 col-lg-6 ">
							<div class="card card-transparent">
								<div class="card-header">
									<div class="card-title">
										Acerca de Proveedores
		                    		</div>
		                  		</div>
				                <div class="card-body">
				                    <h3> Este es nuestro registro basico de proveedores. </h3>
				                    <p>Aqui rellenaremos la informacion basica de un proveedor
				                      <br> Esto nos permitira mas adelante filtrar los productos acorde a los distintos proveedores. <br>
				                </div>
		                	</div>
		              	</div>
						<div class="col-xl-6 col-lg-6 ">
				            <div class="row m-t-10">
				                <!-- START card -->
				                <div class="card">
									<div class="card-header ">
										<div class="card-title">Proveedores
										</div>
									</div>
									<div class="card-body">
									    <input type="hidden" id="hdnid" name="hdnid" value="<?php echo $id; ?>" />
									 	<h3 class="mw-80">Proveedor</h3>
									    <div class="form-group-attached">	
									      <div class="form-group form-group-default required">
									        <label>Nombre del Proveedor</label>
									        <input type="text" class="form-control" id="txtproveedor" name="txtproveedor" placeholder="Nombre del Proveedor" value="<?php echo utf8_encode($row['proveedor']); ?>" required>
									      </div>
									    </div>
									    
										<div class="form-group-attached">
											<div class="form-group form-group-default required">
												<label>Numero Telefonico</label>
												<input type="text" class="form-control" id="txttel" name="txttel" placeholder="Numero Telefonico" value="<?php echo utf8_encode($row['telefono']); ?>" required>
											</div>
									    </div>
									    <br>
									    <div class="row">
									      <div class="col-12">
									        <button aria-label="" class="btn btn-complete pull-right" id="btnguardar" name="btnguardar" onclick="fnGuardar();" >Guardar</button>
									      </div>
									    </div>
								
									</div>
									</div>
									<!-- END card -->
									</div>
								</div>
							</div>
		        		</div>
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
    <script src="<?php echo $dir; ?>assets/js/scripts.js" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS -->
    </body>
</html>