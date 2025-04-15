<div id="layoutSidenav">

	<div id="layoutSidenav_nav">

	    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

	        <div class="sb-sidenav-menu">

	            <div class="nav">

	                <div class="sb-sidenav-menu-heading">Core</div>

	                <a class="nav-link" href="<?php echo site_url('admin/dashboard'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>

	                    Dashboard

	                </a>

	                <div class="sb-sidenav-menu-heading">Interface</div>

	               <!--  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">

	                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>

	                    Users

	                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>

	                </a>

	                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">

	                    <nav class="sb-sidenav-menu-nested nav">

	                        <a class="nav-link" href="<?php echo site_url('admin/add'); ?>">ADD User</a>

	                        <a class="nav-link" href="<?php echo site_url('admin/listing'); ?>">User Listing</a>

	                    </nav>

	                </div> -->

	                <!-- <div class="sb-sidenav-menu-heading">Addons</div> -->

	                <a class="nav-link" href="<?php echo site_url('admin/onlineApplication_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>

	                    Online Applications

	                </a>

	                <a class="nav-link" href="<?php echo site_url('admin/listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    Professionals Listing

	                </a>

	                <a class="nav-link" href="<?php echo site_url('admin/cep_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>

	                    CE Providers Listing

	                </a>

	                <a class="nav-link" href="tables.html">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    CE Course Listing

	                </a>

	                <a class="nav-link" href="<?php echo site_url('admin/certificate_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    Certificates

	                </a>
	                <a class="nav-link" href="<?php echo site_url('admin/sent_certificate_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    User's sent Certificates

	                </a>

	                <a class="nav-link" href="charts.html">

	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>

	                    CE Course Report

	                </a>

	                <a class="nav-link" href="tables.html">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    Admin Report

	                </a>

	                <a class="nav-link" href="<?php echo site_url('admin/reviewers_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>

	                    Reviewers Listing

	                </a>



	                <a class="nav-link" href="<?php echo site_url('admin/setting')?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    Settings

	                </a>

	               

	                <a class="nav-link" href="<?php echo site_url('admin/profession_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    Profession Listing

	                </a>
	                    
	                <a class="nav-link" href="<?php echo site_url('admin/contacts'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    Contact Us

	                </a>



	               <!--  <a class="nav-link" href="<?php echo site_url('admin/country_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    Country Listing

	                </a> -->

	               

	            </div>

	        </div>

	        <div class="sb-sidenav-footer">

	            <div class="small">Logged in as:</div>

	            <?php echo $this->session->userdata('name');?>

	        </div>

	    </nav>

	</div>



