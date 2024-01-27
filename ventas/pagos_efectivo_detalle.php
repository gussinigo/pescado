<html>
 <head>
	 
	
    
    <link href="../assets/plugins/nvd3/nv.d3.min.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="../assets/plugins/mapplic/css/mapplic.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/rickshaw/rickshaw.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css" media="screen">
    <link href="../assets/plugins/jquery-metrojs/MetroJs.css" rel="stylesheet" type="text/css" media="screen" />
    
	 
     
     <script>
	     
	  
	     
	     
	     function fnguardar(){
			  alert("Proceso realizado con exito...");
			  
			 window.location.href = "pagos_efectivos.php";
				
			}
	     
	     
	     
	 </script>
     
 </head>
 <body>
	<div class="modal-header clearfix text-left">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i>
		</button>
		<h5>Listado de Pedidos <span class="semi-bold">Pagados en Efectivo</span></h5>
		<p class="p-b-10"> </p>
	</div>
	<div class="modal-body">
		<form role="form" >
		  <div class="form-group-attached">
		    <div class="row">
			    <div class="col-md-12">
				    <table>
					    <tr>
						    <td>Pedido 11</td>
						    <td>Ruben Chavez</td>
						    <td>$ 4,300</td>
					    </tr>
					    <tr>
						    <td>Pedido 12</td>
						    <td>Gustavo Iñigo</td>
						    <td>$ 3,100</td>
					    </tr>
				    </table>
			    </div>
			</div>
			<div class="row">
			</div>
		  </div>
		</form>
		<div class="row" align="right">
		   <div class="col-md-4 m-t-10 sm-m-t-10">
			  <td><button type="button" class="btn btn-danger btn-block m-t-5" onclick="fncloseModal();">Cancelar <i class="pg-icon"> close_ circle</i></button></td>
		   </div>
		   <div class="col-md-4 m-t-10 sm-m-t-10">
			  <td><button type="button" class="btn btn-complete btn-block m-t-5" onclick="fnguardar();">Aceptar <i class="pg-icon"> tick_circle</i></button></td>
		   </div>
		</div>
	</div>
	







    <script src="../pages/js/pages.js"></script>

	
 </body>
</html>
