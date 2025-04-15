<?php //print_r($newslistingrightside);exit; ?>
    <div class="temptwo-slider">
        <?php if($topbanners){
        foreach($topbanners as $topbanr){
        if(file_exists('./assets/images/banner/'.$topbanr->banner)){ ?>
        <div class="item">
            <div class="temp_banner"
                style="background-image: url('<?php echo base_url('assets/images/banner/'.$topbanr->banner); ?>'); ">
                <div class="container">
                <?php echo '<h1><b><span style="font-size:85px;">'.$topbanr->title.' :</span> 
                        <br>'.$topbanr->sub_title.'</b></h1>'; ?>
                </div>
            </div>
        </div>
        <?php } }  }else{ ?>
    <a href="">
        <div class="item">
            <div id="banner-grid" class="banner-grid py-0">
                <img src="https://ceonpointllc.com/rboard/assets/images/dummy/1511x500.png" width="100%">
                <div class="banner-content text-white text-uppercase">
                    <h1>Your Text <br> <strong>Here</h1>
                </div>
            </div>
        </div>
    </a>
    <a href="">
        <div class="item">
            <div id="banner-grid" class="banner-grid py-0">
                <img src="https://ceonpointllc.com/rboard/assets/images/dummy/1511x500.png" width="100%">
                <div class="banner-content text-white text-uppercase">
                    <h1>Your Text <br> <strong>Here</h1>
                </div>
            </div>
        </div>
    </a>

    <?php } ?>
    </div>

    <section class="temp2_online_course">
        <div class="container">
            <div class="temp2_online_course_slider">
                <div class="item">
                    <a href="<?=base_url('professional/applicant/registration_form') ?>">
                        <div class="tem2_cor_cont text-center temp2_online">
                            <div class="temp2_course_img">
                                <img src="<?php echo base_url('assets/images/homepage/'); ?>PROFESSIONAL-REGISTRATION.png" alt="">
                            </div>
                            <h6> Professional <br> Registration </h6>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="<?=base_url('license/landing/professional_license')?>">
                        <div class="tem2_cor_cont text-center temp2_professional">
                            <div class="temp2_course_img">
                                <img src="<?php echo base_url('assets/images/homepage/'); ?>PROFESSIONAL-LICENSE-RENEWAL.png" alt="">
                            </div>
                            <h6>Professional <br> License Renewal </h6>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="<?=base_url('professional/applicant/index')?>">
                        <div class="tem2_cor_cont text-center temp2_Professional">
                            <div class="temp2_course_img">
                                <img src="<?php echo base_url('assets/images/homepage/'); ?>FOREIGN-PROFESSIONAL-APPLICATION-FOR-REGISTRATION.png" alt="">
                            </div>
                            <h6>Foreign Professional Review for <br> professional Registration </h6>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="<?=base_url('professional/profexam/index')?>">
                        <div class="tem2_cor_cont text-center temp2_cep">
                            <div class="temp2_course_img">
                                <img src="<?php echo base_url('assets/images/homepage/'); ?>FOREIGN-PROFESSIONAL-APPLICATION--FOR-LICENSURE-EXAMINATION.png" alt="">
                            </div>
                            <h6>Foreign Professional Review for <br> Online examination </h6>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="<?=base_url('examination/examination') ?>">
                        <div class="tem2_cor_cont text-center temp5">
                            <div class="temp2_course_img">
                                <img src="<?php echo base_url('assets/images/homepage/'); ?>FOREIGN-PROFESSIONAL-APPLICATION--FOR-LICENSURE-EXAMINATION.png" alt="">
                            </div>
                            <h6>Online <br> Licensure Examination</h6>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="<?=base_url('ce-provider/ce_provider')?>">
                        <div class="tem2_cor_cont text-center temp6">
                            <div class="temp2_course_img">
                                <img src="<?php echo base_url('assets/images/homepage/'); ?>CEP--ACCREDITATION.png" alt="">
                            </div>
                            <h6>CEP <br> Accreditation </h6>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="<?=base_url('ce-provider/ce_provider/course_application') ?>">
                        <div class="tem2_cor_cont text-center temp7">
                            <div class="temp2_course_img">
                                <img src="<?php echo base_url('assets/images/homepage/'); ?>FOREIGN-PROFESSIONAL-APPLICATION--FOR-LICENSURE-EXAMINATION.png" alt="">
                            </div>
                            <h6> Online <br> Course Accreditation </h6>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="<?=base_url('ce-provider/ce_provider/training_application') ?>">
                        <div class="tem2_cor_cont text-center temp8">
                            <div class="temp2_course_img">
                                <img src="<?php echo base_url('assets/images/homepage/'); ?>FOREIGN-PROFESSIONAL-APPLICATION--FOR-LICENSURE-EXAMINATION.png" alt="">
                            </div>
                            <h6>Training <br> course Accreditation</h6>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="<?=base_url('university/university') ?>">
                        <div class="tem2_cor_cont text-center temp9">
                            <div class="temp2_course_img">
                                <img src="<?php echo base_url('assets/images/homepage/'); ?>SCHOOL-ACCREDITATION.png" alt="">
                            </div>
                            <h6>School Accreditation </h6>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="<?=base_url('university/university/submissionofgraduates') ?>">
                        <div class="tem2_cor_cont text-center temp10">
                            <div class="temp2_course_img">
                                <img src="<?php echo base_url('assets/images/homepage/'); ?>SCHOOL-ACCREDITATION.png" alt="">
                            </div>
                            <h6>Submission of Graduate for <br> Licensure Examination</h6>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="<?=base_url('graduates') ?>">
                        <div class="tem2_cor_cont text-center temp11">
                            <div class="temp2_course_img">
                                <img src="<?php echo base_url('assets/images/homepage/'); ?>BOOKING-FOR-ONLINE-LICENSURE-EXAMINATION.png" alt="">
                            </div>
                            <h6>Booking for Online Licensure Examination<br>(Local Graduates)</h6>
                        </div>
                    </a>
                </div>
                <div class="item">
                    <a href="<?=base_url('professional/profexam/registerexam') ?>">
                        <div class="tem2_cor_cont text-center temp12">
                            <div class="temp2_course_img">
                                <img src="<?php echo base_url('assets/images/homepage/'); ?>BOOKING-FOR-ONLINE-LICENSURE-EXAMINATION-(FOREIGN-PROFESSIONALS).png" alt="">
                            </div>
                            <h6>Booking for Online Licensure Examination<br>(Foreign Professionals)</h6>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="container my-lg-4">
        <div class="row mb-3">
            <div class="col-md-12">
                <h4 class="d-inline-block my-3"><span class="notification-icon"><i class="fa fa-bell"
                            aria-hidden="true"></i></span> LATEST NEWS</h4>
                <a href="<?php echo base_url('news'); ?>"><button type="button"
                        class="btn btn-primary float-right mx-0 my-3">View All</button></a>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-8">
                        <a
                            href="<?php echo base_url('news/'.$newslisting[0]->news_url); ?>">
                            <div class="plasment">
                                <img src="<?php echo base_url('assets/images/newsmedia/'.$newslisting[0]->banner); ?>">
                                <div class="plasment-content text-white">
                                    <p><?php echo $newslisting[0]->news_title; ?></p>
                                    <p><?php echo date('M d,Y', strtotime($newslisting[0]->new_date)); ?>
                                        <span class="ml-3 d-inline-block"><?php echo $newslisting[0]->new_addedby; ?> </span>
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4"> 
                        <a
                            href="<?php echo base_url('news/'.$newslisting[1]->news_url); ?>">
                            <div class="team-pic mb-4">
                                <img src="<?php echo base_url('assets/images/newsmedia/'.$newslisting[1]->banner); ?>">
                                <p class="team-name text-white text-uppercase"><?php echo $newslisting[1]->news_title; ?></p>
                            </div>
                        </a> 
                        <a href="<?php echo base_url('news/'.$newslisting[2]->news_url); ?>">
                            <div class="team-pic mb-4">
                                <img src="<?php echo base_url('assets/images/newsmedia/'.$newslisting[2]->banner); ?>">
                                <p class="team-name text-white text-uppercase"><?php echo $newslisting[2]->news_title; ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 services">
            <?php
                $catid = array();
                $count = 1;
                foreach($newslistingrightside as $newsrside){
                    if($count == 1){
                        $count++;
                    if(!in_array($newsrside->newscat_id, $catid)){
                        echo '<span class="plasment-btn mt-0" href="#">'.$newsrside->news_category_name.'</span>';
                        array_push($catid, $newsrside->newscat_id);
                        echo '<div class="section-data" style=\'height:364px;\'>';
                    foreach($newslistingrightside as $news){
                        if($newsrside->newscat_id == $news->newscat_id){
                            $banner = '';
                            if(file_exists('./assets/images/newsmedia/'.$news->banner)){
                                $banner = '<img class="img_div" src="'.base_url().'assets/images/newsmedia/'.$news->banner.'">';
                            }
                            echo '<a href="'.base_url('news/'.$news->news_url).'">
                            <div class="row">
                                <div class="col-3">
                                    <div class="figure">
                                        '.$banner.'
                                    </div>
                                </div>
                                <div class="col-9">
                                    <h6>'.ucfirst($news->news_title).'</h6>
                                    <p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>'.date('M d,Y',strtotime($news->new_date)).'</p>
                                    <p>'.substr(strip_tags($news->news_description),0,50).'...</p>
                                </div>
                            </div>
                        </a>';
                        }
                    }
                    echo '</div>';
                    }
                    }
                }
                ?>
                 
                     
                    <!--<a href="https://ceonpointllc.com/rboard/news/training-manager-shares-the-2021-empowerment-plan">
                        <div class="row">
                            <div class="col-3">
                                <div class="figure">
                                    <img class="img_div"
                                        src="https://ceonpointllc.com/rboard/assets/images/newsmedia/newmedia_1624934538.png">
                                </div>
                            </div>
                            <div class="col-9">
                                <h6>TRAINING MANAGER SHARES THE 2021 EMPOWERMENT PLAN</h6>
                                <p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>June
                                    25, 2021</p>
                                <p>Show content here. Show content here.Show content ...</p>
                            </div>
                        </div>
                    </a> 
                    <a href="https://ceonpointllc.com/rboard/news/director-s-message-on-29th-year-founding-anniversary">
                        <div class="row">
                            <div class="col-3">
                                <div class="figure">
                                    <img class="img_div"
                                        src="https://ceonpointllc.com/rboard/assets/images/newsmedia/newmedia_1624934038.png">
                                </div>
                            </div>
                            <div class="col-9">
                                <h6>DIRECTOR'S MESSAGE ON 29TH YEAR FOUNDING ANNIVERSARY</h6>
                                <p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>June
                                    28, 2021</p>
                                <p>Message here. Message here, Message here Message h...</p>
                            </div>
                        </div>
                    </a>-->
            </div>
        </div>
    </div>
    <!--<section class="temp2_education_news my-lg-5">
        <div class="container">
            <div class="heading_content text-center">
                <h6>Mssterstudy Latest News</h6>
                <h3 class="mb-4">Education News all Over the World</h3>
            </div>
            <div class="row">
                <div class="col-md-3 text-center">
                    <div class="temp2_education_news_inner">
                        <img src="https://ceonpointllc.com/rboard/assets/images/course1.jpg" alt="">
                        <a class="temp2_edu_read_more" href="#"><span>Read More</span></a>
                    </div>
                    <h5>Admin earns scholarship</h5>
                    <p>20 jan 2021 Hinata Hyuga</p>
                </div>
                <div class="col-md-3 text-center">
                    <div class="temp2_education_news_inner">
                        <img src="https://ceonpointllc.com/rboard/assets/images/course2.jpg" alt="">
                        <a class="temp2_edu_read_more" href="#"><span>Read More</span></a>
                    </div>
                    <h5>Admin earns scholarship</h5>
                    <p>20 jan 2021 Hinata Hyuga</p>
                </div>
                <div class="col-md-3 text-center">
                    <div class="temp2_education_news_inner">
                        <img src="https://ceonpointllc.com/rboard/assets/images/course3.jpg" alt="">
                        <a class="temp2_edu_read_more" href="#"><span>Read More</span></a>
                    </div>
                    <h5>Admin earns scholarship</h5>
                    <p>20 jan 2021 Hinata Hyuga</p>
                </div>
                <div class="col-md-3 text-center">
                    <div class="temp2_education_news_inner">
                        <img src="https://ceonpointllc.com/rboard/assets/images/course2.jpg" alt="">
                        <a class="temp2_edu_read_more" href="#"><span>Read More</span></a>
                    </div>
                    <h5>Admin earns scholarship</h5>
                    <p>20 jan 2021 Hinata Hyuga</p>
                </div>

            </div>
        </div>
    </section>-->

    <section class="latest_online_course">
        <div class="container">
        <div class="mt-4">
        <h4 class="text-center text-uppercase">Accredited continuing education courses </h4>
        <p class="text-center ">“Ensuring public safety and quality service through continuing education.”</p>
       </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="onlinecourse-box ">
                        <div class="panel panel-default btn-strip" style="margin-bottom:0;">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="or-text">or</div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <a class="btn showSingle active1" id="active" target="1">LATEST courses</a>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <a class="btn onlinecourse showSingle " target="2">Training/Seminars</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="latest_online_course">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto targetDiv" id="div1">
                    <div class="required_box p-4">
                        <!-- <h4 class="text-left">LETEST ONLINE COURSES</h4> -->
                        <div class="heading_content text-center">
                            <h6>Latest Online Courses</h6>
                            <h3 class="mb-4">Pick a Course to Get Started</h3>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 mx-auto">
                                <?php echo form_open('courses', array('id'=>'courseForm', 'method'=>'get')) ?>
                                    <div class="form-row">
                                        <!--<div class="my-1">
                                            <input type="text" class="form-control" id="inlineFormInputName"
                                                placeholder="ENTER ONLINE COURSE TITLE">
                                        </div>-->
                                        <div class="form-group my-1 mb-0 mx-2">
                                            <select name="profession" class="form-control px-2" id="exampleFormControlSelect1">
                                                <option value="">PROFESSION </option>
                                                <?php foreach($profession as $cp){ ?>
                                                <option value="<?php echo $cp->id; ?>" <?php if(isset($_GET['profession']) && $_GET['profession']==$cp->id){echo 'selected';} ?>><?php echo $cp->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group my-1 mb-0 mx-2">
                                        <input type="text" name="course_title" class="form-control"
                                            value="<?php echo (isset($_GET['course_title']) && $_GET['course_title'])?$_GET['course_title']:''; ?>"
                                            placeholder="Enter Course Title">
                                        </div>

                                        <div class="rounded border my-1 px-0">
                                            <button type="submit" class="letest-course-btn btn btn-light px-4"><i
                                                class="fa fa-search px-1" aria-hidden="true"></i>SEARCH</button>
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        <div class="letest-online-slider mt-4">
                            <?php if(is_array($courselisting)?count($courselisting):0){
                            foreach($courselisting as $key => $value){ ?>
                            <div class="item px-0">
                                <div class="temp2_letest-online">
                                    <div class="letest-online-col border-bottom mb-3">
                                        <a class="d-block" href="<?php echo base_url('course/'.$value->cor_doc_id); ?>">
                                            <img src="<?php echo base_url('assets/images/ce_provider/'.$value->course_image); ?>" alt="">
                                        </a>
                                        <p class=""><?php echo ucwords($value->course_title); ?> </p>
                                        <h5 class="mt-2 mb-3 mx-2">CE Units : <?php echo $value->course_units; ?></h5>
                                        <!-- <p>Using color to add meaning</p> -->
                                    </div>

                                    <div class="float-left mx-2">
                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                    </div>
                                    <a href="<?php echo base_url('course/'.$value->cor_doc_id); ?>" class="professiona_detail float-right mr-2">View More </a>
                                </div>
                            </div>
                            <?php } }else{ ?>
                        <div class="common-main-box">
                            <a href="">
                                <div class="imag-panel">
                                    <img src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png">
                                    <div class="img-disp-hover">
                                        Title<br>CE Units : 0
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="common-main-box">
                            <a href="">
                                <div class="imag-panel">
                                    <img src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png">
                                    <div class="img-disp-hover">
                                        Title<br>CE Units : 0
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="common-main-box">
                            <a href="">
                                <div class="imag-panel">
                                    <img src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png">
                                    <div class="img-disp-hover">
                                        Title<br>CE Units : 0
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="common-main-box">
                            <a href="">
                                <div class="imag-panel">
                                    <img src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png">
                                    <div class="img-disp-hover">
                                        Title<br>CE Units : 0
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php  } 
                    ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mx-auto targetDiv" id="div2" style="display:none;">
                    <div class="required_box p-4">
                        <!-- <h4 class="text-left">LETEST ONLINE COURSES</h4> -->
                        <div class="heading_content text-center">
                            <h6>Latest Traning/Seminar/Conference/Convention</h6>
                            <h3 class="mb-4">Pick a Training to Get Started</h3>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 mx-auto">
                                <?php echo form_open('training', array('id'=>'trainingForm', 'method'=>'get')) ?>
                                    <div class="form-row">
                                        <!--<div class="my-1">
                                            <input type="text" class="form-control" id="inlineFormInputName"
                                                placeholder="ENTER ONLINE COURSE TITLE">
                                        </div>-->
                                        <div class="form-group my-1 mb-0 mx-2">
                                            <select name="profession" class="form-control px-2" id="exampleFormControlSelect1">
                                                <option value="">PROFESSION </option>
                                                <?php foreach($profession as $cp){ ?>
                                                <option value="<?php echo $cp->id; ?>" <?php if(isset($_GET['profession']) && $_GET['profession']==$cp->id){echo 'selected';} ?>><?php echo $cp->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group my-1 mb-0 mx-2">
                                        <input type="text" name="training_title" class="form-control"
                                            value="<?php echo (isset($_GET['training_title']) && $_GET['training_title'])?$_GET['training_title']:''; ?>"
                                            placeholder="Enter Training Title">
                                        </div>

                                        <div class="rounded border my-1 px-0">
                                            <button type="submit" class="letest-course-btn btn btn-light px-4"><i
                                                class="fa fa-search px-1" aria-hidden="true"></i>SEARCH</button>
                                        </div>
                                    </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        <div class="letest-online-slider mt-4">
                            <?php if(is_array($traininglisting)?count($traininglisting):0){
                            foreach($traininglisting as $key => $value) { ?>
                            <div class="item px-0">
                                <div class="temp2_letest-online">
                                    <div class="letest-online-col border-bottom mb-3">
                                        <a class="d-block" href="<?php echo base_url('training/'.$value->train_doc_id); ?>">
                                            <img src="<?php echo base_url('assets/images/ce_provider/'.$value->training_image); ?>" alt="">
                                        </a>
                                        <p class=""><?php echo ucwords($value->training_title); ?></p>
                                        <!--<h5 class="mt-2 mb-3 mx-2">TMusic theory Learn New Student &
                                            Fundamentals</h5>
                                         <p>Using color to add meaning</p> -->
                                    </div>

                                    <div class="float-left mx-2">
                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                        <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                    </div>
                                    <a href="<?php echo base_url('training/'.$value->train_doc_id); ?>" class="professiona_detail float-right mr-2">View More </a>
                                </div>
                                
                            </div>
                            <?php } }else{ ?>
                        <div class="common-main-box">
                            <a href="">
                                <div class="imag-panel">
                                    <img src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png">
                                    <div class="img-disp-hover">
                                        Title<br>Units : 0
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="common-main-box">
                            <a href="">
                                <div class="imag-panel">
                                    <img src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png">
                                    <div class="img-disp-hover">
                                        Title<br>Units : 0
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="common-main-box">
                            <a href="">
                                <div class="imag-panel">
                                    <img src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png">
                                    <div class="img-disp-hover">
                                        Title<br>Units : 0
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="common-main-box">
                            <a href="">
                                <div class="imag-panel">
                                    <img src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png">
                                    <div class="img-disp-hover">
                                        Title<br>Units : 0
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="common-main-box">
                            <a href="">
                                <div class="imag-panel">
                                    <img src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png">
                                    <div class="img-disp-hover">
                                        Title<br>Units : 0
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php  } 
                    ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <section class="education_requird">
        <div class="container">
            <div class="required-div py-5 w-100"
                style="background-image: url(https://ceonpointllc.com/rboard/assets/images/required.png);">
                <h4 class="text-light text-center">"Education is the most powerful weapon that you can use to
                    change the
                    world."
                </h4>
                <p class="text-light text-center">- Nehon Marndals</p>
            </div>
        </div>
    </section> -->
<?php $commonarray = array();
if (is_array($pprofessional)?count($pprofessional) :0) {
    foreach ($pprofessional as $value) {
        $commonarray[] = array(
            'user_id'  => $value->user_id,
            'name'  => $value->fname.' '.$value->lname.' '.$value->name,
            'image' => base_url('assets/uploads/profile/') . $value->image,
            'username' => $value->username,
            'type'  => $value->candidate_type,
            'registration_no' => $value->registration_no,
            'license_no' => $value->license_no
        );
    }
}
// if (is_array($gprofessional)?count($gprofessional) :0) {
//     foreach ($gprofessional as $value) {
//         $commonarray[] = array(
//             'user_id'  => $value->user_id,
//             'name'  => $value->fname.' '.$value->lname.' '.$value->name,
//             'image' => base_url('assets/images/graduates/') . $value->image,
//             'username' => $value->username,
//             'type'  => $value->candidate_type,
//             'registration_no' => $value->registration_no,
//             'license_no' => $value->license_no
//         );
//     }
// }
?>
    <section class="latest_pfofessionals mt-lg-4 mt-2 mb-md-4 mb-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="d-inline-block my-3 text-uppercase">Latest Professionals</h4>
                            <a href="<?php echo base_url('professionals'); ?>"><button type="button"
                                    class="btn bg-danger float-right mx-0 my-3 text-uppercase text-light">View all
                                    Professionals</button></a>
                        </div>
                    </div>
                    <div class="latest_pfofessionals_slider mb-4">
                    <?php if($commonarray) { 
                    foreach($commonarray as $key => $value) { ?>
                        <div class="item px-0">
                            <div class="temp2_letest-online">
                                <div class="letest-online-col">
                                    <a class="d-block" href="<?php echo base_url('professional/'.$value['user_id']); ?>">
                                        <img src="<?php echo $value['image']; ?>" alt="">
                                    </a>
                                    <p class=""><?php echo ucwords($value['name']); ?> </p>
                                    <!--<h5 class="mt-2 mb-3 mx-2">Machine Learning A-Z : Hands- on Python And
                                        Java</h5>
                                     <p>Using color to add meaning</p> -->
                                </div>

                            </div>
                        </div>
                        <?php } 
                        } else { ?>
                            <div class="item">
                                <div class="common-main-box">
                                    <a href="">
                                        <div class="imag-panel">
                                            <img src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png" width="100%"
                                                class="rounded">
                                            <div class="img-disp-hover">
                                                Title
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="common-main-box">
                                    <a href="">
                                        <div class="imag-panel">
                                            <img src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png" width="100%"
                                                class="rounded">
                                            <div class="img-disp-hover">
                                                Title
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="common-main-box">
                                    <a href="">
                                        <div class="imag-panel">
                                            <img src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png" width="100%"
                                                class="rounded">
                                            <div class="img-disp-hover">
                                                Title
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="common-main-box">
                                    <a href="">
                                        <div class="imag-panel">
                                            <img src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png" width="100%"
                                                class="rounded">
                                            <div class="img-disp-hover">
                                                Title
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="item">
                                <div class="common-main-box">
                                    <a href="">
                                        <div class="imag-panel">
                                            <img src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png" width="100%"
                                                class="rounded">
                                            <div class="img-disp-hover">
                                                Title
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
        
                            <?php } ?>
                    </div>
                </div>

            </div>
        </div>
    </section>
   
 
    <section class="latest_ce_provider">
       <div class="container">
        <h6 class="text-white">Latest CE Provider</h6>
        <div class="row">
            <div class="col-md-7">
                <div class="heading_content row">
                    <div class="col-sm-8">
                        
                        <h3 class="d-inline-block my-3 text-white">Accredited CE Providers </h3>
                    </div>
                    <div class="col-sm-4">
                        <a href="<?php echo base_url('ceprovider'); ?>" class="btn bg-primary float-right mx-0 my-3 text-uppercase text-light">View
                            all ce Providers</a>
                    </div>
                </div>
               
                <div class="ce-Provider-slider">
                <?php if(isset($cep) && $cep !='') { 
                foreach($cep as $key => $value) {
                    if($key < 3 ) { ?>
                    <div class="item">
                        <div class="common-main-box">
                            <a href="<?php echo base_url('ceprovider/'.$value->provider_id); ?>">
                                <div class="imag-panel"><img
                                        src="<?php echo base_url('assets/images/ce_provider/'.$value->company_logo); ?>"
                                        width="100%" class="rounded">
                                    <div class="img-disp-hover">
                                        <?php echo $value->business_name; ?> </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php } }  
                } else { ?>
                    <div class="item">
                        <div class="common-main-box">
                            <a href="">
                                <div class="imag-panel"><img
                                        src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png" width="100%"
                                        class="rounded">
                                    <div class="img-disp-hover">
                                        Title
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="common-main-box">
                            <a href="">
                                <div class="imag-panel"><img
                                        src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png" width="100%"
                                        class="rounded">
                                    <div class="img-disp-hover">
                                        Title
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="common-main-box">
                            <a href="">
                                <div class="imag-panel"><img
                                        src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png" width="100%"
                                        class="rounded">
                                    <div class="img-disp-hover">
                                        Title
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <?php   } ?>
                </div>
            </div>
            <div class="col-md-5">
                <div class="mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="d-inline-block text-white">Accredited Schools</h4>
                            <a href="<?php echo base_url('school'); ?>"><button type="button"
                                    class="btn bg-warning float-right mx-0 text-uppercase text-light">View
                                    all Schools</button></a>
                        </div>
                    </div>
                    
                    <div class="accredited-schools-slider">
                        <?php if(isset($university) && $university !='') { 
                        foreach($university as $key => $value) {
                            if(empty($value->college_logo)) {
                                $url = base_url('assets/images/university/default-logo.png');
                            }else{
                                $url = base_url('assets/images/university/'.$value->college_logo);
                            }
                             ?>
                        <div class="item mt-3">
                            <div class="common-main-box">
                                <a href="<?php echo base_url('school/'.$value->uniid); ?>">
                                    <div class="imag-panel"><img
                                            src="<?php echo $url; ?>"
                                            width="100%" class="rounded">
                                        <div class="img-disp-hover">
                                            <?php echo ucwords($value->university_name); ?> </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php } 
                         } else { ?>
                            <div class="common-main-box">
                                <a href="">
                                    <div class="imag-panel"><img
                                            src="https://ceonpointllc.com/rboard/assets/images/dummy/600x423.png"
                                            width="100%" class="rounded">
                                        <div class="img-disp-hover">
                                            Title
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <?php   } ?>
                    </div>
                    
                </div>
            </div>
        </div>
       </div>
       
    </section>

    <!-- <section class="footer_logo text-center">
        <div class="container">
            <img src="https://ceonpointllc.com/rboard/assets/images/logo.png" alt="">
        </div>
    </section>
    <div class="coppy_right py-4 text-center">
        <div class="container">
            <p>© 2021 ceonpoint.com. All Rights Reserved.</p>
        </div>
    </div> -->




    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script src="js/owl.carousel.js"></script>
    <script>
        $(document).ready(function () {
            $('#staticBackdrop').modal('show');
        });
        $('.showSingle').click(function () {
            $('.targetDiv').hide();
            $('.showSingle').removeClass('active active1')
            if ($(this).attr('target') === "1") {
                $(this).toggleClass('active');
            } else {
                $(this).toggleClass('active1');
            }
            $('#div' + $(this).attr('target')).show();
        });

    </script>

