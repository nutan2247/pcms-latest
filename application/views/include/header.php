<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

$webinfo = $this->common_model->get_websiteinformation();
//print_r($webinfo);
?>
<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title><?php echo isset($title)?$title:'RBoard'; ?></title>
	<meta property="og:title" content="<?php echo isset($title)?$title:'RBoard'; ?>"/>
	<meta property="og:type" content="website"/>
	<meta property="og:url" content="<?php echo isset($url)?$url:''; ?>"/>
	<meta property="og:image" content="<?php echo isset($image)?$image:''; ?>"/>
	<meta property="og:site_name" content="RBoard"/>
	<meta property="fb:app_id" content=""/>
	<meta property="og:description" content="<?php echo isset($title)?$title:'RBoard'; ?>"/>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-multiselect.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.carousel.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">

    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript"> var base_url = "<?php echo base_url(); ?>"; </script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- <link href="https://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" /> -->
  

    <style type="text/css">
        .error {
            color: red;
        }
        
        .display_none {
            display: none;
        }
        
    </style>

</head>

<body>
    <div class="top-header">
        <?php if(isset($rejectnotification)){ ?>
            <h1 class="text-center text-danger"><strong><?=$rejectnotification?></strong></h1>

        <?php } ?>
        <?php if(isset($acceptnotification)){ ?>
            <h1 class="text-center text-danger"><strong><?=$acceptnotification?></strong></h1>

        <?php } ?>
        <div class="row">
            <div class="col-md-3">
				<?php
					$logo = (isset($webinfo->logo) && $webinfo->logo != "")?$webinfo->logo:'logo.png';
				?>
                <a class="top-navbar-brand" href="<?php echo base_url();?>"><img src="<?php echo base_url('assets/images/'.$logo); ?>" alt=""
                        width="200"></a>
            </div>
            <div class="col-md-3 head-social-icons d-flex align-items-center justify-content-end">
				<?php
				 if(isset($webinfo->facebook) && $webinfo->facebook != ""){
					 echo '<a href="'.$webinfo->facebook.'"target="_blank"> <img src="'.base_url('assets/images/facebook.png').'"></a>';
				 }
				 if(isset($webinfo->twitter) && $webinfo->twitter != ""){
					 echo '<a href="'.$webinfo->twitter.'" class="fa fa-twitter" target="_blank"></a>';
				 }
				 if(isset($webinfo->linkedin) && $webinfo->linkedin != ""){
					 echo '<a href="'.$webinfo->linkedin.'" class="fa fa-linkedin" target="_blank"> </a>';
				 } 
				 if(isset($webinfo->instagram) && $webinfo->instagram != ""){
					 echo '<a href="'.$webinfo->instagram.'" class="fa fa-instagram" target="_blank"> </a>';
				 } 
				 if(isset($webinfo->youtube) && $webinfo->youtube != ""){
					 echo '<a href="'.$webinfo->youtube.'"target="_blank"> <img src="'.base_url('assets/images/youtube.png').'"></a>';
				 }
				 if(isset($webinfo->skype) && $webinfo->skype != ""){
					 echo '<a href="skype:'.$webinfo->skype.'?chat" target="_blank"> <img src="'.base_url('assets/images/skype.png').'"></a>';
				 }
				 if(isset($webinfo->whatsapp) && $webinfo->whatsapp != ""){
					 echo '<a href="'.$webinfo->whatsapp.'" target="_blank"><img src="'.base_url('assets/images/whatsapp.png').'"></a>';
				 }
                ?>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-end">
                <div class="login-sec d-flex">
                    
                    <div class="contact-dtl">
                        <p class="mb-0"><?php echo (isset($webinfo->phone_number) && $webinfo->phone_number !="")?'Tel No :'.$webinfo->phone_number:'';?><?php echo (isset($webinfo->address) && $webinfo->address !="")?'<br>Address : '.$webinfo->address:'';?></p>
                    </div>
                    <div class="login-btns ml-2">
                        <div class="Register-box float-right">
                            <?php if($this->session->userdata('logincepacc')){ ?>
                                <a class="btn btn-info" href="<?php echo base_url('ce-provider/ce_provider/dashboard'); ?>">My Account</a>
                                <a class="btn btn-danger" href="<?php echo base_url('ce-provider/ce_provider/logout'); ?>">Logout</a>
                            <?php }else if($this->session->userdata('university_logged_in')){ ?>
                                <a class="btn btn-info" href="<?php echo base_url('university/university/dashboard'); ?>">My Account</a>
								<a class="btn btn-danger" href="<?php echo base_url('university/university/logout'); ?>">Logout</a>
                            <?php }else if($this->session->userdata('professional_session')){ ?>
                                <a class="btn btn-info" href="<?php echo base_url('professional/applicant/certificate_listing'); ?>">My Account</a>
                                <a class="btn btn-danger" href="<?php echo base_url('professional/applicant/logout'); ?>">Logout</a>
							<?php }else{ ?>
                                <a class="Register-btn" href="<?php echo base_url('login'); ?>">Login</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header class="header fixed-top">
        <nav class="navbar navbar-expand-lg">
            <!-- <a class="navbar-brand" href="#"><img src="<?php echo base_url('assets/images/logo.png'); ?>" alt=""
                        width="200"></a> -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample07" aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample07">
                <ul class="navbar-nav">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
                    </li> -->
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                        Home</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a href="<?php echo base_url('license/landing/landing3');?>">Template 3</a></li>
                            <li class=""><a href="<?php echo base_url('license/landing/landing2');?>">Template 2</a></li>
                            <li class=""><a href="<?php echo base_url();?>">Template 1</a></li>
                        </ul>
                    </li>
                   <!--<li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                        Online Servicess</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                             <li class="nave-submenu"><a href="<?php echo base_url('professional/applicant/registration_form');?>">Professional Registration</a>
                            </li>
                            <li><a href="<?php echo base_url('license/landing/professional_license');?>">Professional
                                    License Renewal</a>
                                -- <ul class="sub-menu">
                                       <li class=""><a href="#">Professional License</a></li> --
                                -- <li class=""><a href="<?php echo base_url('professional/applicant');?>">Registration of Foreign Professionals</a></li> --
                                -- <li class=""><a href="#">License Examination</a></li>
                                        <li class=""><a href="#">University/College Accreditation</a></li>
                                        <li class=""><a href="<?php echo base_url('ce-provider/ce_provider'); ?>">CE Provider Accreditation</a></li>
                                        <li class=""><a href="#">Online Course Accreditation</a></li>
                                        <li class=""><a href="#">Training Course Accreditation</a></li>
                                        <li class=""><a href="#">Download Forms</a></li>
                                    </ul> --
                            </li>
                            <li class=""><a href="<?php echo base_url('professional/applicant/index');?>">Foreign Professional Review for professional Registration</a></li>
                            <li class=""><a href="<?php echo base_url('professional/profexam/index');?>">Foreign Professional Review for Online Examination </a></li>
                            <li class=""><a href="<?php echo base_url('examination/examination');?>">Online Licensure Examination</a></li>
                            <li><a href="<?php echo base_url('ce-provider/ce_provider'); ?>">Continuing Education Provider (CEP) Accreditation</a>
                            </li>
                            <li><a href="<?php echo base_url('ce-provider/ce_provider/course_application');?>">Online Course Accreditation</a></li>
                            <li><a href="<?php echo base_url('ce-provider/ce_provider/training_application');?>">Training Course Accreditation</a></li>
                            <li><a href="<?php echo base_url('university/university');?>">School Accreditation</a></li>
                            --<li><a href="<?php echo base_url('university/university/graducateform'); ?>" onclick="alert('Please login as university to add graduates.')" >Submission of graduate for Licensure Examination</a></li>--
							<li><a href="<?php echo base_url('university/university/submissionofgraduates'); ?>" >Submission of graduate for Licensure Examination</a></li>
                            <li><a href="<?php echo base_url('graduates')?>">Booking for Online Licensure Examination (Local Graduates)</a></li>
                            <li><a href="<?php echo base_url('professional/profexam/registerexam')?>">Booking for Online Licensure Examination (Foreign Professionals)</a></li>
                            
                        </ul>
                    </li>-->
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                        Licensure</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                             <li class="nave-submenu"><a href="<?php echo base_url('faq/licensure');?>">Guidelines & Faqs</a></li>
                            <li><a href="<?php echo base_url('professional/applicant/registration_form');?>">Professional Registration</a></li>
                            <li class=""><a href="<?php echo base_url('license/landing/professional_license');?>">License Renewal</a></li>
                            <li class=""><a href="<?php echo base_url('professional/applicant/verificationOfRegistration');?>">Request for Verification of Registration </a></li>
                            <li class=""><a href="<?php echo base_url('professional/applicant/requestForGoodStanding');?>">Request for Certificate of Good Standing </a></li>
                            <li class=""><a href="<?php echo base_url('professional/applicant/index');?>">Foreign Professional Review for Professional Registration</a></li>
                            <li class=""><a href="<?php echo base_url('professionals');?>">List of Registered Professionals</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                        Examination</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="nave-submenu"><a href="<?php echo base_url('faq/examination');?>">Guidelines & Faqs</a></li>
                            <li><a href="<?php echo base_url('pages/graduate_exam_schedule');?>">Exam Schedule (Local Graduates)</a></li>
                            <li><a href="<?php echo base_url('pages/professional_exam_schedule');?>">Exam Schedule (Foreign Professionals)</a></li>
                            <li><a href="<?php echo base_url('school');?>">Accredited Schools </a></li>
                            <li><a href="<?php echo base_url('university/university');?>">School Accreditation</a></li>
                            <li><a href="<?php echo base_url('university/university/submissionofgraduates'); ?>">Submission of graduate for Licensure Examination</a></li>
                            <li><a href="<?php echo base_url('graduates')?>">Booking for Online Licensure Examination (Local Graduates)</a></li>
                            <li><a href="<?php echo base_url('professional/profexam/index');?>">Foreign Professional Review for Licensure Examination </a></li>
                            <li><a href="<?php echo base_url('professional/profexam/registerexam')?>">Booking for Online Licensure Examination (Foreign Professionals)</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                        Continuing Educ.</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="nave-submenu"><a href="<?php echo base_url('faq/education');?>">Guidelines & Faqs</a></li>
                            <li><a href="<?php echo base_url('courses');?>">Accredited Online Courses</a></li>
                            <li class=""><a href="<?php echo base_url('training');?>">Accredited Training Courses</a></li>
                            <li class=""><a href="<?php echo base_url('ceprovider');?>">Accredited CE Providers </a></li>
                            <li class=""><a href="<?php echo base_url('ce-provider/ce_provider');?>">CE Providers Accreditation</a></li>
                            <li class=""><a href="<?php echo base_url('ce-provider/ce_provider/course_application');?>">Online Course Accreditation</a></li>
                            <li class=""><a href="<?php echo base_url('ce-provider/ce_provider/training_application');?>">Training Course Accreditation</a></li>
                        </ul>
                    </li>
                    <!-- <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('license/search'); ?>">Search</a>
                        </li> -->
                    <!--<li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('courses');?>">Accredited Courses</a>
                    </li> -->
                    <!--<li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('training');?>">Accredited Trainings</a>
                    </li>-->
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('news')?>">News</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('faq/laws_rules');?>">Laws & Rules</a>
                    </li>
                    <!--<li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
                        Laws & Rules</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li class="nave-submenu"><a href="<?php echo base_url('faq/laws_rules');?>">Laws & Rules</a></li>
                            
                        </ul>
                    </li>-->
                    <!--   <li class="nav-item">
                        <a class="nav-link" href="#">Guidelines </a>
                    </li>
					<li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('ce-provider/ce_provider'); ?>">CE Provider</a>
                        </li> -->
                    <!-- <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('license/landing/professional_license'); ?>">License Renewal</a>
                        </li> -->
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle nav-link text-white" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">Pages</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <!--<li><a href="#">Verification</a></li>-->
                            <li><a href="<?php echo base_url('aboutus'); ?>">About Us</a></li>
                            <li><a href="<?php echo base_url('contactus'); ?>">Contact Us</a></li>
                            <!--<li><a href="<?php echo base_url('faq'); ?>">FAQ</a></li>-->
                            <!--<li><a href="<?php echo base_url('license/search'); ?>">Search</a></li>-->
                            <!--<li><a href="<?php echo base_url('ceprovider'); ?>">List of Accredited CE Providers</a></li>-->
                            <!--<li><a href="<?php echo base_url('school'); ?>">List Accredited Schools</a></li>-->
                            <!--<li><a href="<?php echo base_url('professionals'); ?>">List of Professionals</a></li>-->
							<li><a href="<?php echo base_url('download'); ?>">Forms</a></li>
                        </ul>
                    </li>
                </ul>
            </div>

            <div class="Register-box">

                <a class="Register-btn bg-light text-dark" href="<?php echo base_url('license/search');?>">Verify Certificates, Accreditation and Application</a>
            </div>
        </nav>
    </header>