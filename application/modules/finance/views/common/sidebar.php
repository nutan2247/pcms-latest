<div id="layoutSidenav">

	<div id="layoutSidenav_nav">

	    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

	        <div class="sb-sidenav-menu">

	            <div class="nav">

	                <div class="sb-sidenav-menu-heading">Core</div>

	                <a class="nav-link" href="<?php echo site_url('finance/dashboard'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>

	                    Dashboard

	                </a>

	                <div class="sb-sidenav-menu-heading">Interface</div>					
					<a class="nav-link" href="<?php echo site_url('finance/incomereport'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Income Report 
					</a>
					<a class="nav-link" href="<?php echo site_url('finance/report/professional_registration'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Professional Registration 
					</a>
					<a class="nav-link" href="<?php echo site_url('finance/report/professional_license_renewal'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div> Professional License Renewal
					</a>
					<a class="nav-link" href="<?php echo site_url('finance/report/school_accreditaion'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>School Accreditaion
					</a>
					
					<a class="nav-link" href="<?php echo site_url('finance/report/submission_of_graduates'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Submission of Graduates
					</a>
					<a class="nav-link" href="<?php echo site_url('finance/report/booking_for_exam_graduates'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Booking for Exam - Graduates
					</a>
					<a class="nav-link" href="<?php echo site_url('finance/report/foreign_professional_registration'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Foreign Professional - Registration
					</a>
					<a class="nav-link" href="<?php echo site_url('finance/report/foreign_professional_examination'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Foreign Professional - Examination
					</a>
					<a class="nav-link" href="<?php echo site_url('finance/report/booking_for_exam_foreign_professionals'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Booking for Exam - Foreign Professionals
					</a>
					<!--<a class="nav-link" href="<?php echo site_url('finance/report/cep_accreditation'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>CEP Accreditation
					</a>-->
					<a class="nav-link" href="<?php echo site_url('finance/report/cep_accreditation'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>CEP Accreditation
					</a>
					<a class="nav-link" href="<?php echo site_url('finance/report/online_course_accreditation'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Online Course Accreditation
					</a>
					<a class="nav-link" href="<?php echo site_url('finance/report/training_course_accreditation'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Training Course Accreditation
					</a>	
	            </div>
	        </div>
	        <div class="sb-sidenav-footer">
	            <div class="small">Logged in as:</div>
	            <?php echo $this->session->userdata('login')['name'];?>
	        </div>
	    </nav>
	</div>