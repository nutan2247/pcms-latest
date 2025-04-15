<?php 
$currenct_menu = $this->uri->segment(2);
$currenct_sub_menu = $this->uri->segment(3);
?>
<div id="layoutSidenav">

	<div id="layoutSidenav_nav">

	    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

	        <div class="sb-sidenav-menu">

	            <div class="nav">

	                <!-- <div class="sb-sidenav-menu-heading">Core</div>

	                <a class="nav-link" href="<?php echo site_url('admin/dashboard'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>

	                    Dashboard

	                </a>

	                <div class="sb-sidenav-menu-heading">Interface</div> -->

	                <a class="nav-link" href="<?php echo site_url('admin/dashboard'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>

	                    Admin Tracker

	                </a>
					<a class="nav-link" href="<?php echo site_url('admin/contacts'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
	                    Notification
	                </a> 
					<?php 
						
						$expanded = 'false';
						$collapse = '';
						$arrow = 'down';
						if($currenct_menu == 'incomereport' || $currenct_sub_menu=='professional_registration' || $currenct_sub_menu=='professional_license_renewal' || $currenct_sub_menu=='school_accreditaion' || $currenct_sub_menu=='submission_of_graduates' || $currenct_sub_menu=='booking_for_exam_graduates' || $currenct_sub_menu=='foreign_professional_registration' || $currenct_sub_menu=='foreign_professional_examination' || $currenct_sub_menu=='booking_for_exam_foreign_professionals' || $currenct_sub_menu=='cep_accreditation' || $currenct_sub_menu=='online_course_accreditation' || $currenct_sub_menu=='training_course_accreditation'){
							$expanded = 'true';
							$collapse = 'show';
							$arrow = 'up';
						}
					?>
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#incomeLayouts" aria-expanded="<?php echo $expanded;?>" aria-controls="collapseLayouts">
	                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
	                    Income Report
	                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-<?php echo $arrow;?>"></i></div>
	                </a>
						
	                <div class="collapse <?php echo $collapse;?>" id="incomeLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	                    <nav class="sb-sidenav-menu-nested nav">
	                        <a class="nav-link" href="<?php echo site_url('admin/incomereport'); ?>"><div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>All Income</a>
							<a class="nav-link" href="<?php echo site_url('admin/report/professional_registration'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Professional Registration 
					</a>
					<a class="nav-link" href="<?php echo site_url('admin/report/professional_license_renewal'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div> Professional License Renewal
					</a>
					<a class="nav-link" href="<?php echo site_url('admin/report/school_accreditaion'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>School Accreditaion
					</a>
					
					<a class="nav-link" href="<?php echo site_url('admin/report/submission_of_graduates'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Submission of Graduates
					</a>
					<a class="nav-link" href="<?php echo site_url('admin/report/booking_for_exam_graduates'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Booking for Exam - Graduates
					</a>
					<a class="nav-link" href="<?php echo site_url('admin/report/foreign_professional_registration'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Foreign Professional - Registration
					</a>
					<a class="nav-link" href="<?php echo site_url('admin/report/foreign_professional_examination'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Foreign Professional - Examination
					</a>
					<a class="nav-link" href="<?php echo site_url('admin/report/booking_for_exam_foreign_professionals'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Booking for Exam - Foreign Professionals
					</a>
					<a class="nav-link" href="<?php echo site_url('admin/report/cep_accreditation'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>CEP Accreditation
					</a>
					<a class="nav-link" href="<?php echo site_url('admin/report/online_course_accreditation'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Online Course Accreditation
					</a>
					<a class="nav-link" href="<?php echo site_url('admin/report/training_course_accreditation'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Training Course Accreditation
					</a>
					<a class="nav-link" href="<?php echo site_url('admin/report/verification_of_registration'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Request for Verification of Registration
					</a>
					<a class="nav-link" href="<?php echo site_url('admin/report/certificate_of_good_standing'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>Request for Certificate of Good Standing
					</a>	                        
	                </nav>
	                </div>
					<a class="nav-link" href="<?php echo site_url('admin/onlineApplication_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>

	                    Online Applications

	                </a>
					<a class="nav-link" href="<?php echo site_url('admin/onlineApplication_archive'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fa fa-archive" aria-hidden="true"></i></div>

	                    Online Applications Archive

	                </a>
					<a class="nav-link" href="<?php echo site_url('admin/rboard_tracker'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>

	                    RBoard Subscription Tracker 

	                </a>
					<a class="nav-link" href="<?php echo site_url('admin/registered_professional'); ?>">

						<div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>

						Registered Professionals

					</a>
					<a class="nav-link" href="<?php echo site_url('admin/professional_candidates?id='); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
	                    Candidates for Professional Registration
	                </a>					
					<a class="nav-link" href="<?php echo site_url('admin/requestverificationlisting'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
	                    Request for Verification of Registration
	                </a>
					<a class="nav-link" href="<?php echo site_url('admin/requestgoodstandinglisting'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
	                    Request for Certificate of Good Standing
	                </a>
					
					
					

					<?php 
						$expanded2 = 'false';
						$collapse2 = '';
						$arrow2 = 'down';
						if($currenct_menu == 'professionallisting' || $currenct_menu=='foreign_examnees_listing'){
							$expanded2 = 'true';
							$collapse2 = 'show';
							$arrow2 = 'up';
						}
					?>
					<a class="nav-link" href="<?php echo site_url('admin/local_professional_listing'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                   Presently Registered Professional (Local and Foreign)

	                </a>
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#FPLayouts" aria-expanded="<?php echo $expanded2; ?>" aria-controls="collapseLayouts">
	                    <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
	                    Foreign Professionals
	                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-<?php echo $arrow2; ?>"></i></div>
	                </a>
	                <div class="collapse <?php echo $collapse2; ?>" id="FPLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	                    <nav class="sb-sidenav-menu-nested nav">
							<a class="nav-link" href="<?php echo site_url('admin/professionallisting'); ?>">Foreign Professional for Registration</a>
							<a class="nav-link" href="<?php echo site_url('admin/foreign_examnees_listing'); ?>">Foreign Professional for Licensure Examination</a>
	                    </nav>
	                </div>
					<!--<a class="nav-link" href="<?php echo site_url('admin/professionallisting'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-hand-holding-usd"></i></div>
	                    Foreign Professional for Registration
	                </a>
					<a class="nav-link" href="<?php echo site_url('admin/foreign_examnees_listing'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-user-graduate"></i></div>
	                    Foreign Professional for Licensure Examination
	                </a>-->
					 <a class="nav-link" href="<?php echo site_url('admin/graduates_listing'); ?>">
	                	<div class="sb-nav-link-icon"><i class="fas fa-user-graduate"></i></div>
	                		Graduates and Exam Code
	                </a>
					<?php 
						$expanded1 = 'false';
						$collapse1 = '';
						$arrow1 = 'down';
						if($currenct_menu == 'graduate_examiness_result' || $currenct_menu=='foreign_examnees_result'){
							$expanded1 = 'true';
							$collapse1 = 'show';
							$arrow1 = 'up';
						}
					?>

					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Ex_Layouts" aria-expanded="<?php echo $expanded1;?>" aria-controls="collapseLayouts">
						<div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
						Result of Examinations
						<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-<?php echo $arrow1;?>"></i></div>
					</a>

	                <div class="collapse <?php echo $collapse1;?>" id="Ex_Layouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	                    <nav class="sb-sidenav-menu-nested nav">
	                        <a class="nav-link" href="<?php echo site_url('admin/graduate_examiness_result'); ?>">Graduates Exam Result</a>
							<a class="nav-link" href="<?php echo site_url('admin/foreign_examnees_result'); ?>">Foreign Professional Exam Result</a>
	                    </nav>
	                </div>

					<?php 
						$expanded3 = 'false';
						$collapse3 = '';
						$arrow3 = 'down';
						if(
							$currenct_menu == 'examination_schedule_listing' || $currenct_menu=='exam_question_listing' ||
							$currenct_menu == 'publish_exam_question_listing' || $currenct_menu=='examinees_listing' ||
							$currenct_menu == 'lesson' || $currenct_menu=='guidlineheading' || $currenct_menu=='examination_category_listing' || $currenct_menu=='examination_instruction_listing'
						){
							$expanded3 = 'true';
							$collapse3 = 'show';
							$arrow3 = 'up';
						}
					?>
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ExGuidLayouts" aria-expanded="<?php echo $expanded3; ?>" aria-controls="collapseLayouts">
	                    <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
	                    Examination Details
	                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-<?php echo $arrow3; ?>"></i></div>
	                </a>


	                <div class="collapse <?php echo $collapse3; ?>" id="ExGuidLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	                    <nav class="sb-sidenav-menu-nested nav">
							<a class="nav-link" href="<?php echo site_url('admin/examination_schedule_listing'); ?>">Examination Schedule</a>
							<a class="nav-link" href="<?php echo site_url('admin/examination_category_listing'); ?>">Examination Categories</a>
							<a class="nav-link" href="<?php echo site_url('admin/exam_question_listing'); ?>">Examination Question</a>
							<a class="nav-link" href="<?php echo site_url('admin/publish_exam_question_listing'); ?>">Licensure Exam Set Questions</a>
							<a class="nav-link" href="<?php echo site_url('admin/examination_instruction_listing'); ?>">Examination Instruction</a>
							<a class="nav-link" href="<?php echo site_url('admin/examinees_listing'); ?>">Examinees & Exam Pass</a>
	                        <a class="nav-link" href="<?php echo site_url('admin/lesson'); ?>">Examination Guideline</a>
	                        <a class="nav-link" href="<?php echo site_url('admin/guidlineheading'); ?>">Guideline Heading</a>
	                        
	                    </nav>
	                </div>
					<!--<a class="nav-link" href="<?php echo site_url('admin/exam_question_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    Examination Question

	                </a>
	                <a class="nav-link" href="<?php echo site_url('admin/examination_schedule_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-hourglass-start"></i></div>

	                    Examination Schedule

	                </a>
	                <a class="nav-link" href="<?php echo site_url('admin/publish_exam_question_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="far fa-paper-plane"></i></div>

	                    Licensuer Exam Set Questions (Based on Exam Dates)

	                </a>-->

					<?php 
						$expanded4 = 'false';
						$collapse4 = '';
						$arrow4 = 'down';
						if(
							$currenct_menu == 'university_listing' || $currenct_menu=='cep_accreditation' ||
							$currenct_menu == 'course_document_listing' || $currenct_menu=='training_document_listing'
						){
							$expanded4 = 'true';
							$collapse4 = 'show';
							$arrow4 = 'up';
						}
					?>
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#AccrLayouts" aria-expanded="<?php echo $expanded4; ?>" aria-controls="collapseLayouts">
	                    <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
	                    Accreditation
	                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-<?php echo $arrow4; ?>"></i></div>
	                </a>


	                <div class="collapse <?php echo $collapse4; ?>" id="AccrLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	                    <nav class="sb-sidenav-menu-nested nav">
							<a class="nav-link" href="<?php echo site_url('admin/university_listing'); ?>">Accredited School</a>
							<a class="nav-link" href="<?php echo site_url('admin/cep_accreditation'); ?>">Accredited CE Provider</a>
	                        <a class="nav-link" href="<?php echo site_url('admin/course_document_listing'); ?>">Accredited Online Course</a>
							<a class="nav-link" href="<?php echo site_url('admin/training_document_listing'); ?>">Accredited Traning Course</a>
	                    </nav>
	                </div>
	                <!--<a class="nav-link" href="<?php echo site_url('admin/university_listing'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fa fa-university" aria-hidden="true"></i></div>
	                    School Listing
	                </a>-->
					
	                <!--<a class="nav-link" href="<?php echo site_url('admin/cep_accreditation'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-hand-holding-usd"></i></div>
	                    Accredited CE Provider
	                </a>-->

	                <!--<a class="nav-link" href="<?php echo site_url('admin/course_document_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="far fa-file-alt"></i></div>

	                    CEP Course Acc. Listing

	                </a>-->

	                <!--<a class="nav-link" href="<?php echo site_url('admin/training_document_listing'); ?>">
	                    <div class="sb-nav-link-icon"><i class="far fa-file-alt"></i></div>
	                    CEP Training Acc. Listing
	                </a>-->

	               <!--  <a class="nav-link" href="<?php echo site_url('admin/cep_listing'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
	                    CE Providers Listing
	                </a> -->

	                

	                

	               <!--  <a class="nav-link" href="<?php echo site_url('admin/listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    Professionals Listing

	                </a> -->

<!-- 
	                <a class="nav-link" href="<?php echo site_url('admin/cep_course_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    CE Course Listing

	                </a>
 


	                

	                <a class="nav-link" href="<?php echo site_url('admin/examinees_listing'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
	                    Examinees & Exam Pass
	                </a>-->



	                <!--<a class="nav-link" href="<?php echo site_url('admin/lesson'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    Examination Guidline and Info.

	                </a>-->
					<?php 
						$expanded5 = 'false';
						$collapse5 = '';
						$arrow5 = 'down';
						if(
							$currenct_menu == 'certificate_listing' || $currenct_menu=='sent_certificate_listing' 
						){
							$expanded5 = 'true';
							$collapse5 = 'show';
							$arrow5 = 'up';
						}
					?>
					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#certificateLayouts" aria-expanded="<?php echo $expanded5; ?>" aria-controls="collapseLayouts">
	                    <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
	                    Certificates
	                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-<?php echo $arrow5; ?>"></i></div>
	                </a>
	                <div class="collapse <?php echo $collapse5;?>" id="certificateLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	                    <nav class="sb-sidenav-menu-nested nav">
	                        <a class="nav-link" href="<?php echo site_url('admin/certificate_listing').'?cer=1'; ?>">Certificates reported by CEP</a>
	                        <a class="nav-link" href="<?php echo site_url('admin/sent_certificate_listing'); ?>">Certificates reported by Professional</a>
	                    </nav>
	                </div>

	                <!--<a class="nav-link" href="<?php echo site_url('admin/certificate_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    Certificates reported by CEP

	                </a>

	                <a class="nav-link" href="<?php echo site_url('admin/sent_certificate_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    Certificates reported by Professional

	                </a>-->

	                <!--<a class="nav-link" href="charts.html">

	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>

	                    CE Course Report

	                </a>-->

					<?php 
						$expanded6 = 'false';
						$collapse6 = '';
						$arrow6 = 'down';
						if(
							$currenct_menu == 'reviewers_listing' || $currenct_menu=='ct_reviewers_listing' ||
							$currenct_menu == 'examiner_listing' || $currenct_menu=='proctor_listing' ||
							$currenct_menu == 'media_listing' || $currenct_menu=='cashier_listing' 
						){
							$expanded6 = 'true';
							$collapse6 = 'show';
							$arrow6 = 'up';
						}
					?>

	                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="<?php echo $expanded6; ?>" aria-controls="collapseLayouts">
	                    <div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
	                    RB Personnel
	                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-<?php echo $arrow6; ?>"></i></div>
	                </a>
	                <div class="collapse <?php echo $collapse6;?>" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	                    <nav class="sb-sidenav-menu-nested nav">
	                        <a class="nav-link" href="<?php echo site_url('admin/reviewers_listing'); ?>">Reviewer for Documents Listing</a>
	                        <a class="nav-link" href="<?php echo site_url('admin/ct_reviewers_listing'); ?>">Reviewer for CE Course Listing</a>
	                        <a class="nav-link" href="<?php echo site_url('admin/examiner_listing'); ?>">Examiner Listing</a>
	                        <a class="nav-link" href="<?php echo site_url('admin/proctor_listing'); ?>">Proctor Listing</a>
	                        <a class="nav-link" href="<?php echo site_url('admin/media_listing'); ?>">Media Personnel</a>
							<a class="nav-link" href="<?php echo site_url('admin/cashier_listing'); ?>">Cashier</a>
	                    </nav>
	                </div>

					
					<?php 
						$expanded7 = 'false';
						$collapse7 = '';
						$arrow7 = 'down';
						if(
							$currenct_menu == 'setting' || $currenct_menu=='tax' ||
							$currenct_menu == 'websiteinformation' || $currenct_menu=='profession_listing' ||
							$currenct_menu == 'processingfee' || $currenct_menu=='newsnmedia' ||
							$currenct_menu == 'cms' || $currenct_menu=='faq' ||
							$currenct_menu == 'download' || $currenct_menu=='banner' ||
							$currenct_menu == 'terms' || $currenct_menu=='tutorials'
							){
								$expanded7 = 'true';
								$collapse7 = 'show';
								$arrow7 = 'up';
							}
					?>

					<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#SettingLayouts" aria-expanded="<?php echo $expanded7; ?>" aria-controls="collapseLayouts">
						<div class="sb-nav-link-icon"><i class="fas fa-user-tie"></i></div>
						Setting
						<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-<?php echo $arrow7;?>"></i></div>
					</a>
	                <div class="collapse <?php echo $collapse7; ?>" id="SettingLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
	                    <nav class="sb-sidenav-menu-nested nav">
							<a class="nav-link" href="<?php echo site_url('admin/setting')?>">Director</a>
							
							<a class="nav-link" href="<?php echo site_url('admin/setting/tax')?>">Tax</a>
							<a class="nav-link" href="<?php echo site_url('admin/websiteinformation'); ?>">Website Information</a>
	                        <a class="nav-link" href="<?php echo site_url('admin/profession_listing'); ?>">Profession Listing</a>
							<a class="nav-link" href="<?php echo site_url('admin/processingfee'); ?>">Processing fee</a>
							<a class="nav-link" href="<?php echo site_url('admin/newsnmedia'); ?>">News & Media</a>
							<a class="nav-link" href="<?php echo site_url('admin/cms'); ?>">CMS</a>
							<a class="nav-link" href="<?php echo site_url('admin/faq'); ?>">FAQ</a>
							<a class="nav-link" href="<?php echo site_url('admin/download'); ?>">Download</a>
							<a class="nav-link" href="<?php echo site_url('admin/banner'); ?>">Banner</a>
							<a class="nav-link" href="<?php echo site_url('admin/terms'); ?>">Terms & Conditions</a>
							<a class="nav-link" href="<?php echo site_url('admin/tutorials'); ?>">Tutorials</a>
	                    </nav>
	                </div>

	               <!--  <a class="nav-link" href="<?php echo site_url('admin/reviewers_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>

	                    Reviewers Listing

	                </a> -->

	                <!--<a class="nav-link" href="<?php echo site_url('admin/profession_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    Profession Listing

	                </a>
					<a class="nav-link" href="<?php echo site_url('admin/processingfee'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
	                    Processing fee
	                </a>
					<a class="nav-link" href="<?php echo site_url('admin/newsnmedia'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
	                    News & Media
	                </a>-->
					<!--<a class="nav-link" href="<?php echo site_url('admin/cms'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
	                    CMS
	                </a>
					<a class="nav-link" href="<?php echo site_url('admin/faq'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
	                    FAQ
	                </a>-->
					<!--<a class="nav-link" href="<?php echo site_url('admin/download'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
	                    Download
	                </a>
					<a class="nav-link" href="<?php echo site_url('admin/banner'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
	                    Banner
	                </a>
					<a class="nav-link" href="<?php echo site_url('admin/terms'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-tools"></i></div>
	                    Terms & Conditions
	                </a>
					<a class="nav-link" href="<?php echo site_url('admin/tutorials'); ?>">
	                    <div class="sb-nav-link-icon"><i class="fas fa-chalkboard-teacher"></i></div>
	                    Tutorials
	                </a>-->
	               <!--  <a class="nav-link" href="<?php echo site_url('admin/country_listing'); ?>">

	                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

	                    Country Listing

	                </a> -->
					<!--<a class="nav-link" href="<?php echo site_url('admin/setting')?>">

					<div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

						Settings

					</a>
					<a class="nav-link" href="tables.html">

						<div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>

						Admin Report

					</a>-->
	               

	            </div>

	        </div>

	        <div class="sb-sidenav-footer">

	            <div class="small">Logged in as:</div>

	            <?php echo $this->session->userdata('login')['name'];?>

	        </div>

	    </nav>

	</div>



