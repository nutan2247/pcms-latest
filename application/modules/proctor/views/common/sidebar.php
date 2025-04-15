<?php $user_type = $this->session->userdata('login')['user_type']; 
	  $uri = $this->uri->segment(3);
?>



<div id="layoutSidenav">

	<div id="layoutSidenav_nav">

	    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

	        <div class="sb-sidenav-menu">

	            <div class="nav">

	                <!-- <div class="sb-sidenav-menu-heading">Core</div>
	                <a class="nav-link" href="<?php echo site_url('reviewer/reviewer/dashboard'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
	                    Dashboard
	                </a> -->

	                <div class="sb-sidenav-menu-heading">Interface</div>
	             	<?php if($user_type =='pp'){ ?>
	                <a class="nav-link <?php if($uri=='dashboard'){ echo 'active'; } ?>" href="<?php echo site_url('proctor/dashboard'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
	                    Foriegn Professional Examiness Listing
	                </a>
					<?php } ?>

	             	<?php if($user_type =='p'){ ?>
	                <a class="nav-link <?php if($uri=='dashboard'){ echo 'active'; } ?>" href="<?php echo site_url('proctor/dashboard'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
						Graduates Examiness Listing
	                </a>
					<?php } ?>
					<a class="nav-link" href="<?php echo site_url('proctor/notification'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-bell"></i></div> Notification
	                </a>
					<!-- <a class="nav-link" href="<?php echo site_url('proctor/foreign_examnees_listing'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
	                    Foreign Professional & Exam Code
	                </a>
	                <a class="nav-link" href="<?php echo site_url('proctor/graduate_examnees_listing'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>Graduate & Exam Code
	                </a> 
						
					<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/professionallisting'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Professional Listing
	                </a>
					<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/professionallicense'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Professional License
	                </a>
					<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/provideraccreditation'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>CE Provider Accreditation
	                </a>
					<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/onlinecourse'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Online Course Accreditation
	                </a>
					<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/trainingcourse'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Traning Acceditation
	                </a>
					<a class="nav-link" href="<?php echo site_url('reviewer/reviewer/graduateslisting'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Graduates Listing
	                </a> -->
	            </div>

	        </div>

	        <div class="sb-sidenav-footer">

	            <div class="small">Logged in as:</div>

	            <?php echo $this->session->userdata('login')['name'];?>

	        </div>

	    </nav>

	</div>



