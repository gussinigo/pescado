
<!-- START MOBILE SIDEBAR TOGGLE -->
<a href="#" class="btn-link toggle-sidebar d-lg-none pg-icon btn-icon-link" data-toggle="sidebar">menu</a>
<!-- END MOBILE SIDEBAR TOGGLE -->
<div class="">
	<div class="brand inline">
		<a href="<?php echo $dir; ?>home.php">
			<img src="<?php echo $dir; ?>assets/img/logo.png" alt="logo" data-src="<?php echo $dir; ?>assets/img/logo.png" data-src-retina="<?php echo $dir; ?>assets/img/logo_2x.png" width="127" height="22">
		</a>
	</div>
	<!-- START NOTIFICATION LIST -->
	<ul class="d-lg-inline-block d-none notification-list no-margin d-lg-inline-block b-grey b-l b-r no-style p-l-20 p-r-20">
	    <li class="p-r-5 inline">
	      	<div class="dropdown">
		        <a href="javascript:;" id="notification-center" class="header-icon  btn-icon-link" data-toggle="dropdown">
		          <i class="pg-icon">world</i>
		          <span class="bubble"></span>
		        </a>
		        <!-- START Notification Dropdown -->
		        <div class="dropdown-menu notification-toggle" role="menu" aria-labelledby="notification-center">
		          <!-- START Notification -->
			        <div class="notification-panel">
			            <!-- START Notification Body-->
			            <div class="notification-body scrollable">
			              	<!-- START Notification Item-->
			              	<div class="notification-item unread clearfix">
			                <!-- START Notification Item-->
			                <div class="heading open">
			                	<div class="more-details"></div>
			                </div>
			                <!-- END Notification Item-->
			                <!-- START Notification Item Right Side-->
			                <div class="option" data-toggle="tooltip" data-placement="left" title="mark as read">
			                  <a href="#" class="mark"></a>
			                </div>
			                <!-- END Notification Item Right Side-->
			            </div>
			            <!-- START Notification Body-->
			            <!-- START Notification Item-->
			            <div class="notification-item  clearfix">
			                <div class="heading">
			                  <a href="#" class="text-danger pull-left">
			                </div>
			                <!-- START Notification Item Right Side-->
			                <div class="option">
			                  <a href="#" class="mark"></a>
			                </div>
			                <!-- END Notification Item Right Side-->
			            </div>
			              <!-- END Notification Item-->
			              <!-- START Notification Item-->
			              <div class="notification-item  clearfix"></div>
			            <!-- START Notification Footer-->
			        </div>
		        </div>
	          <!-- END Notification -->
			</div>
	        <!-- END Notification Dropdown -->
	    </li>
	    <li class="p-r-5 inline">
	      <a href="#" class="header-icon  btn-icon-link">
	        <i class="pg-icon">link_alt</i>
	      </a>
	    </li>
	    <li class="p-r-5 inline">
	      <a href="#" class="header-icon  btn-icon-link">
	        <i class="pg-icon">grid_alt</i>
	      </a>
	    </li>
	</ul>
  <!-- END NOTIFICATIONS LIST -->
</div>
<div class="d-flex align-items-center">
  <!-- START User Info-->
  <div class="dropdown pull-right d-lg-block d-none">
    <button class="profile-dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" aria-label="profile dropdown">
    	<span class="thumbnail-wrapper d32 circular inline">
			<img src="<?php echo $dir; ?>assets/img/logo-48x48_c@2x.png" alt="" data-src="<?php echo $dir; ?>assets/img/logo-48x48_c@2x.png" data-src-retina="<?php echo $dir; ?>assets/img/logo-48x48_c@2x.png" width="32" height="32">
		</span>
    </button>
    <div class="dropdown-menu dropdown-menu-right profile-dropdown" role="menu">
      <a href="#" class="dropdown-item"><span>Usuario: <br /><b>Usuario</b></span></a>
      <div class="dropdown-divider"></div>
      <a href="<?php echo $dir;?>index.php" class="dropdown-item">Salir</a>
      <div class="dropdown-divider"></div>
    </div>
  </div>
  <!-- END User Info-->
</div>
<!-- END HEADER -->