<div class="tempthree_slider">
<?php if($topbanners){
    foreach($topbanners as $topbanr){
    if(file_exists('./assets/images/banner/'.$topbanr->banner)){ ?>
    <div class="item">
        <div class="tempt_bnr_slider" style="background-image: url('<?php echo base_url('assets/images/banner/'.$topbanr->banner); ?>');">
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
<div class="temp_slider">
    <div class="container">
        <div class="inline_course_slider">
            <div class="item">
                <a href="<?=base_url('professional/applicant/registration_form') ?>">
                <div class="tem_cor_cont text-center">
                    <div class="temp_course_img">
                        <img src="<?php echo base_url('assets/images/homepage/'); ?>PROFESSIONAL-REGISTRATION.png" alt="">
                    </div>
                    <h6>Professional Registration</h6>
                </div>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo base_url('university/university'); ?>">
                <div class="tem_cor_cont text-center">
                    <div class="temp_course_img">
                        <img src="<?php echo base_url('assets/images/homepage/'); ?>SCHOOL-ACCREDITATION.png" alt="">
                    </div>
                    <h6>School Accreditation</h6>
                </div>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo base_url('ce-provider/ce_provider'); ?>">
                <div class="tem_cor_cont text-center">
                    <div class="temp_course_img">
                        <img src="<?php echo base_url('assets/images/homepage/'); ?>CEP--ACCREDITATION.png" alt="">
                    </div>
                    <h6>CEP Accreditation</h6>
                </div>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo base_url('professional/applicant/index'); ?>">
                <div class="tem_cor_cont text-center">
                    <div class="temp_course_img">
                        <img src="<?php echo base_url('assets/images/homepage/'); ?>FOREIGN-PROFESSIONAL-APPLICATION-FOR-REGISTRATION.png" alt="">
                    </div>
                    <h6>Foreign Professional Application for Registration</h6>
                </div>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo base_url('professional/profexam/index'); ?>">
                <div class="tem_cor_cont text-center">
                    <div class="temp_course_img">
                        <img src="<?php echo base_url('assets/images/homepage/'); ?>FOREIGN-PROFESSIONAL-APPLICATION--FOR-LICENSURE-EXAMINATION.png" alt="">
                    </div>
                    <h6>Foreign Professional application for Licensure Examination</h6>
                </div>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo base_url('graduates'); ?>">
                <div class="tem_cor_cont text-center">
                    <div class="temp_course_img">
                        <img src="<?php echo base_url('assets/images/homepage/'); ?>BOOKING-FOR-ONLINE-LICENSURE-EXAMINATION.png" alt="">
                    </div>
                    <h6>Booking for Online Licensure Examination (Local Graduates)</h6>
                </div>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo base_url('professional/profexam/registerexam'); ?>">
                <div class="tem_cor_cont text-center">
                    <div class="temp_course_img">
                        <img src="<?php echo base_url('assets/images/homepage/'); ?>BOOKING-FOR-ONLINE-LICENSURE-EXAMINATION-(FOREIGN-PROFESSIONALS).png" alt="">
                    </div>
                    <h6>Booking for Online Licensure Examination (Foreign Professionals)</h6>
                </div>
                </a>
            </div>
            <div class="item">
                <a href="<?php echo base_url('license/landing/professional_license'); ?>">
                <div class="tem_cor_cont text-center">
                    <div class="temp_course_img">
                        <img src="<?php echo base_url('assets/images/homepage/'); ?>PROFESSIONAL-LICENSE-RENEWAL.png" alt="">
                    </div>
                    <h6>Professional License Renewal</h6>
                </div>
                </a>
            </div>
            
        </div>
    </div>
</div>

<section class="education_news my-lg-5">
    <div class="container">
        <div class="heading_content">
            <h6>Master study Latest News</h6>
            <h3 class="mb-4">Education News all Over the World</h3>
        </div>
        <div class="row">
            <div class="col-md-3">
            <?php if(isset($newslisting) && !empty($newslisting[0])){ ?>
                <a href="<?php echo base_url('news/' . $newslisting[0]->news_url); ?>">
                    <div class="plasment">
                        <?php $banner0 = '<img src="' . base_url() . 'assets/images/newsmedia/' . $newslisting[0]->banner . '">'; ?>
                        <?php echo $banner0; ?>
                        <div class="plasment-content text-white text-left p-3">
                            <p class="font-weight-bold h5"><?php echo $newslisting[0]->news_title; ?></p>
                            <p><?php echo date('d M, Y',strtotime($newslisting[0]->new_date)); ?><span class="ml-3 d-inline-block"><?php echo $newslisting[0]->new_addedby;?></span></p>
                        </div>
                    </div>
                </a>
            <?php } else{ ?>
                    <a href="">
                        <div class="plasment">
                            <img src="https://ceonpointllc.com/rboard/assets/images/dummy/285x200.png">
                            <p class="team-name text-white text-uppercase">News Title</p>
                        </div>
                    </a>
            <?php }  ?>
            </div>
                
            <div class="col-md-3">
                <?php if(isset($newslisting) && !empty($newslisting[1])){ ?>
                <a href="<?php echo base_url('news/' . $newslisting[1]->news_url); ?>">
                    <div class="plasment">
                        <?php $banner1 = '<img src="' . base_url() . 'assets/images/newsmedia/' . $newslisting[1]->banner . '">'; ?>
                        <?php echo $banner1; ?>
                        <div class="plasment-content text-white text-left p-3">
                            <p class="font-weight-bold h5"><?php echo $newslisting[1]->news_title; ?></p>
                            <p><?php echo date('d M, Y',strtotime($newslisting[1]->new_date)); ?><span class="ml-3 d-inline-block"><?php echo $newslisting[1]->new_addedby;?></span></p>
                        </div>
                    </div>
                </a>
                <?php } else{ ?>
                    <a href="">
                        <div class="plasment">
                            <img src="https://ceonpointllc.com/rboard/assets/images/dummy/285x200.png">
                            <p class="team-name text-white text-uppercase">News Title</p>
                        </div>
                    </a>
                <?php }  ?>
            </div>

            <div class="col-md-6">
                <?php if(isset($newslisting) && !empty($newslisting[2])){ ?>
                    <a href="<?php echo base_url('news/' . $newslisting[2]->news_url); ?>">
                        <div class="plasment">
                            <?php     $banner2 = '<img src="' . base_url() . 'assets/images/newsmedia/' . $newslisting[2]->banner . '">';  ?>
                            <?php echo $banner2; ?>
                            <div class="plasment-content text-white text-left p-3">
                                <p class="font-weight-bold h5"><?php echo $newslisting[2]->news_title; ?></p>
                                <p><?php echo date('d M, Y',strtotime($newslisting[2]->new_date)); ?><span class="ml-3 d-inline-block"><?php echo $newslisting[2]->new_addedby;?></span></p>
                            </div>
                        </div>
                    </a>
                <?php }else{ ?>
                    <a href="">
                        <div class="plasment">
                            <img src="https://ceonpointllc.com/rboard/assets/images/dummy/285x200.png">
                            <p class="team-name text-white text-uppercase">News Title</p>
                        </div>
                    </a>
                <?php }  ?>
            </div>

        </div>
    </div>
</section>

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
                                    <a class="btn showSingle active" id="active" target="1">ONLINE courses</a>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                    <a class="btn onlinecourse showSingle" target="2">Training/Seminars</a>
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
        <div class="row targetDiv" id="div1">
            <div class="col-md-12 mx-auto">
                <div class="required_box p-4">
                    <!-- <h4 class="text-left">LETEST ONLINE COURSES</h4> -->
                    <div class="heading_content">
                        <h6>Latest Online Courses</h6>
                        <h3 class="mb-4">Pick a Course to Get Started</h3>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mx-auto">
                        <?php echo form_open('courses',array('id'=>'courseForm','method'=>'get')); ?>
                                <div class="form-row">
                                    <div class="form-group my-1 mb-0 mx-2">
                                        <select name="profession" class="form-control">
                                            <option value="">Profession</option>
                                            <?php foreach($profession as $cp){ ?>
                                            <option value="<?php echo $cp->id; ?>" <?php if(isset($_GET['profession']) &&
                                                $_GET['profession']==$cp->id){echo'selected';} ?> >
                                                <?php echo $cp->name; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group my-1 mb-0 mx-2">
                                        <input type="text" name="course_title" class="form-control" value="<?php echo (isset($_GET['course_title']) && $_GET['course_title'])?$_GET['course_title']:''; ?>" placeholder="Enter Course Title">
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
                    <?php if(is_array($courselisting) ? count($courselisting):0){ ?>
                    <?php foreach ($courselisting as $key => $value) { 
                            	$banner = '';
								if(file_exists('./assets/images/ce_provider/'.$value->course_image)){
									$banner = '<img src="'.base_url().'assets/images/ce_provider/'.$value->course_image.'" style="height:179px;">';
								}?>
                    <div class="item px-0">
                        <div class="letest-online-col border-bottom mx-2 mb-3">
                            <a href="<?php echo base_url('course/'.$value->cor_doc_id); ?>">
                                <div class="imag-panel">
                                    <?php echo $banner; ?>
                                </div>
                            </a>
                            <h5 class="mt-2 mb-3">
                            <?php echo ucwords($value->course_title); ?></h5>
                            <p class="d-flex justify-content-start text-primary">CE Units :
                            <?php echo $value->course_units; ?></p>
                        </div>
                            <div class="float-left mx-3">
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                            </div>
                            <a href="<?php echo base_url('course/'.$value->cor_doc_id); ?>" class="professiona_detail float-right">Know detail <span><img src="https://ceonpointllc.com/rboard/assets/images/arrow-right-solid.svg" alt=""></span> </a>
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
        </div>
        <div class="row targetDiv" id="div2" style="display:none;">
            <div class="col-md-12 mx-auto">
                <div class="required_box p-4">
                    <div class="heading_content">
                        <h6>LATEST TRAINING/SEMINAR/CONFERENCE/CONVENTION</h6>
                        <h3 class="mb-4">Pick a Training to Get Started</h3>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mx-auto">
                        <?php echo form_open('training',array('id'=>'trainingForm','method'=>'get')); ?>
                                <div class="form-row">
                                    <div class="form-group my-1 mb-0 mx-2">
                                        <select name="profession" class="form-control">
                                            <option value="">Profession</option>
                                            <?php foreach($profession as $cp){ ?>
                                            <option value="<?php echo $cp->id; ?>" <?php if(isset($_GET['profession']) &&
                                                $_GET['profession']==$cp->id){echo'selected';} ?> >
                                                <?php echo $cp->name; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group my-1 mb-0 mx-2">
                                        <input type="text" name="training_title" class="form-control" value="<?php echo (isset($_GET['training_title']) && $_GET['training_title'])?$_GET['training_title']:''; ?>" placeholder="Enter Training Title">
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
                        <?php if(is_array($traininglisting) ? count($traininglisting):0){ ?>
                        <?php foreach ($traininglisting as $key => $value) { 
                                    $banner = '';
                                    if(file_exists('./assets/images/ce_provider/'.$value->training_image)){
                                        $banner = '<img src="'.base_url().'assets/images/ce_provider/'.$value->training_image.'">';
                                    }?>
                        
                        <div class="item px-0">
                            <div class="letest-online-col border-bottom mx-2 mb-3">
                                <a class="d-block" href="<?php echo base_url('training/'.$value->train_doc_id); ?>">
                                    <div class="imag-panel">
                                        <?php echo $banner; ?>
                                    </div>
                                </a>
                                    <h5 class="mt-2 mb-3"> <?php echo ucwords($value->training_title); ?></h5>
                                    <p class="d-flex justify-content-start text-primary">Units : 
                                    <?php echo $value->training_units; ?></p>
                            </div>
                            <div class="float-left mx-3">
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                                <i class="fa fa-star text-warning" aria-hidden="true"></i>
                            </div>
                            <a href="<?php echo base_url('training/'.$value->train_doc_id); ?>" class="professiona_detail float-right">Know detail <span><img
                                        src="<?php echo base_url('assets/images/arrow-right-solid.svg'); ?>" alt=""></span> </a>
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

<!--<section class="education_requird">
    <div class="container">
        <div class="required-div py-5 w-100" style="background-image: url('<?php echo base_url('assets/images/required.png');?>);">
            <h4 class="text-light text-center">"Education is the most powerful weapon that you can use to change the world."
            </h4>
            <p class="text-light text-center">- Nehon Marndals</p>
        </div>
    </div>
</section>-->

<?php $commonarray = array();
if (is_array($pprofessional) ? count($pprofessional) : 0) {
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
// if (is_array($gprofessional) ? count($gprofessional):0) {
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
    <section class="latest_pfofessionals mt-lg-4">
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
                    <div class="latest_pfofessionals_slider">
                    <?php if($commonarray) { 
                    foreach($commonarray as $key => $value) { ?>
                        <div class="item px-0">
                            <div class="temp2_letest-online">
                                <div class="letest-online-col">
                                    <a class="d-block" href="<?php echo base_url('professional/'.$value['user_id']); ?>">
                                        <img src="<?php echo $value['image']; ?>" alt="">
                                    </a>
                                    <p class="d-flex justify-content-start mx-2"><?php echo ucwords($value['name']); ?> </p>
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
                        
                        <h3 class="d-inline-block my-3 text-white">Accredited CE Providers</h3>
                    </div>
                    <div class="col-sm-4">
                        <a href="<?php echo base_url('ceprovider'); ?>" class="btn bg-primary float-right mx-0 my-3 text-uppercase text-light">View
                            all ce Providers</a>
                    </div>
                </div>
               
                <div class="ce-Provider-slider">
                <?php if(isset($cep) && $cep != '') { 
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
                }else{ ?> 
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
                <?php } ?>
                </div>
            </div>
            <div class="col-md-5">
                <div class="mt-3">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="d-inline-block text-white">Accredited Schools</h4>
                            <a href="<?php echo base_url('school'); ?>"><button type="button"
                                    class="btn bg-warning float-right mx-0 text-uppercase text-light">View
                                    all School</button></a>
                        </div>
                    </div>
                    
                    <div class="accredited-schools-slider">
                        <?php if(isset($university) && $university != '') { 
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
        <!--<div class="mt-5">
            <h3 class="text-white">CPD Guidlines:</h3>
            <p class="text-white">Use the .flex-fill class on a series of sibling elements to force them into widths equal to their content (or equal widths if their content does not surpass their border-boxes) while taking up all available horizontal space.</p>
            <p class="text-white">
                Use the .flex-fill class on a series of sibling elements to force them into widths equal to their content (or equal widths if their content does not surpass their border-boxes) while taking up all available horizontal space. Use the .flex-fill class on
                a series of sibling elements to force them into widths equal to their content (or equal widths if their content does not surpass their border-boxes) while taking up all available horizontal space.
            </p>
        </div>-->
        </div>
    </div>
</section>


<script>
    $(document).ready(function() {
        $('#staticBackdrop').modal('show');
    });
    $('.showSingle').click(function() {
        $('.targetDiv').hide();
        $('.showSingle').removeClass('active active1')
        if ($(this).attr('target') === "1") {
            $(this).toggleClass('active');
        } else {
            $(this).toggleClass('active1');
        }
        $('#div' + $(this).attr('target')).show();
    });
    
    // $('.regulatory_bord_slider').owlCarousel({
    //     loop: true,
    //     margin: 20,
    //     nav: true,
    //     dots: false,
    //     autoplayHoverPause: true,
    //     autoplay: true,
    //     autoplaySpeed: 2000,
    //     dotsSpeed: 2000,
    //     responsive: {
    //         320: {
    //             items: 1
    //         },

    //         360: {
    //             items: 2
    //         },

    //         580: {
    //             items: 2
    //         },
    //         768: {
    //             items: 5
    //         },
    //         1000: {
    //             items: 5
    //         }
    //     }
    // });
    // $('.letest-online-slider').owlCarousel({
    //     loop: true,
    //     margin: 20,
    //     nav: true,
    //     dots: false,
    //     autoplayHoverPause: true,
    //     autoplay: true,
    //     autoplaySpeed: 2000,
    //     dotsSpeed: 2000,
    //     responsive: {
    //         320: {
    //             items: 1
    //         },

    //         360: {
    //             items: 2
    //         },

    //         580: {
    //             items: 2
    //         },
    //         768: {
    //             items: 4
    //         },
    //         1000: {
    //             items: 4
    //         }
    //     }
    // });

    // $('.latest_pfofessionals_slider').owlCarousel({
    //     loop: true,
    //     margin: 20,
    //     nav: true,
    //     dots: false,
    //     autoplayHoverPause: true,
    //     autoplay: true,
    //     autoplaySpeed: 2000,
    //     dotsSpeed: 2000,
    //     responsive: {
    //         320: {
    //             items: 1
    //         },

    //         360: {
    //             items: 2
    //         },

    //         580: {
    //             items: 3
    //         },
    //         768: {
    //             items: 5
    //         },
    //         1000: {
    //             items: 5
    //         }
    //     }
    // });

    // $('.inline_course_slider').owlCarousel({
    //     loop: true,
    //     margin: 20,
    //     nav: true,
    //     dots: false,
    //     autoplayHoverPause: true,
    //     autoplay: true,
    //     autoplaySpeed: 2000,
    //     dotsSpeed: 2000,
    //     responsive: {
    //         320: {
    //             items: 1
    //         },

    //         360: {
    //             items: 2
    //         },

    //         580: {
    //             items: 3
    //         },
    //         768: {
    //             items: 3
    //         },
    //         1000: {
    //             items: 4
    //         }
    //     }
    // });
</script>