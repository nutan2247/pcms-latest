<div id="layoutSidenav">

	<div id="layoutSidenav_nav">

	    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

	        <div class="sb-sidenav-menu">

	            <div class="nav">

	                <div class="sb-sidenav-menu-heading">Core</div>

	                <!-- <a class="nav-link" href="<?php echo site_url('reviewer/reviewer/dashboard'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>

	                    Dashboard

	                </a> -->

	                <!-- <div class="sb-sidenav-menu-heading">Interface</div> -->

	                <!--<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/onlineApplication_listing'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Online Applications
	                </a>-->
					<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/dashboard'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Online Applications
	                </a>
	                <a class="nav-link" href="<?php echo site_url('reviewer/reviewer/forReview_listing'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>For Review Application
	                </a>
	                <a class="nav-link" href="<?php echo site_url('reviewer/reviewer/reviewed_listing'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Reviewed Application
	                </a>
					
					<?php if($this->session->userdata('login')['user_type'] == 'sub-admin'){ ?>

					<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/universitylisting'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>School Listing
	                </a>
					<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/graduateslisting'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Graduates Listing & Exam Codes
	                </a>
					<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/professionallisting'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Foreign Professionals for Registration
	                </a>
					<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/professionallicense'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Foreign Professionals for Exam
	                </a>
					<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/provideraccreditation'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Accredited CE Providers
	                </a>
					<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/requestverificationlisting'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Request for Verification of Registration
	                </a>
					<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/requestgoodstandinglisting'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Request for Certificate of Good Standing
	                </a>
					
					<?php } ?>
					<?php if($this->session->userdata('login')['user_type'] == 'ct'){ ?>
					<!-- <a class="nav-link" href="<?php echo site_url('reviewer/reviewer/dashboard'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Online Applications
	                </a> -->
					<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/onlinecourse'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Accredited Online Courses
	                </a>
					<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/trainingcourse'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Accredited Training Courses
	                </a>
					<?php } ?>
					
	            </div>

	        </div>

	        <div class="sb-sidenav-footer">

	            <div class="small">Logged in as:</div>

	            <?php echo $this->session->userdata('login')['name'];?>

	        </div>

	    </nav>

	</div>



