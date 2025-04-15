<div id="layoutSidenav">

	<div id="layoutSidenav_nav">

	    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

	        <div class="sb-sidenav-menu">

	            <div class="nav">

	                <div class="sb-sidenav-menu-heading">Core</div>

	                <a class="nav-link" href="<?php echo site_url('media/dashboard'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>

	                    Dashboard

	                </a>
	                <div class="sb-sidenav-menu-heading">Interface</div>					
					<a class="nav-link" href="<?php echo site_url('media/newscategories'); ?>">
						<div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div> Categories List
					</a>
					<a class="nav-link" href="<?php echo site_url('media/newsnmedia'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>News
	                </a>
					<a class="nav-link" href="<?php echo site_url('media/newsnmediaedit'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Add New News
	                </a>
					<a class="nav-link" href="<?php echo site_url('media/faq'); ?>">FAQ</a>
	            </div>

	        </div>

	        <div class="sb-sidenav-footer">

	            <div class="small">Logged in as:</div>

	            <?php echo $this->session->userdata('login')['name'];?>

	        </div>

	    </nav>

	</div>



