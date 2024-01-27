
  <!-- BEGIN SIDEBAR MENU HEADER-->
  <div class="sidebar-header">
	<a href="<?php echo $dir; ?>home.php">
	    <img src="<?php echo $dir; ?>assets/img/logo_white.png" alt="logo" data-src="<?php echo $dir; ?>assets/img/logo_white.png" data-src-retina="<?php echo $dir; ?>assets/img/logo_white_2x.png" width="127" height="22">
	</a>
      <button aria-label="Pin Menu" type="button" class="btn btn-icon-link invert d-lg-inline-block d-xlg-inline-block d-md-inline-block d-sm-none d-none" data-toggle-pin="sidebar">
        <i class="pg-icon"></i>
      </button>
    </div>
  </div>
<!-- END SIDEBAR MENU HEADER-->
<!-- START SIDEBAR MENU -->
  <div class="sidebar-menu">
    <!-- BEGIN SIDEBAR MENU ITEMS-->
    <ul class="menu-items">
	    <li class="m-t-20 ">
            <a href="<?php echo $dir; ?>home.php" class="detailed">
              <span class="title">Home</span>
            </a>
            <span class="icon-thumbnail"><i class="pg-icon">home</i></span>
        </li>
    	<li>
            <a href="javascript:;">
              <span class="title">Productos</span>
              <span class=" arrow"></span>
            </a>
            <span class="icon-thumbnail"><i class="pg-icon">note</i></span>
            <ul class="sub-menu">
              <li class="">
                <a href="<?php echo $dir; ?>productos/productos_detalle.php">Captura de Productos</a>
                <span class="icon-thumbnail"><i class="pg-icon">CP</i></span>
              </li>
              <li class="">
                <a href="<?php echo $dir; ?>productos/listado_productos.php">Listado de Productos</a>
                <span class="icon-thumbnail"><i class="pg-icon">LP</i></span>
              </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
              <span class="title">Clientes</span>
              <span class="arrow"></span>
            </a>
            <span class="icon-thumbnail"><i class="pg-icon">social</i></span>
            <ul class="sub-menu">
              <li class="">
                <a href="<?php echo $dir; ?>clientes/clientes_detalle.php">Captura Clientes</a>
                <span class="icon-thumbnail"><i class="pg-icon">CC</i></span>
              </li>
              <li class="">
                <a href="<?php echo $dir; ?>clientes/listado_clientes.php">Listado de Clientes</a>
                <span class="icon-thumbnail"><i class="pg-icon">LC</i></span>
              </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
              <span class="title">Repartidores</span>
              <span class="arrow"></span>
            </a>
            <span class="icon-thumbnail"><i class="pg-icon">clipboard</i></span>
            <ul class="sub-menu">
              <li class="">
                <a href="<?php echo $dir; ?>repartidores/repartidores_detalle.php">Captura Repartidor</a>
                <span class="icon-thumbnail"><i class="pg-icon">CR</i></span>
              </li>
              <li class="">
                <a href="<?php echo $dir; ?>repartidores/listado_repartidores.php">Listado de Repartidores</a>
                <span class="icon-thumbnail"><i class="pg-icon">LR</i></span>
              </li>
              <li class="">
                <a href="<?php echo $dir; ?>repartidores/zonas_detalle.php">Captura Zona</a>
                <span class="icon-thumbnail"><i class="pg-icon">CZ</i></span>
              </li>
              <li class="">
                <a href="<?php echo $dir; ?>repartidores/listado_zonas.php">Listado de Zona</a>
                <span class="icon-thumbnail"><i class="pg-icon">LZ</i></span>
              </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
              <span class="title">Pedidos</span>
              <span class="arrow"></span>
            </a>
            <span class="icon-thumbnail"><i class="pg-icon">calendar</i></span>
            <ul class="sub-menu">
              <li class="">
                <a href="<?php echo $dir; ?>pedidos_cliente/pedidos_cliente_detalle.php">Nuevo Pedido de Cliente</a>
                <span class="icon-thumbnail"><i class="pg-icon">PCD</i></span>
              </li>
              <li class="">
                <a href="<?php echo $dir; ?>pedidos_cliente/listado_pedido_cliente.php">Listado de Pedidos de Cliente</a>
                <span class="icon-thumbnail"><i class="pg-icon">LPC</i></span>
              </li>
              <li class="">
                <a href="<?php echo $dir; ?>pedidos_cliente/listado_pedido_pendiente.php">Pedidos Pendientes Peso</a>
                <span class="icon-thumbnail"><i class="pg-icon">PPP</i></span>
              </li>
            </ul>
        </li>
        <li>
            <a href="javascript:;">
              <span class="title">Proveedores</span>
              <span class="arrow"></span>
            </a>
            <span class="icon-thumbnail"><i class="pg-icon">menu_level</i></span>
            <ul class="sub-menu">
	          <li class="">
                <a href="<?php echo $dir; ?>pedidos_proveedor/listado_pedidos.php">1- Compras</a>
                <span class="icon-thumbnail"><i class="pg-icon">C</i></span>
              </li>
              <li class="">
                <a href="<?php echo $dir; ?>pedidos_proveedor/listado_pedidos_solicitados.php">2- Compras Solicitadas</a>
                <span class="icon-thumbnail"><i class="pg-icon">CS</i></span>
              </li>
              <li class="">
                <a href="<?php echo $dir; ?>proveedores/proveedores_detalle.php">Captura Proveedor</a>
                <span class="icon-thumbnail"><i class="pg-icon">CP</i></span>
              </li>
              <li class="">
                <a href="<?php echo $dir; ?>proveedores/listado_proveedores.php">Listado de Proveedores</a>
                <span class="icon-thumbnail"><i class="pg-icon">LP</i></span>
              </li>
              
            </ul>
        </li>
        <!--<li>
            <a href="javascript:;">
              <span class="title">Rutas</span>
              <span class="arrow"></span>
            </a>
            <span class="icon-thumbnail"><i class="pg-icon">map</i></span>
            <ul class="sub-menu">
              <li class="">
                <a href="<?php echo $dir; ?>rutas/rutas_detalle.php">Nueva Ruta</a>
                <span class="icon-thumbnail"><i class="pg-icon">NR</i></span>
              </li>
            </ul>
        </li>-->
        <li>
            <a href="javascript:;">
              <span class="title">Ventas</span>
              <span class="arrow"></span>
            </a>
            <span class="icon-thumbnail"><i class="pg-icon">card</i></span>
            <ul class="sub-menu">
	          <li class="">
                <a href="<?php echo $dir; ?>formas_pago/pagos_detalle.php">Agregar Tipos de Pago</a>
                <span class="icon-thumbnail"><i class="pg-icon">ATP</i></span>
              </li>
              <li class="">
                <a href="<?php echo $dir; ?>formas_pago/listado_pagos.php">Listado de Tipos de Pago</a>
                <span class="icon-thumbnail"><i class="pg-icon">TP</i></span>
              </li>
              <li class="">
                <a href="<?php echo $dir; ?>ventas/pagos_efectivos.php">Pagos Efectivos</a>
                <span class="icon-thumbnail"><i class="pg-icon">PE</i></span>
              </li>
              <li class="">
                <a href="<?php echo $dir; ?>ventas/nota_venta_listado.php">Nota Venta</a>
                <span class="icon-thumbnail"><i class="pg-icon">VT</i></span>
              </li>
              <li class="">
                <a href="<?php echo $dir; ?>ventas/listado_pagos.php">Listado de Notas de Venta</a>
                <span class="icon-thumbnail"><i class="pg-icon">LP</i></span>
              </li>
              <!--<li class="">
                <a href="<?php echo $dir; ?>ventas/reporte_pagos.php">Reporte Pagos</a>
                <span class="icon-thumbnail"><i class="pg-icon">RP</i></span>
              </li>-->
            </ul>
        </li>
        <li>
            <a href="javascript:;">
              <span class="title">Rutas</span>
              <span class="arrow"></span>
            </a>
            <span class="icon-thumbnail"><i class="pg-icon">card</i></span>
            <ul class="sub-menu">
              <li class="">
                <a href="<?php echo $dir; ?>rutas/listado_rutas.php">Asignacion</a>
                <span class="icon-thumbnail"><i class="pg-icon">A</i></span>
              </li>
              <li class="">
                <a href="<?php echo $dir; ?>rutas/listado.php">Listado</a>
                <span class="icon-thumbnail"><i class="pg-icon">L</i></span>
              </li>
              
             
            </ul>
        </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <!-- END SIDEBAR MENU -->