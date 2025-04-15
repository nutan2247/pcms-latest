<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="banner-slider">
    <?php 
    if(is_array($topbanners)?count($topbanners):0){ 
		foreach($topbanners as $topbanr){
			if(file_exists('./assets/images/banner/'.$topbanr->banner)){
				$bannerlink = ($topbanr->url !="")?$topbanr->url:'javascript:void(0);';
				echo '<a href="'.$bannerlink.'"><div class="item">
					<div id="banner-grid" class="banner-grid py-0">
						<img src="'.base_url('assets/images/banner/'.$topbanr->banner).'" width="100%">
						<div class="banner-content text-white text-uppercase">
                        <h1><b><span style="font-size:85px;">'.$topbanr->title.' :</span> 
                        <br>'.$topbanr->sub_title.'</b></h1>
                        
                    </div>
					</div>
				</div></a>';
			}	
		}
    }else{ ?>
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

    <?php }
	?>
</div>
<section class="fixed-bann pb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="Professional-slider d-div">
                    <div class="item">
                        <a href="<?php echo base_url('professional/applicant/registration_form'); ?>">
                            <div class="text-center">
                                <img class="img_div"
                                    src="<?php echo base_url('assets/images/homepage/'); ?>PROFESSIONAL-REGISTRATION.png"
                                    width="50%" height="50%">
                                <p class="text-light mt-1">Professional Registration</p>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="<?php echo base_url('university/university'); ?>">
                            <div class="text-center">
                                <img class="img_div"
                                    src="<?php echo base_url('assets/images/homepage/'); ?>SCHOOL-ACCREDITATION.png"
                                    width="50%" height="50%">
                                <p class="text-light mt-1">School Accreditation</p>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="<?php echo base_url('ce-provider/ce_provider'); ?>">
                            <div class="text-center">
                                <img class="img_div"
                                    src="<?php echo base_url('assets/images/homepage/'); ?>CEP--ACCREDITATION.png"
                                    width="50%" height="50%">
                                <p class="text-light mt-1">CEP Accreditation</p>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="<?php echo base_url('professional/applicant/index'); ?>">
                            <div class="text-center">
                                <img class="img_div"
                                    src="<?php echo base_url('assets/images/homepage/'); ?>FOREIGN-PROFESSIONAL-APPLICATION-FOR-REGISTRATION.png"
                                    width="50%" height="50%">
                                <p class="text-light mt-1">Foreign Professional Application for Registration</p>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="<?php echo base_url('professional/profexam/index'); ?>">
                            <div class="text-center">
                                <img class="img_div"
                                    src="<?php echo base_url('assets/images/homepage/'); ?>FOREIGN-PROFESSIONAL-APPLICATION--FOR-LICENSURE-EXAMINATION.png"
                                    width="50%" height="50%">
                                <p class="text-light mt-1">Foreign Professional application for Licensure Examination
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="<?php echo base_url('graduates'); ?>">
                            <div class="text-center">
                                <img class="img_div"
                                    src="<?php echo base_url('assets/images/homepage/'); ?>BOOKING-FOR-ONLINE-LICENSURE-EXAMINATION.png"
                                    width="50%" height="50%">
                                <p class="text-light mt-1">Booking for Online Licensure Examination (Local Graduates)
                                </p>
                            </div>
                        </a>
                    </div>

                    <div class="item">
                        <a href="<?php echo base_url('professional/profexam/registerexam'); ?>">
                            <div class="text-center">
                                <img class="img_div"
                                    src="<?php echo base_url('assets/images/homepage/'); ?>BOOKING-FOR-ONLINE-LICENSURE-EXAMINATION-(FOREIGN-PROFESSIONALS).png"
                                    width="50%" height="50%">
                                <p class="text-light mt-1">Booking for Online Licensure Examination (Foreign
                                    Professionals)</p>
                            </div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="<?php echo base_url('license/landing/professional_license'); ?>">
                            <div class="text-center">
                                <img class="img_div"
                                    src="<?php echo base_url('assets/images/homepage/'); ?>PROFESSIONAL-LICENSE-RENEWAL.png"
                                    width="50%" height="50%">
                                <p class="text-light mt-1">Professional License Renewal</p>
                            </div>
                        </a>
                    </div>

                </div>
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
                <?php
                $count = 1;
                $allcount = is_array($newslisting)?count($newslisting):0;
                if($allcount){
                foreach ($newslisting as $news) {
                    $banner = '<img src="' . base_url() . 'assets/images/newsmedia/' . $news->banner . '">';
                    if($count == 1){?>
                        <div class="col-md-8">
                            <a href="<?=base_url('news/'.$news->news_url) ?>">
                                <div class="plasment">
                                    <?=$banner?>
                                    <div class="plasment-content text-white">
                                        <p><?=$news->news_title ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php }if($count == 2){ ?>
							<div class="col-md-4">
							<a href="<?=base_url('news/'.$news->news_url) ?>">
								<div class="team-pic mb-4">
									<?=$banner?>
									<p class="team-name text-white text-uppercase"><?=$news->news_title ?></p>
								</div>
							</a>
                            <?php } if($count == 3) {  ?>
							<a href="<?=base_url('news/'.$news->news_url) ?>">
								<div class="team-pic mb-4">
									<?=$banner?>
									<p class="team-name text-white text-uppercase"><?=$news->news_title ?></p>
								</div>
							</a>
						</div>
                        <?php } if($count > 3) { ?>
							<div class="col-4">
								<div class="newdate-main-box latestnews">
									<h1><a href="<?=base_url('news/'.$news->news_url) ?>"><?=$news->news_title ?></a></h1>
									<p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span><?=date_format(date_create($news->new_date),'F d, Y')?></p>
									<a class="newdate-img" href="<?=base_url('news/'.$news->news_url) ?>"><div class="news-img"><?=$banner?></div></a>
									<p><?=substr(strip_tags($news->news_description),0,110)?></p>
								</div>
							</div>
						<?php }
						$count++;
				} //foreach end
				if($allcount ==1) { ?>
               
                <div class="col-md-4">
                    <a href="">
                        <div class="team-pic mb-4">
                            <img src="https://ceonpointllc.com/rboard/assets/images/dummy/285x200.png">
                            <p class="team-name text-white text-uppercase">News Title</p>
                        </div>
                    </a>
                    <a href="">
                        <div class="team-pic mb-4">
                            <img src="https://ceonpointllc.com/rboard/assets/images/dummy/285x200.png">
                            <p class="team-name text-white text-uppercase">News Title</p>
                        </div>
                    </a>
                </div>

                <?php }
				if($allcount == 2){ ?>
					<a href="">
							<div class="team-pic mb-4">
								<img src="<?=base_url('assets/images/dummy/470x250.png')?>">
								<p class="team-name text-white text-uppercase">'News Title</p>
							</div>
						</a>
					</div>
                    <?php }
				}else{ ?>
					<div class="col-md-8">
						<a href="">
							<div class="plasment">
								<img src="<?=base_url('assets/images/dummy/600x423.png')?>">
								<div class="plasment-content text-white">
									<p>Paragraph</p>
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-4">
						<a href="">
							<div class="team-pic mb-4">
								<img src="<?=base_url('assets/images/dummy/470x250.png')?>">
								<p class="team-name text-white text-uppercase">'News Title</p>
							</div>
						</a>
					<!--<div>
					<div class="col-md-4">-->
						<a href="">
							<div class="team-pic mb-4">
								<img src="<?=base_url('assets/images/dummy/470x250.png')?>">
								<p class="team-name text-white text-uppercase">'News Title</p>
							</div>
						</a>
					</div>
				
					<!--<div class="col-4">
						<div class="newdate-main-box latestnews">
							<h1><a href="">News Title</a></h1>
							<p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>Date</p>
							<a class="newdate-img" href=""><div class="news-img"><img src="<?=base_url('assets/images/dummy/470x250.png')?>"></div></a>
							<p>News_description...</p>
						</div>
					</div>-->
					
				<?php } ?>
            </div>
        </div>
        <div class="col-md-3 services">
            <?php if(is_array($newslistingrightside)?count($newslistingrightside):0){
				$catid = array();
				$count = 1;
				foreach($newslistingrightside as $newsrside){
					if($count == 1){
						$count++;
					if(!in_array($newsrside->newscat_id,$catid)){
						echo '<span class="plasment-btn" href="#">'.$newsrside->news_category_name.'</span>';
						array_push($catid,$newsrside->newscat_id);
						echo '<div class="section-data" style=\'height:364px;\'>';
						foreach($newslistingrightside as $news){
							if($newsrside->newscat_id == $news->newscat_id){
								$banner = '';
								if(file_exists('./assets/images/newsmedia/'.$news->banner)){
									$banner = '<img class="img_div" src="'.base_url().'assets/images/newsmedia/'.$news->banner.'">';
								}
								echo ' <a href="'.base_url('news/'.$news->news_url).'">
										<div class="row">
											<div class="col-3">
												<div class="figure">
												'.$banner.'
												</div>
											</div>
											<div class="col-9">
												<h6>'.ucfirst($news->news_title).'</h6>
												<p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>'.date_format(date_create($news->new_date),'F d, Y').'</p>
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
				//print_r($catid);
			}else {?>
            <span class="plasment-btn" href="#">Message</span>
            <div class="section-data" style='height:364px;'>
                <a href="">
                    <div class="row">
                        <div class="col-3">
                            <div class="figure">
                                <img class="img_div" src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png">
                            </div>
                        </div>
                        <div class="col-9">
                            <h6>Title</h6>
                            <p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>Date</p>
                            <p>Description...</p>
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="row">
                        <div class="col-3">
                            <div class="figure">
                                <img class="img_div" src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png">
                            </div>
                        </div>
                        <div class="col-9">
                            <h6>Title</h6>
                            <p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>Date</p>
                            <p>Description...</p>
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="row">
                        <div class="col-3">
                            <div class="figure">
                                <img class="img_div" src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png">
                            </div>
                        </div>
                        <div class="col-9">
                            <h6>Title</h6>
                            <p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>Date</p>
                            <p>Description...</p>
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="row">
                        <div class="col-3">
                            <div class="figure">
                                <img class="img_div" src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png">
                            </div>
                        </div>
                        <div class="col-9">
                            <h6>Title</h6>
                            <p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>Date</p>
                            <p>Description...</p>
                        </div>
                    </div>
                </a>
                <a href="">
                    <div class="row">
                        <div class="col-3">
                            <div class="figure">
                                <img class="img_div" src="https://ceonpointllc.com/rboard/assets/images/dummy/250x250.png">
                            </div>
                        </div>
                        <div class="col-9">
                            <h6>Title</h6>
                            <p class="newdate"><span><i class="fa fa-calendar-o" aria-hidden="true"></i></span>Date</p>
                            <p>Description...</p>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>


    </div>
</div>

<section class="letest-online py-4">
    <div class="container">
       <div class="mt-4">
        <h4 class="text-center text-white text-uppercase">Accredited continuing education courses </h4>
        <p class="text-center text-white">“Ensuring public safety and quality service through continuing education.”</p>
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
            <div class="col-md-12 mx-auto targetDiv" id="div1">
                <div class="required_box p-4">
                    <h4 class="text-center text-white">LATEST ONLINE COURSES</h4>
                    <div class="row mt-3">
                        <div class="col-md-12 mx-auto">
                            <?php echo form_open('courses',array('id'=>'courseForm','method'=>'get')); ?>
                            <div class="row pt-1">
                                <!--<div class="form-group col-md-3">
                                <select name="category" class="form-control">
                                    <option value="">Category</option>
                                    <?php foreach($category as $inti){
                                        if($inti['insititution_id']=='')
                                        { continue; } ?>
                                    <option value="<?php echo $inti['insititution_id']; ?>" <?php if($_GET['institution']==$inti['insititution_id']){echo'selected';} ?> ><?php echo $inti['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>-->

                                <div class="form-group col-md-4">
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

                                <div class="form-group col-md-4">
                                    <input type="text" name="course_title" class="form-control"
                                        value="<?php echo (isset($_GET['course_title']) && $_GET['course_title'])?$_GET['course_title']:''; ?>"
                                        placeholder="Enter Course Title">
                                </div>

                                <div class="form-group col-md-4">
                                    <input type="submit" class="btn btn-primary" name="submit" id="sbbtn"
                                        value="Search">
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="letest-online-slider mt-4">
                        <?php if(is_array($courselisting)?count($courselisting):0){ ?>
                        <?php foreach ($courselisting as $key => $value) { 
                            	$banner = '';
								if(file_exists('./assets/images/ce_provider/'.$value->course_image)){
									$banner = '<img src="'.base_url().'assets/images/ce_provider/'.$value->course_image.'" style="height:179px;">';
								}?>
                        <div class="common-main-box">
                            <a href="<?php echo base_url('course/'.$value->cor_doc_id); ?>">
                                <div class="imag-panel">
                                    <?php echo $banner; ?>
                                    <div class="img-disp-hover">
                                        <?php echo ucwords($value->course_title); ?><br>CE Units :
                                        <?php echo $value->course_units; ?>
                                    </div>
                                </div>
                            </a>
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
                    <h4 class="text-center text-white">LATEST TRAINING/SEMINAR/CONFERENCE/CONVENTION</h4>
                    <div class="row mt-3">
                        <div class="col-md-12 mx-auto">
                            <?php echo form_open('training',array('id'=>'trainingForm','method'=>'get')); ?>
                            <div class="row pt-1">
                                <!-- <div class="form-group col-md-3">
                                <select name="category" class="form-control">
                                    <option value="">Category</option>
                                   <?php foreach($category as $inti){
                                        if($inti['insititution_id']=='')
                                        { continue; } ?>
                                    <option value="<?php echo $inti['insititution_id']; ?>" <?php if($_GET['institution']==$inti['insititution_id']){echo'selected';} ?> ><?php echo $inti['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>-->

                                <div class="form-group col-md-4">
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

                                <div class="form-group col-md-4">
                                    <input type="text" name="training_title" class="form-control"
                                        value="<?php echo (isset($_GET['training_title']) && $_GET['training_title'])?$_GET['training_title']:''; ?>"
                                        placeholder="Enter Training Title">
                                </div>

                                <div class="form-group col-md-4">
                                    <input type="submit" class="btn btn-primary" name="submit" id="sbbtn"
                                        value="Search">
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                    <div class="letest-online-slider mt-4">
                        <?php if(is_array($traininglisting)?count($traininglisting):0){ ?>
                        <?php foreach ($traininglisting as $key => $value) { 
                            	$banner = '';
								if(file_exists('./assets/images/ce_provider/'.$value->training_image)){
									$banner = '<img src="'.base_url().'assets/images/ce_provider/'.$value->training_image.'" style="height:179px;">';
								}?>
                        <div class="common-main-box">
                            <a href="<?php echo base_url('training/'.$value->train_doc_id); ?>">
                                <div class="imag-panel">
                                    <?php echo $banner; ?>
                                    <div class="img-disp-hover">
                                        <?php echo ucwords($value->training_title); ?>
                                    </div>
                                </div>
                            </a>
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
<div class="required-div py-5 w-100">
    <h4 class="text-light text-center">"Education is the most powerful weapon that you can use to change the world!"
    </h4>
    <p class="text-light text-center">- Nelson Mandela</p>
</div>
<?php $commonarray = array();
if (is_array($traininglisting)?count($traininglisting):0) {
    foreach ($pprofessional as $value) {
        $commonarray[] = array(
            'user_id'  => $value->user_id,
            'name'  => isset($value->fname)??''.' '.isset($value->lname)??''.' '.isset($value->name)??'',
            'image' => base_url('assets/uploads/profile/') . $value->image,
            'username' => isset($value->username)??'',
            'type'  => isset($value->candidate_type)??'',
            'registration_no' => isset($value->registration_no)??'',
            'license_no' => isset($value->license_no)??''
        );
    }
}
/* we don't need graduate professional here as all the professionals are listed in professional license table. */
// if (is_array($gprofessional)?count($gprofessional):0) {
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
                    <?php if (is_array($commonarray)?count($commonarray):0) { ?>
                    <?php foreach ($commonarray as $key => $value) { ?>
                    <div class="item">
                        <div class="common-main-box">
                            <a href="<?php echo base_url('professional/'.$value['user_id']); ?>">
                                <div class="imag-panel"><img src="<?php echo $value['image']; ?>" width="100%"
                                        class="rounded">
                                    <div class="img-disp-hover">
                                        <?php echo ucwords($value['name']); ?>
                                    </div>
                                </div>
                            </a>
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

<section class="latest_provider my-lg-5">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="d-inline-block my-3 text-uppercase">Accredited ce Provider</h4>
                        <a href="<?php echo base_url('ceprovider'); ?>"><button type="button"
                                class="btn bg-primary float-right mx-0 my-3 text-uppercase text-light">View all ce
                                Providers</button></a>
                    </div>
                </div>
                <div class="ce-Provider-slider">
                    <?php if (isset($cep) && $cep != '') { ?>
                    <?php foreach ($cep as $key => $value) {
                            if ($key < 3) { ?>
                    <div class="item">
                        <div class="common-main-box">
                            <a href="<?php echo base_url('ceprovider/' . $value->provider_id); ?>">
                                <div class="imag-panel"><img
                                        src="<?php echo base_url('assets/images/ce_provider/') . $value->company_logo; ?>"
                                        width="100%" class="rounded">
                                    <div class="img-disp-hover">
                                        <?php echo ucwords($value->business_name); ?>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php }
                        }
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
                            <h4 class="d-inline-block text-uppercase">Accredited Schools</h4>
                            <a href="<?php echo base_url('school'); ?>"><button type="button"
                                    class="btn bg-warning float-right mx-0 text-uppercase text-light">View
                                    all Schools</button></a>
                        </div>
                    </div>
                    <div class="accredited-schools-slider">
                        
                            <?php if (isset($university) && $university != '' ) { ?>
                            <?php foreach ($university as $key => $value) {
                                    if (empty($value->college_logo)) {
                                        $url = base_url('assets/images/university/default-logo.png');
                                    } else {
                                        $url = base_url('assets/images/university/') . $value->college_logo;
                                    } ?>
                        <div class="item mt-3">       
                            <div class="common-main-box">
                                <a href="<?php echo base_url('school/' . $value->uniid); ?>">
                                    <div class="imag-panel"><img src="<?php echo $url; ?>" width="100%" class="rounded">
                                        <div class="img-disp-hover">
                                            <?php echo ucwords($value->university_name); ?>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                            <?php 
                                }
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





<div class="required-div py-5">
    <h1 class="text-light text-center">BOTTOM SECTION</h1>
</div>
<script>
    $(document).ready(function () {
        $('#staticBackdrop').modal('show');
    });
</script>